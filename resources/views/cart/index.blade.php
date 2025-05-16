<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shop - Pilar Green Farm</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <script src="//unpkg.com/alpinejs" defer></script>
        <style>
            .product-img-hover {
                transition: transform 0.5s ease, filter 0.5s ease;
            }
            .product-card:hover .product-img-hover {
                transform: scale(1.05);
                filter: brightness(1.1);
            }
            .category-btn.active {
                @apply bg-green-600 text-white;
            }
            .dark .category-btn.active {
                @apply bg-green-500 text-white;
            }
            .custom-scrollbar::-webkit-scrollbar {
                width: 6px;
                height: 6px;
            }
            .custom-scrollbar::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
            .dark .custom-scrollbar::-webkit-scrollbar-track {
                background: #374151;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #88b06a;
                border-radius: 3px;
            }
            .dark .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #4ade80;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #6b9e47;
            }
            .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #22c55e;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fadeIn 0.5s ease forwards;
            }
        </style>
    </head>
    <body class="bg-green-50 text-green-900 dark:bg-gray-900 dark:text-green-100 transition-colors duration-300">
        <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50 transition-all duration-300 ease-in-out hover:shadow-md">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-leaf text-green-600 dark:text-green-400 text-2xl"></i>
                    <span class="text-2xl font-bold text-green-800 dark:text-green-200 font-serif">Pilar Green Farm</span>
                </div>
                @include('layouts.navigation')
            </div>
        </header>

    <main class="min-h-screen py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-start gap-8">
                <!-- Cart Items -->
                <div class="w-full md:w-2/3 bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="p-6 border-b border-green-100 dark:border-gray-700">
                        <h1 class="text-2xl font-bold text-green-800 dark:text-green-200 flex items-center">
                            <i class="fas fa-shopping-cart mr-3"></i> Your Cart
                        </h1>
                    </div>
    
                    @if($cartItems->isEmpty())
                        <div class="p-12 text-center">
                            <div class="w-24 h-24 mx-auto mb-6 flex items-center justify-center rounded-full bg-green-50 dark:bg-gray-700">
                                <i class="fas fa-shopping-basket text-4xl text-green-300 dark:text-green-500"></i>
                            </div>
                            <h2 class="text-xl font-semibold text-green-800 dark:text-green-200 mb-2">Your cart is empty</h2>
                            <a href="/shop" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-full">
                                <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                            </a>
                        </div>
                    @else
                        <div class="divide-y divide-green-100 dark:divide-gray-700">
                            @foreach ($cartItems as $item)
                            <div class="p-6 flex flex-col sm:flex-row items-center gap-4 border-b border-gray-200 dark:border-gray-700">
                                <!-- Produk Gambar -->
                                <div class="w-24 h-24 rounded-md overflow-hidden flex-shrink-0">
                                    <img src="{{ asset('storage/images/' . $item->product->image_url) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                 </div>
                            
                                <!-- Info Produk -->
                                <div class="flex-grow">
                                    <h3 class="text-lg font-semibold text-green-800 dark:text-green-200">{{ $item->product->name }}</h3>
                                    <p class="text-green-600 dark:text-green-400 font-bold mt-1">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    <p class="text-green-500 dark:text-green-400 text-sm mt-1">Qty: {{ $item->quantity }}</p>
                            
                                    <!-- Form Update Quantity -->
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 border rounded px-2 py-1 text-center">
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 text-white font-bold py-1 px-4 rounded-full mt-2">
                                            Update
                                        </button>
                                    </form>
                                </div>
                            
                                <!-- Total Harga Produk -->
                                <div class="text-right flex-shrink-0">
                                    <p class="font-bold text-green-800 dark:text-green-200">
                                        Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                    </p>
                            
                                    <!-- Tombol Remove -->
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                            <i class="fas fa-trash-alt mr-1"></i> Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
    
                        <!-- Checkout Button -->
                        <div class="p-6 border-t border-green-100 dark:border-gray-700 text-right">
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg">
                                    <i class="fas fa-lock mr-2"></i> Proceed to Checkout
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
    
                <!-- Order Summary -->
                <div class="w-full md:w-1/3 bg-white dark:bg-gray-800 rounded-lg shadow-md sticky top-24">
                    <div class="p-6 border-b border-green-100 dark:border-gray-700">
                        <h2 class="text-xl font-bold text-green-800 dark:text-green-200">Order Summary</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        @php
                            $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
                        @endphp
                        <div class="flex justify-between">
                            <span class="text-green-700 dark:text-green-300">Subtotal</span>
                            <span class="font-semibold text-green-800 dark:text-green-200">
                                Rp{{ number_format($subtotal, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-green-700 dark:text-green-300">Shipping</span>
                            <span class="text-green-800 dark:text-green-200">Calculated at checkout</span>
                        </div>
                        <div class="pt-4 border-t border-green-100 dark:border-gray-700 flex justify-between">
                            <span class="text-lg font-bold text-green-800 dark:text-green-200">Total</span>
                            <span class="text-lg font-bold text-green-800 dark:text-green-200">
                                Rp{{ number_format($subtotal, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    

    <footer class="bg-green-900 dark:bg-gray-900 text-white py-12 relative overflow-hidden mt-16">
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Pilar Green Farm</h3>
                    <p class="mb-4">Bringing nature's best to your doorstep since 2010.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-green-400 transition-colors">
                            <i class="fab fa-facebook fa-lg"></i>
                        </a>
                        <a href="#" class="text-white hover:text-green-400 transition-colors">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                        <a href="#" class="text-white hover:text-green-400 transition-colors">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Shop</h3>
                    <ul class="space-y-2">
                        @foreach(['Vegetables', 'Fruits', 'Dairy', 'Meat', 'Pantry'] as $category)
                            <li>
                                <a href="/shop?category={{ strtolower($category) }}" 
                                   class="hover:text-green-400 transition-colors">
                                    {{ $category }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Information</h3>
                    <ul class="space-y-2">
                        @foreach(['About Us', 'Sustainability', 'Farm Tours', 'Blog', 'FAQ'] as $item)
                            <li>
                                <a href="/{{ strtolower(str_replace(' ', '-', $item)) }}" 
                                   class="hover:text-green-400 transition-colors">
                                    {{ $item }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Contact Us</h3>
                    <p>123 Farm Road, Green Valley</p>
                    <p>Phone: (123) 456-7890</p>
                    <p>Email: info@pilargreenform.com</p>
                    <p class="mt-4">Open: Mon-Sat, 8am-6pm</p>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-green-700 text-center">
                <p>&copy; {{ date('Y') }} Pilar Green Farm. All rights reserved.</p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-green-950 dark:from-gray-950 to-transparent"></div>
    </footer>

    <script>
        // Initialize dark mode from localStorage
        document.addEventListener('alpine:init', () => {
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        });
    </script>
</body>
</html>