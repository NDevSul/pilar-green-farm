<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function shop(Request $request)
    {
        $query = Product::query();
    
        // Jika ada filter kategori
        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->categories);
        }
    
        $products = $query->with('category')->get();
        $category = Category::all();
        $collections = \App\Models\SeasonalCollection::latest()->take(3)->get();
    
        return view('shop', compact('products', 'category', 'collections'));
    }
    
    public function index()
    {
        $categories = Category::all();
        $products = Product::all(); 
        return view('shop.index', compact('categories', 'products'));
        
    }
    public function create()
{
    $categories = Category::all();
    $products = Product::latest()->with('category')->get();
    return view('admin.products.create', compact('categories', 'products'));
}


    public function quickAdd(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
    
        $category = Category::create([
            'name' => $request->name,
        ]);
    
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }


    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $imageFileName = null;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $imageFileName = basename($path);
    }

    Product::create([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'price' => $validated['price'],
        'stock' => $validated['stock'],
        'category_id' => $validated['category_id'],
        'image_url' => $imageFileName ?? 'default-product.jpg',
    ]);

    return redirect()->route('admin.products.create')->with('success', 'Produk berhasil ditambahkan!');
}


    public function edit($id)
{
    $product = \App\Models\Product::findOrFail($id);
    $categories = \App\Models\Category::all();

    return view('admin.products.edit', compact('product', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $product = \App\Models\Product::findOrFail($id);

    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->category_id = $request->category_id;

    if ($request->hasFile('image')) {
        if ($product->image_url && Storage::disk('public')->exists('images/' . $product->image_url)) {
            Storage::disk('public')->delete('images/' . $product->image_url);
        }
    
        $path = $request->file('image')->store('images', 'public');
        $product->image_url = basename($path); 
    }
    
    

    $product->save();

    return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diperbarui.');
}

public function destroy($id)
{
    $product = \App\Models\Product::findOrFail($id);

    if ($product->image_url && \Storage::disk('public')->exists('images/' . $product->image_url)) {
        \Storage::disk('public')->delete('images/' . $product->image_url);
    }

    $product->delete();

    return redirect()->back()->with('success', 'Produk berhasil dihapus.');
}

public function landing()
{
    $products = Product::latest()->take(4)->with('category')->get();
    return view('welcome', compact('products'));
}


}    

