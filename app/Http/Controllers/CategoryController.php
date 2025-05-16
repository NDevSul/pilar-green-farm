<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
    {
        return view('categories.create');
    }
    
    public function quickAdd(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }
    public function index()
{
    $categories = Category::all();
    return view('admin.categories.index', compact('categories'));
}

public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('admin.categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $id,
    ]);

    $category = Category::findOrFail($id);
    $category->update(['name' => $request->name]);

    return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
}

public function destroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
}


}