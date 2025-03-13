<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $domainId = Auth::user()->domain->id;
        $transactions = Transaction::where('domain_id', $domainId)->get();;

        return view ('back.transaction.index', compact('transactions'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $params = $request->all();

        $transaction = DB::transaction(function() use ($params) {
            
            $transactionParams = [
                'transaction_code' => 'P' . mt_rand(1,1000),
                'domain_id' => Auth::user()->domain->id,
                'name' => auth()->user()->name,
                'total_price' => $params['total'],
                'diskon' => $params['diskon'],
                'subtotal' => $params['subtotal'],
                'accept' => $params['accept'],
                'return' => $params['return'],
			];

			$transaction = Transaction::create($transactionParams);

            $domainId = Auth::user()->domain->id;
            $carts = Cart::where('domain_id', $domainId)->get();

			if ($transaction && $carts) {
				foreach ($carts as $cart) {

                    $itemBaseTotal = $cart->quantity * $cart->price;

					$orderItemParams = [
						'transaction_id' => $transaction->id,
						'product_id' => $cart->product_id,
						'qty' => $cart->quantity,
                        'name' => $cart->name,
						'base_price' => $cart->price,
						'base_total' => $itemBaseTotal,
					];

					$orderItem = TransactionDetail::create($orderItemParams);
					
					if ($orderItem) {
						$product = Product::findOrFail($cart->product_id);
						$product->quantity -= $cart->quantity;
						$product->save();
                    }
                    
                    $cart->delete();
				}
            }
            
            return $transaction;
        });

		if ($transaction) {
            session()->flash('alert', 'success');
            session()->flash('message', 'Transakasi Berhasil.');
			return redirect()->route('transactions.show', $transaction->id);
		}
    }

    public function show(Transaction $transaction)
    {
        return view('back.transaction.detail', compact('transaction'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->deleteTransactionWithDetails();
        
        session()->flash('alert', 'success');
        session()->flash('message', 'Delete Data Berhasil.');
        return redirect()->back();
    }
}
