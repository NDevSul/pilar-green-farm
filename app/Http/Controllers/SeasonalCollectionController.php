<?php

namespace App\Http\Controllers;

use App\Models\SeasonalCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeasonalCollectionController extends Controller
{
    public function index()
    {
        $collections = SeasonalCollection::all();
        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.products.createseasonal');
    }    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $i = 1;
    
        while (SeasonalCollection::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i++;
        }
    
        $imagePath = $request->file('image')->store('seasonal_collections', 'public');
    
        SeasonalCollection::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'image' => basename($imagePath),
        ]);
    
        return redirect()->route('admin.dashboard')->with('success', 'Seasonal Collection berhasil ditambahkan!');
    }
}
