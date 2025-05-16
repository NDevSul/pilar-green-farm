@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow rounded">
    <h2 class="text-2xl font-bold mb-4 text-green-800 dark:text-green-100">Pengaturan Metode Pembayaran</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Tambah Metode Pembayaran -->
    <form action="{{ route('admin.payment.methods.store') }}" method="POST" enctype="multipart/form-data" class="mb-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Nama Bank/Platform</label>
                <input type="text" name="bank_name" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Nomor Rekening / ID</label>
                <input type="text" name="account_number" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Atas Nama</label>
                <input type="text" name="account_name" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">QRIS (Opsional)</label>
                <input type="file" name="qris_image" accept="image/*" class="w-full border px-3 py-2 rounded">
            </div>
        </div>
        <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Tambah Metode
        </button>
    </form>

    <!-- Daftar Metode Pembayaran yang Sudah Ada -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Bank</th>
                    <th class="px-4 py-2 text-left">Nomor Rekening</th>
                    <th class="px-4 py-2 text-left">Atas Nama</th>
                    <th class="px-4 py-2 text-left">QRIS</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @foreach($paymentMethods as $method)
                    <tr>
                        <td class="px-4 py-2">{{ $method->bank_name }}</td>
                        <td class="px-4 py-2">{{ $method->account_number }}</td>
                        <td class="px-4 py-2">{{ $method->account_name }}</td>
                        <td class="px-4 py-2">
                            @if($method->image_path)
                                <a href="{{ asset('storage/' . $method->image_path) }}" target="_blank" class="text-blue-500 underline">Lihat</a>
                            @else
                            -
                            @endif
                        </td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('admin.payment.methods.edit', $method->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                            <form action="{{ route('admin.payment.methods.destroy', $method->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus metode ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
