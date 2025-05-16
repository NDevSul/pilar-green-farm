<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Pending - Pilar Green Farm</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

<body class="bg-green-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <main class="max-w-5xl mx-auto py-8 px-4 sm:px-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Pesanan Pending Kamu</h2>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-100">
                {{ count($pendingOrders) }} Pesanan
            </span>
        </div>

        @forelse ($pendingOrders as $order)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 mb-6 overflow-hidden transition hover:shadow-md">
                <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center justify-between">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-gray-900 dark:text-white">Order #{{ $order->id }}</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100">
                                Pending
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $order->created_at->format('d M Y • H:i') }}</p>
                    </div>
                    <div class="mt-3 sm:mt-0">
                        <span class="font-semibold text-gray-900 dark:text-white">
                            Rp{{ number_format($order->orderItems->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Produk yang dipesan:</h3>
                    <ul class="space-y-2">
                        @foreach ($order->orderItems as $item)
                            <li class="flex items-start">
                                <div class="w-2 h-2 rounded-full bg-green-500 dark:bg-green-400 mt-2"></div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $item->product->name }}</p>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        Qty: {{ $item->quantity }} • Rp{{ number_format($item->price, 0, ',', '.') }} / item
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="px-5 py-4 bg-gray-50 dark:bg-gray-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Segera selesaikan pembayaran Anda.</p>
                    </div>
                    <a href="{{ route('payment.instructions', $order->id) }}" class="inline-flex items-center px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">
                        Lanjutkan Pembayaran
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 mb-4">
                    <i class="fas fa-shopping-basket text-2xl text-gray-400 dark:text-gray-300"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Tidak ada pesanan pending</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Anda belum memiliki pesanan yang menunggu pembayaran</p>
                <a href="{{ route('shop') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">
                    Mulai Belanja
                    <i class="fas fa-shopping-cart ml-2"></i>
                </a>
            </div>
        @endforelse
    </main>

</body>
</html>
