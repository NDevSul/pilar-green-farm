<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Instruksi Pembayaran - Pilar Green Farm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-rX5q0fvR31KzqQdqvFZlJ4zZrTk5uhL2U6v3Uz0N+GAnsdOfrv2ZWYndxzMfKJm0v2ehLT7zzEZUJrS8zU7ZFg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50 transition-all duration-300 ease-in-out hover:shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <i class="fas fa-leaf text-green-600 dark:text-green-400 text-2xl"></i>
            <span class="text-2xl font-bold text-green-800 dark:text-green-200 font-serif">Pilar Green Farm</span>
        </div>
        @include('layouts.navigation')
    </div>
</header>

<body class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-white" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">

    <!-- Main -->
    <main class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 shadow rounded mt-6"
        x-data="{
            method: '{{ $paymentMethods->first()?->id ?? '' }}',
            methods: {{ Js::from($paymentMethods->keyBy('id')) }}
        }">

        <h2 class="text-2xl font-bold mb-4 text-green-800 dark:text-green-100">Instruksi Pembayaran</h2>

        <p class="mb-4 text-green-700 dark:text-green-300">
            Silakan pilih metode pembayaran dan transfer total berikut ke rekening Pilar Green Farm:
        </p>

        @php
            $total = $order->orderItems->sum(fn($item) => $item->price * $item->quantity);
            $totalFormatted = 'Rp' . number_format($total, 0, ',', '.');
        @endphp

        <!-- Dropdown -->
        <div class="mb-4">
            <label class="font-semibold text-green-800 dark:text-green-100 mb-2 block">Pilih Metode Pembayaran</label>
            <select x-model="method" class="border rounded w-full px-4 py-2 dark:bg-gray-700 dark:text-white">
                @foreach($paymentMethods as $m)
                    <option value="{{ $m->id }}">{{ $m->bank_name }} - {{ $m->account_number }}</option>
                @endforeach
            </select>
        </div>

        <!-- Detail Pembayaran -->
        <template x-if="methods[method]">
            <div class="bg-green-50 dark:bg-gray-700 p-4 rounded shadow mt-2">
                <h4 class="text-green-800 dark:text-green-100 font-semibold mb-2">Detail Metode Pembayaran</h4>
                <div class="space-y-1 text-green-900 dark:text-green-100">
                    <p><strong>Bank :</strong> <span x-text="methods[method].bank_name"></span></p>
                    <p><strong>No. Rekening :</strong> <span x-text="methods[method].account_number"></span></p>
                    <p><strong>Atas Nama :</strong> <span x-text="methods[method].account_name"></span></p>
                </div>

                <template x-if="methods[method].image_path">
                    <div class="mt-4 text-center">
                        <p class="font-semibold mb-2">QRIS :</p>
                        <img :src="'/storage/' + methods[method].image_path" alt="QRIS" class="w-48 h-48 mx-auto rounded border">
                    </div>
                </template>
            </div>
        </template>

        <!-- Total -->
        <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 p-4 rounded my-6">
            <div class="flex justify-between items-center">
                <p><strong>Total:</strong> <span>{{ $totalFormatted }}</span></p>
            </div>
        </div>

        <!-- Detail Pesanan -->
        <h3 class="text-lg font-semibold mb-2 text-green-700 dark:text-green-200">Detail Pesanan:</h3>
        <ul class="mb-6 list-disc pl-6 text-green-800 dark:text-green-100">
            @foreach ($order->orderItems as $item)
                <li>{{ $item->product->name }} × {{ $item->quantity }}</li>
            @endforeach
        </ul>

        <!-- Bukti Transfer -->
        @if (!$order->notified_seller)
        <form action="{{ route('payment.upload', $order->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateProof()">
            @csrf
            <div class="mb-4">
                <label for="payment_proof" class="block font-semibold mb-2 text-green-800 dark:text-green-100">Upload Bukti Transfer</label>
                <input type="file" name="payment_proof" id="payment_proof" accept="image/*" class="block w-full border rounded p-2 bg-white dark:bg-gray-700 text-green-900 dark:text-white" required>
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                Saya Sudah Bayar
            </button>
        </form>
        @else
            <div class="text-green-600 dark:text-green-400 font-semibold mt-6">✔️ Kamu sudah menandai sebagai "Sudah Bayar". Tunggu konfirmasi admin.</div>
            @if($order->payment_proof)
                <div class="mt-4">
                    <p class="text-green-600 dark:text-green-400 font-semibold">📎 Bukti sudah diupload:</p>
                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="text-blue-600 underline">
                        Lihat Bukti Transfer
                    </a>
                </div>
            @endif
        @endif
    </main>

    <script>
        function validateProof() {
            const input = document.getElementById('payment_proof');
            if (!input || input.files.length === 0) {
                alert('Mohon upload bukti transfer sebelum menekan tombol "Saya Sudah Bayar".');
                return false;
            }
            return true;
        }
    </script>

</body>
</html>
