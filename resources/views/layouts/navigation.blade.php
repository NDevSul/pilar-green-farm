<nav class="flex items-center justify-between">
    <ul class="flex space-x-6 text-green-800 dark:text-green-200 mr-6">
        @foreach(['Home', 'Shop', 'Contact'] as $item)
            <li>
                <a href="{{ $item === 'Home' ? '/' : '/' . strtolower($item) }}" 
                   class="hover:text-green-600 dark:hover:text-green-400 transition-colors relative group">
                    {{ $item }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 dark:bg-green-400 transition-all group-hover:w-full"></span>
                </a>
            </li>
        @endforeach
    </ul>

    <div class="flex items-center space-x-4">
        <!-- Cart Icon -->
        <a href="/cart" id="cart-icon">
            <i class="fas fa-shopping-cart"></i>
        </a>
        
        <!-- Profile -->
        @auth
        <a href="{{ route('profile.edit') }}" class="...">
            <i class="fas fa-user-circle"></i>
        </a>
        @endauth
        
    

        <a href="{{ route('orders.pending') }}" class="hover:text-green-300 text-xl" title="Pending Orders">
            <i class="fas fa-clock"></i>
        </a>
        
                <!-- Auth Buttons -->
                @auth
                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-green-800 dark:text-green-200 hover:text-red-500 transition-colors text-sm font-semibold">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            @else
                <!-- Login Link -->
                <a href="{{ route('login') }}" class="text-green-800 dark:text-green-200 hover:text-green-600 transition-colors text-sm font-semibold">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login
                </a>
            @endauth
    </div>
</nav>
