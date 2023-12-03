<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domain;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domainId = Auth::user()->domain->id;

        $list = Item::where('domain_id', $domainId)->get();

        return view('back.users.list_spare', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('back.users.create_spare');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            if ($request->file('cover')) {
                $file = $request->file('cover');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('image/item'), $filename);

               

                // Simpan data ke database
                $item = new Item([
                    'domain_id' => $request->domain_id,
                    'nama_barang' => $request->nama_barang,
                    'id_category' => $request->id_category,
                    'category' => $request->category,
                    'harga' => $request->harga,
                    'stok' => $request->stok,
                    'cover' => $filename,
                    'deskripsi' => $request->deskripsi,
                ]);
              
                $item->save();
            }
            
            session()->flash('alert', 'success');
            session()->flash('message', 'Barang berhasil ditambahkan.');
            return redirect()->route('item.index');
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list = Item::find($id);

        return view('back.users.edit_spare', compact('list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lists = User::find($id);

        if($lists){
            $lists->delete();
        }
    return redirect()->route('item.index');
    }
}
