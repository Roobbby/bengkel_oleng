<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domainId = Auth::user()->domain->id;
        $products = Product::where('domain_id', $domainId)->get();

        return view('back.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->pluck('name','id');

        return view('back.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'category_id' => 'required',
            'quantity'    => 'required',
            'price'       => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->file('image')) {
            $file     = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('image/item'), $filename);
        }

        Product::create([
            'name'        => $request->input('name'),
            'domain_id'   => $request->input('domain_id'),
            'category_id' => $request->input('category_id'),
            'quantity'    => $request->input('quantity'),
            'price'       => $request->input('price'),
            'image'       => $filename,
        ]);
    
        
        session()->flash('alert', 'success');
        session()->flash('message', 'Barang berhasil ditambahkan.');
        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::all()->pluck('name','id');
        $products   = Product::findOrFail($id);

        return view('back.product.detail', compact('products', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all()->pluck('name','id');
        $products   = Product::findOrFail($id);

        return view('back.product.edit', compact('products', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        
        // Cek apakah ada file gambar baru yang diupload
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('image/item'), $filename);
            
            // Hapus gambar lama jika ada
            if ($product->image && file_exists(public_path('image/item/' . $product->image))) {
                unlink(public_path('image/item/' . $product->image));
            }
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $filename = $product->image;
        }
    
        $product->update([
            'name'        => $request->input('name'),
            'domain_id'   => $request->input('domain_id'),
            'category_id' => $request->input('category_id'),
            'quantity'    => $request->input('quantity'),
            'price'       => $request->input('price'),
            'image'       => $filename,
        ]);
    
        session()->flash('alert', 'success');
        session()->flash('message', 'Barang berhasil diperbarui.');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {            
        $product->delete();

    session()->flash('alert', 'success');
    session()->flash('message', 'Barang berhasil ditambahkan.');
    return redirect()->route('products.index');
    }
}
