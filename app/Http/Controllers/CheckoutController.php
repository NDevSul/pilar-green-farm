<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;


class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

    $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
    }

    $order = Order::create([
        'user_id' => $user->id,
        'status' => 'pending',
        'notified_seller' => false,
    ]);

    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->product->price,
        ]);
    }

    CartItem::where('user_id', $user->id)->delete();

    return redirect()->route('payment.instructions', ['order' => $order->id]);

    }
}
