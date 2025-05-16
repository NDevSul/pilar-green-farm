<!DOCTYPE html>
<html lang="en">
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

    <main class="max-w-4xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold mb-4 text-green-700">Tentang Pilar Green Farm</h1>
        <p class="mb-4">Pilar Green Farm menyediakan produk pertanian segar langsung dari petani ke meja Anda. Kami fokus pada kualitas, keberlanjutan, dan pengalaman belanja yang ramah lingkungan.</p>
        <p>Dengan komitmen kami terhadap pertanian lokal, kami berharap membangun jembatan antara produsen dan konsumen yang lebih sehat dan transparan.</p>
    </main>
</body>
</html>
