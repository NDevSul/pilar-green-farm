@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-green-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-xl p-10">
        <h2 class="text-3xl font-bold text-green-700 mb-6 text-center">Tambah Produk Baru</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 rounded px-4 py-3 mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Produk -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-1 font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="name" required
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4"
                          class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-green-500"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Harga</label>
                    <input type="number" step="0.01" name="price" required
                           class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" required
                           class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-green-500">
                </div>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" required
                       class="w-full border border-gray-300 rounded px-4 py-2 bg-white focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Kategori</label>
                <select name="category_id" required
                        class="w-full border border-gray-300 rounded px-4 py-2 bg-white focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-8 rounded-full transition-all shadow-md hover:shadow-lg">
                    Simpan Produk
                </button>
            </div>
        </form>

        @if($products->count())
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-green-700 mb-4">Daftar Produk Tersimpan</h2>
        <div class="overflow-x-auto rounded shadow bg-white">
            <table class="min-w-full text-left border border-gray-200">
                <thead class="bg-green-100 text-green-800">
                    <tr>
                        <th class="p-3 border-b">Nama</th>
                        <th class="p-3 border-b">Kategori</th>
                        <th class="p-3 border-b">Harga</th>
                        <th class="p-3 border-b">Stock</th>
                        <th class="p-3 border-b">Gambar</th>
                        <th class="p-3 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="hover:bg-green-50">
                        <td class="p-3 border-b">{{ $product->name }}</td>
                        <td class="p-3 border-b">{{ $product->category->name ?? '-' }}</td>
                        <td class="p-3 border-b">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-3 border-b">{{ $product->stock }}</td>
                        <td class="p-3 border-b">
                            <img src="{{ asset('storage/images/' . $product->image_url) }}" alt="Gambar" class="w-16 h-16 object-cover rounded">
                        </td>
                        <td class="p-3 border-b">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline text-sm mr-2">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

    </div>
</div>
@endsection
