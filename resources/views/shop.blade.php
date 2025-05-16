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

    <main x-data="{
        activeCategory: 'all',
        sortOption: 'featured',
        searchQuery: '',
        showFilters: false,
        priceRange: 50,
        organicOnly: false,
    }" class="min-h-screen">
        <!-- Hero Banner -->
        <section class="relative bg-green-700 dark:bg-green-800 text-white py-16">
            <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('images/shop-banner.jpg') }}');"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Farm Fresh Products</h1>
                <p class="text-xl max-w-2xl">Discover our selection of organic, sustainably grown produce and farm products, delivered from our fields to your table.</p>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-green-50 dark:from-gray-900 to-transparent"></div>
        </section>

        <!-- Shop Content -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <!-- Mobile Filter Toggle -->
                <div class="md:hidden mb-6">
                    <button @click="showFilters = !showFilters" class="w-full bg-white dark:bg-gray-800 border border-green-200 dark:border-gray-700 rounded-lg py-3 px-4 flex justify-between items-center text-green-800 dark:text-green-200">
                        <span>Filters & Categories</span>
                        <i class="fas" :class="showFilters ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                </div>

                <div class="flex flex-col md:flex-row gap-8">
  <!-- Sidebar Filter -->
<div :class="{'hidden md:block': !showFilters, 'block': showFilters}" class="w-full md:w-1/4 lg:w-1/5">
    <form action="{{ route('shop') }}" method="GET">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 sticky top-24">
            <h2 class="text-xl font-bold text-green-800 dark:text-green-200 mb-4">Categories</h2>

            <div class="space-y-2 mb-8">
                <button type="submit" name="category" value="all"
                    class="category-btn w-full text-left py-2 px-3 rounded-md transition-colors duration-200 hover:bg-green-100 dark:hover:bg-gray-700">
                    All Products
                </button>
            </div>

            <h2 class="text-xl font-bold text-green-800 dark:text-green-200 mb-4">Filters</h2>

            <div class="space-y-6">
                <div class="flex items-center">
                    <div class="space-y-2">
                        @foreach($category as $cat)
                            <div class="flex items-center">
                                <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                                    id="category_{{ $cat->id }}"
                                    class="w-4 h-4 text-green-600 border-green-300 rounded focus:ring-green-500"
                                    {{ in_array($cat->id, request()->get('categories', [])) ? 'checked' : '' }}>
                                <label for="category_{{ $cat->id }}" class="ml-2 text-sm font-medium">
                                    {{ $cat->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-green-100 dark:border-gray-700">
                <button type="submit"
                    class="w-full bg-green-100 dark:bg-gray-700 text-green-800 dark:text-green-200 py-2 px-4 rounded-md hover:bg-green-200 dark:hover:bg-gray-600 transition-colors duration-200">
                    Terapkan Filter
                </button>
            </div>
        </div>
    </form>
</div>


                    <!-- Products Grid -->
                    <div class="w-full md:w-3/4 lg:w-4/5">
                        <!-- Search and Sort -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                            <div class="relative w-full sm:w-auto">
                                <input type="text" x-model="searchQuery" placeholder="Search products..." class="w-full sm:w-64 pl-10 pr-4 py-2 border border-green-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-800 text-green-800 dark:text-green-200">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-green-400 dark:text-green-500"></i>
                            </div>
                            <div class="flex items-center space-x-2 w-full sm:w-auto">
                                <label class="text-sm whitespace-nowrap">Sort by:</label>
                                <select x-model="sortOption" class="border border-green-200 dark:border-gray-700 rounded-lg py-2 px-4 bg-white dark:bg-gray-800 text-green-800 dark:text-green-200 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="featured">Featured</option>
                                    <option value="price-low">Price: Low to High</option>
                                    <option value="price-high">Price: High to Low</option>
                                    <option value="name-asc">Name: A to Z</option>
                                    <option value="name-desc">Name: Z to A</option>
                                </select>
                            </div>
                        </div>

                   <!-- Alpine wrapper -->
<div x-data="{ open: false, selectedProduct: {} }" @keydown.escape.window="open = false">

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $index => $product)
        <div class="product-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full animate-fade-in" style="animation-delay: {{ $index * 50 }}ms">

            <div class="relative overflow-hidden group h-48">
                <img src="{{ asset('storage/images/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-md">

                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <button 
                        @click="selectedProduct = {
                            id: {{ $product->id }},
                            name: '{{ $product->name }}',
                            description: '{{ $product->description }}',
                            price: '{{ number_format($product->price, 3) }}',
                            image_url: '{{ asset('storage/images/' . $product->image_url) }}'
                        }; open = true"
                        type="button"
                        class="bg-white dark:bg-gray-800 text-green-800 dark:text-green-200 font-bold py-2 px-4 rounded-full hover:bg-green-600 dark:hover:bg-green-500 hover:text-white transition-colors duration-300">
                        Quick View
                    </button>
                </div>

                @if($product->organic)
                <div class="absolute top-2 left-2 bg-green-600 dark:bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                    Organic
                </div>
                @endif
            </div>

            <div class="p-4 flex-grow">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-lg font-semibold text-green-800 dark:text-green-200">{{ $product->name }}</h3>
                    <span class="text-green-600 dark:text-green-400 font-bold">Rp{{ number_format($product->price, 0) }}</span>
                </div>
                <p class="text-green-700 dark:text-green-300 text-sm mb-4">{{ $product->description }}</p>
            </div>

            <div class="p-4 pt-0">
                <form onsubmit="addToCart(event, {{ $product->id }})" class="flex flex-col items-center relative">
                    @csrf
                    <div class="flex items-center space-x-2 mb-2">
                        <label for="quantity" class="text-sm text-green-800 dark:text-green-200">Quantity:</label>
                        <input id="quantity-{{ $product->id }}" type="number" min="1" value="1" class="w-16 border rounded px-2 py-1 text-center">
                    </div>
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition-colors duration-300 flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                    </button>
                </form>
                
                    
                </form>
                
            </div>

        </div>
        @empty
        <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-lg mt-6">
            <i class="fas fa-leaf text-green-300 dark:text-green-700 text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold text-green-800 dark:text-green-200 mb-2">No products found</h3>
            <p class="text-green-600 dark:text-green-400">Try adjusting your filters or search query</p>
        </div>
        @endforelse
    </div>

    <!-- Overlay Backdrop (klik luar modal close) -->
    <div x-show="open" 
         @click.self="open = false"
         x-transition.opacity
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40">
         
        <!-- Modal -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             class="bg-white dark:bg-gray-800 rounded-lg p-8 w-full max-w-xl relative z-50">
             
            <button @click="open = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">
                ✕
            </button>

            <div class="text-center">
                <img :src="selectedProduct.image_url" alt="" class="w-60 h-60 object-cover mx-auto rounded mb-6">
                <h2 class="text-2xl font-bold mb-2 text-green-700 dark:text-green-200" x-text="selectedProduct.name"></h2>
                <p class="text-green-600 font-bold text-xl mb-3">Rp<span x-text="selectedProduct.price"></span></p>
                <p class="text-gray-600 dark:text-green-300 text-sm mb-6" x-text="selectedProduct.description"></p>

                <form onsubmit="addToCartModal(event)" class="relative">
                    @csrf
                    <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 text-white font-bold py-2 px-6 rounded-full transition-colors duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

                        <!-- Empty State -->
                        <div x-show="products
                            .filter(p => activeCategory === 'all' || p.category === activeCategory)
                            .filter(p => !organicOnly || p.organic)
                            .filter(p => p.price <= priceRange)
                            .filter(p => searchQuery === '' || p.name.toLowerCase().includes(searchQuery.toLowerCase()) || p.description.toLowerCase().includes(searchQuery.toLowerCase()))
                            .length === 0" 
                            class="text-center py-16 bg-white dark:bg-gray-800 rounded-lg mt-6">
                            <i class="fas fa-leaf text-green-300 dark:text-green-700 text-5xl mb-4"></i>
                            <h3 class="text-xl font-semibold text-green-800 dark:text-green-200 mb-2">No products found</h3>
                            <p class="text-green-600 dark:text-green-400">Try adjusting your filters or search query</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Collections -->
        <section class="py-16 bg-green-100 dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-green-800 dark:text-green-200 mb-12">
                    Seasonal Collections
                    <span class="block w-24 h-1 bg-green-600 dark:bg-green-400 mx-auto mt-4"></span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($collections as $collection)
                    <div class="relative overflow-hidden rounded-lg shadow-lg group h-64">
                        <img src="{{ asset('images/' . $collection['image']) }}" 
                             alt="{{ $collection['name'] }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-green-900 to-transparent opacity-70"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold mb-1">{{ $collection['name'] }}</h3>
                            <p class="mb-3 text-sm">{{ $collection['description'] }}</p>
                        </div>
                    </div>
                @endforeach                
                </div>
            </div>
        </section>

        <!-- Newsletter -->
        <section class="py-16 bg-green-800 dark:bg-gray-900 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('{{ asset('images/pattern.png') }}');"></div>
            <div class="container mx-auto px-4 text-center relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Stay Updated</h2>
                <p class="mb-8 text-lg max-w-2xl mx-auto">Subscribe to receive updates on new products, seasonal harvests, and exclusive offers!</p>
                <form class="max-w-md mx-auto flex">
                </form>
            </div>
        </section>
    </main>

    <footer class="bg-green-900 dark:bg-gray-900 text-white py-12 relative overflow-hidden">
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
        function addToCart(event, productId) {
            event.preventDefault();
        
            const button = event.currentTarget.querySelector('button');

            const form = event.currentTarget;
const quantityInput = form.querySelector('input[type="number"]');
const quantity = parseInt(quantityInput?.value || 1);


        
            const productCard = button.closest('.product-card');
            const img = productCard.querySelector('img');
            const imgClone = img.cloneNode(true);
            const cartIcon = document.getElementById('cart-icon');
        
            // Buat animasi terbang
            const rect = img.getBoundingClientRect();
            imgClone.style.position = 'fixed';
            imgClone.style.left = rect.left + 'px';
            imgClone.style.top = rect.top + 'px';
            imgClone.style.width = img.offsetWidth + 'px';
            imgClone.style.zIndex = 1000;
            imgClone.style.transition = 'all 0.8s ease-in-out';
            document.body.appendChild(imgClone);
        
            const cartRect = cartIcon.getBoundingClientRect();
            setTimeout(() => {
                imgClone.style.left = cartRect.left + 'px';
                imgClone.style.top = cartRect.top + 'px';
                imgClone.style.opacity = 0;
                imgClone.style.transform = 'scale(0.2)';
            }, 10);
        
            setTimeout(() => {
                imgClone.remove();
            }, 800);
        
            // Fetch API - kirim data ke server
            fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('cart-count').innerText = data.cart_count;
                }
            })
            .catch(err => console.error('Gagal add to cart:', err));
        }
        </script>
</body>
</html>
