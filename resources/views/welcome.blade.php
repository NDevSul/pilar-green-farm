<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilar Green Farm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes slowZoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        .animate-slow-zoom {
            animation: slowZoom 20s infinite alternate;
        }
        .dark .invert-on-dark {
            filter: invert(1) brightness(1.5);
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

    <main>
        <section class="relative h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center animate-slow-zoom" 
                 style="background-image: url('{{ asset('images/Greenfield.png') }}');"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-green-900 dark:to-gray-900 opacity-60"></div>
            <div class="relative z-10 text-white text-center max-w-3xl px-4">
                <h1 class="text-5xl md:text-6xl font-bold mb-4">Fresh from Our Fields to Your Table</h1>
                <p class="text-xl md:text-2xl mb-8">Experience the taste of nature with our organic eggs and produce</p>
                <a href="/shop" 
                   class="bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 text-white font-bold py-3 px-8 rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg inline-flex items-center">
                    Shop Now
                    <i class="fas fa-shopping-bag ml-2"></i>
                </a>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-green-50 dark:from-gray-900 to-transparent"></div>
        </section>

        <section class="py-16 bg-white dark:bg-gray-800 relative overflow-hidden">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 dark:text-green-200 mb-12 relative z-10">
                    Our Featured Products
                    <span class="block w-24 h-1 bg-green-600 dark:bg-green-400 mx-auto mt-4"></span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                   @foreach($products as $product)
    <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 border border-gray-100 dark:border-gray-700">
        <div class="relative overflow-hidden">
            <img src="{{ asset('storage/images/' . $product->image_url) }}" alt="{{ $product->name }}" 
                 class="w-full h-64 object-cover transition-transform duration-500 ease-in-out hover:scale-105">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                <a href="{{ route('shop') }}" 
                   class="bg-white/90 dark:bg-gray-800/90 text-green-700 dark:text-green-300 font-medium py-2.5 px-5 rounded-lg hover:bg-green-50 dark:hover:bg-green-700 transition-colors duration-300 transform translate-y-1 hover:translate-y-0">
                    Quick View
                </a>
            </div>
        </div>
        <div class="p-5">
            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-2">{{ $product->name }}</h3>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
            </form>
        </div>
    </div>
@endforeach
                </div>
            </div>
        </section>

 <section class="py-16 bg-green-100 dark:bg-gray-700 relative overflow-hidden">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 dark:text-green-200 mb-12 relative z-10">
            About Pilar Green Farm
            <span class="block w-24 h-1 bg-green-600 dark:bg-green-400 mx-auto mt-4"></span>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="relative max-w-md mx-auto">
                <div class="overflow-hidden rounded-lg shadow-lg p-4 bg-white dark:bg-gray-800">
                    <img 
                        src="{{ asset('images/pilar bali logo.png') }}" 
                        alt="Pilar Green Farm" 
                        class="w-full h-auto object-contain transform hover:scale-102 transition-transform duration-300 ease-in-out"
                    >
                </div>
                <div class="absolute inset-0 bg-gradient-to-tr from-green-600 dark:from-green-500 to-transparent opacity-20 rounded-lg pointer-events-none"></div>
            </div>
            <div class="bg-white/80 dark:bg-gray-800/80 p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-green-700 dark:text-green-300 mb-4">Our Story</h3>
                <p class="text-green-800 dark:text-green-100 mb-6 leading-relaxed">
                    Founded in 2010, Pilar Green Farm started as a small family venture with a big dream: to provide our community with the freshest, most nutritious produce while nurturing the land we call home. Over the years, we've grown from a modest egg operation to a diverse, sustainable farm that's proud to be a cornerstone of local, organic agriculture.
                </p>
                <h3 class="text-2xl font-semibold text-green-700 dark:text-green-300 mb-4">Our Mission</h3>
                <p class="text-green-800 dark:text-green-100 mb-6 leading-relaxed">
                    At Pilar Green Farm, our mission is to cultivate health - for our soil, our animals, our community, and our planet. We believe that by working in harmony with nature, we can produce food that's not only delicious but also contributes to the well-being of all.
                </p>
            </div>
        </div>
    </div>
</section>


        <section class="py-16 bg-white dark:bg-gray-800 relative overflow-hidden">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 dark:text-green-200 mb-12 relative z-10">
                    Our Sustainable Practices
                    <span class="block w-24 h-1 bg-green-600 dark:bg-green-400 mx-auto mt-4"></span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach([
                        ['title' => 'Organic Farming', 'icon' => 'fa-seedling', 'description' => 'We use only natural fertilizers and pest control methods to grow our produce.'],
                        ['title' => 'Water Conservation', 'icon' => 'fa-tint', 'description' => 'Our advanced irrigation systems minimize water waste and maximize efficiency.'],
                        ['title' => 'Renewable Energy', 'icon' => 'fa-solar-panel', 'description' => 'Solar panels power our farm, reducing our carbon footprint significantly.']
                    ] as $practice)
                        <div class="bg-green-50 dark:bg-gray-700 p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-xl">
                            <i class="fas {{ $practice['icon'] }} text-4xl text-green-600 dark:text-green-400 mb-4"></i>
                            <h3 class="text-xl font-semibold text-green-800 dark:text-green-200 mb-2">{{ $practice['title'] }}</h3>
                            <p class="text-green-700 dark:text-green-300">{{ $practice['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-16 bg-green-800 dark:bg-gray-900 text-white relative overflow-hidden">
            <div class="container mx-auto px-4 text-center relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold mb-8">Join Our Community</h2>
                <p class="mb-8 text-lg max-w-2xl mx-auto">Subscribe to our newsletter for farm updates, seasonal recipes, and exclusive offers!</p>
                <form class="max-w-md mx-auto flex">
                    <input type="email" placeholder="Enter your email" 
                           class="flex-grow px-4 py-2 rounded-l-full focus:outline-none focus:ring-2 focus:ring-green-500 text-green-800 dark:text-green-200 dark:bg-gray-700 dark:border-gray-600">
                    <button type="submit" 
                            class="bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 px-6 py-2 rounded-r-full transition-colors duration-300 flex items-center">
                        Subscribe
                        <i class="fas fa-chevron-right ml-2"></i>
                    </button>
                </form>
            </div>
            <div class="absolute top-0 left-0 w-full h-full bg-[url('{{ asset('images/pattern.png') }}')] opacity-10"></div>
        </section>
    </main>

    <footer class="bg-green-900 dark:bg-gray-900 text-white py-12 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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
                    <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        @foreach(['Shop', 'About Us', 'Contact', 'FAQ'] as $item)
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
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-green-700 text-center">
                <p>&copy; {{ date('Y') }} Pilar Green Farm. All rights reserved.</p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-green-950 dark:from-gray-950 to-transparent"></div>
    </footer>

    <script>
        // Add any custom JavaScript here
    </script>
</body>
</html>