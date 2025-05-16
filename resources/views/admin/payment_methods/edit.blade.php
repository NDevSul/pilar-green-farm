@extends('layouts.app')

@section('title', 'Edit Metode Pembayaran')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg mt-10 p-8">
    <h2 class="text-2xl font-bold text-green-700 dark:text-green-200 mb-6 text-center">Edit Metode Pembayaran</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif


    <form action="{{ route('admin.payment.methods.update', $method->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')    
    
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Nama Metode Pembayaran</label>
            <input type="text" name="bank_name" value="{{ old('bank_name', $method->bank_name) }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-green-500 bg-white dark:bg-gray-700 text-gray-800 dark:text-white" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Nomor / ID Pembayaran</label>
            <input type="text" name="account_number" value="{{ old('account_number', $method->account_number) }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-green-500 bg-white dark:bg-gray-700 text-gray-800 dark:text-white" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Nama Akun</label>
            <input type="text" name="account_name" value="{{ old('account_name', $method->account_name) }}"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-green-500 bg-white dark:bg-gray-700 text-gray-800 dark:text-white" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Gambar QR Code</label>
         
            <input type="file" name="qris_image" accept="image/*"
                   class="w-full border border-gray-300 dark:border-gray-600 px-4 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-white rounded-md">
            
            @if($method->qris_image)
                <p class="text-sm mt-2 text-gray-500 dark:text-gray-400">Gambar QR saat ini:</p>
                <img src="{{ asset('storage/payment_qr/' . $method->qris_image) }}"
                     class="mt-2 w-32 h-32 object-contain rounded border shadow">
                     
            @endif
        </div>
    
        <div class="text-center">
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md transition-all shadow-md">
                Simpan Perubahan
            </button>
        </div>

        </form>
</div>
@endsection




