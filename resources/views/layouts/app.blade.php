<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Pilar Green Farm')</title>
    
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
    
        <!-- Alpine.js -->
        <script src="//unpkg.com/alpinejs" defer></script>
    
        <!-- ✅ Font Awesome: public CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-rX5q0fvR31KzqQdqvFZlJ4zZrTk5uhL2U6v3Uz0N+GAnsdOfrv2ZWYndxzMfKJm0v2ehLT7zzEZUJrS8zU7ZFg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    
<body x-data="{ darkMode: false }" :class="{ 'dark': darkMode }" class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-100">

    @if(auth()->check() && auth()->user()->role !== 'admin')
    @include('layouts.navigation')
@else
    <header class="bg-green-700 text-white py-4 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-leaf text-green-400 text-2xl"></i>
                <span class="text-2xl font-bold font-serif">Pilar Green Farm</span>
            </div>
            <nav class="flex items-center space-x-6">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-green-300">Dashboard</a>
                <a href="{{ route('admin.orders.index') }}" class="hover:text-green-300">Kelola Order</a>
                <a href="{{ route('admin.payment.methods.index') }}" class="hover:text-green-300">Metode Pembayaran</a>
                <a href="{{ route('categories.index') }}" class="hover:text-green-300">Kelola Kategori</a> {{-- ✅ Tambahan --}}
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="hover:text-red-300">
                   Logout
                </a>
            </nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </header>
@endif


    <!-- Main -->
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

</body>
</html>