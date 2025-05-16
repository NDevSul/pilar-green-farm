<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\SeasonalCollectionController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', [ProductController::class, 'landing'])->name('landing');


// Auth routes
require __DIR__ . '/auth.php';

// Admin dashboard (khusus admin)
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

// Shop routes (public access)
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

// Product create (admin only)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/products/create', function () {
        $categories = Category::all();
        $products = Product::latest()->with('category')->get();
        return view('admin.products.create', compact('categories', 'products'));
    })->name('admin.products.create');

    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');  


    // Category
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/quick-add', [CategoryController::class, 'quickAdd'])->name('categories.quickAdd');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    // Order management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::post('/orders/{order}/verify', [AdminOrderController::class, 'verify'])->name('admin.orders.verify');
    Route::post('/admin/orders/{order}/verify', [AdminOrderController::class, 'verify']);

    // Seasonal collections
    Route::resource('collections', SeasonalCollectionController::class);
    Route::get('/seasonal/create', [SeasonalCollectionController::class, 'create'])->name('admin.seasonal.create');

    // Payment Methods
    Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('admin.payment.methods.index');
    Route::get('/payment-methods/create', [PaymentMethodController::class, 'create'])->name('admin.payment.methods.create');
    Route::post('/payment-methods', [PaymentMethodController::class, 'store'])->name('admin.payment.methods.store');
    Route::get('/payment-methods/{paymentMethod}/edit', [PaymentMethodController::class, 'edit'])->name('admin.payment.methods.edit');
    Route::put('/payment-methods/{paymentMethod}', [PaymentMethodController::class, 'update'])->name('admin.payment.methods.update');
    Route::delete('/payment-methods/{paymentMethod}', [PaymentMethodController::class, 'destroy'])->name('admin.payment.methods.destroy');
});

// History Cart (authenticated customer only)
Route::middleware('auth')->group(function () {
    Route::get('/orders/pending', [OrderController::class, 'pendingOrders'])->name('orders.pending');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


    // Checkout & Payment
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/payment/instructions/{order}', [PaymentController::class, 'instructions'])->name('payment.instructions');
    Route::post('/payment/notify/{order}', [PaymentController::class, 'notifyPaid'])->name('payment.notify');
    Route::post('/payment/upload/{order}', [PaymentController::class, 'uploadProof'])->name('payment.upload');
});

// Static pages
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');


Route::get('/dashboard', function () {
    $totalProducts = Product::count();
    $totalOrders = Order::count();
    $totalCustomers = \App\Models\User::where('role', 'user')->count(); // opsional
    return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalCustomers'));
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');