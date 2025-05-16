<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Order::with(['user', 'orderItems.product']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
    
        $orders = $query->latest()->get();
    
        return view('admin.orders.index', compact('orders'));
    }

    public function verify(Order $order)
    {
        $order->update([
            'status' => 'paid'
        ]);

        return redirect()->back()->with('success', 'Order telah ditandai sebagai lunas.');
    }

public function pendingOrders()
{
    $user = auth()->user();

    $pendingOrders = \App\Models\Order::with('orderItems.product')
        ->where('user_id', $user->id)
        ->where('status', 'pending')
        ->latest()
        ->get();

    return view('pending', compact('pendingOrders'));
}

}