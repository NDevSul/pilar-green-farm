@extends('layouts.app')

@section('content')
<div class="bg-green-50 min-h-screen py-10">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-green-800">Edit Produk</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Nama Produk</label>
                <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Deskripsi</label>
                <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Harga</label>
                <input type="number" name="price" step="0.01" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Stock</label>
                <input type="number" name="stock" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Gambar Produk (kosongkan jika tidak ingin mengganti)</label>
                <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2" accept="image/*">
                @if($product->image_url)
                    <p class="text-sm mt-2">Gambar sekarang:</p>
                    <img src="{{ asset('storage/images/' . $product->image_url) . '?v=' . time() }}" class="w-32 h-32 object-cover rounded mt-2">
                @endif
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Kategori</label>
                <select name="category_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                Update Produk
            </button>
        </form>
    </div>
</div>
@endsection
