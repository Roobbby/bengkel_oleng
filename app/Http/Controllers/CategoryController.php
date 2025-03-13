<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('back.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existingCategory = Category::where('name', $request->input('name'))->first();

        if ($existingCategory) {
            return redirect()
                ->back()
                ->withErrors(['name' => 'Kategori dengan nama ini sudah ada.'])
                ->withInput();
        }

        $category = Category::create([
            'name' => $request->input('name'),
        ]);

        session()->flash('alert', 'success');
        session()->flash('message', 'Berhasil Membuat Category');
        return redirect()->route('categories.index');
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
    public function edit(Category $category)
    {
        return view ('back.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        session()->flash('alert', 'success');
        session()->flash('message', 'Berhasil Edit Category');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) : RedirectResponse
    {
        $category->delete();

        return back();
    }
}
