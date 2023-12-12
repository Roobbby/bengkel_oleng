<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use App\Models\Product;

class TransactionController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $params = $request->all();

        $transaction = \DB::transaction(function() use ($params) {
            
            $transactionParams = [
                'transaction_code' => 'P' . mt_rand(1,1000),
                'name' => auth()->user()->name,
                'total_price' => $params['total'],
                'accept' => $params['accept'],
                'return' => $params['return'],
			];

			$transaction = Transaction::create($transactionParams);

			$carts = Cart::all();

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
			return redirect()->back()->with([
				'message' => 'Success order',
				'alert-type' => 'success'
			]);
		}
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
