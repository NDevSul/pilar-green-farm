<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function index()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        return view('cart.index', compact('cartItems'));
    }
    
    public function add(Request $request, $productId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $user = Auth::user();
    $cartItem = CartItem::where('user_id', $user->id)
        ->where('product_id', $productId)
        ->first();

    if ($cartItem) {
        $cartItem->quantity += $request->quantity;
        $cartItem->save();
    } else {
        CartItem::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'quantity' => $request->quantity
        ]);
    }

    if ($request->expectsJson()) {
        $cartCount = CartItem::where('user_id', $user->id)->sum('quantity');
        return response()->json([
            'success' => true,
            'cart_count' => $cartCount
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
}

    
    public function remove($id)
    {
        CartItem::where('id', $id)->where('user_id', Auth::id())->delete();
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
    
        $cartItem = CartItem::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
    
        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui!');
    }
    

}
