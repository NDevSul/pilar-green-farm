<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

public function instructions(Order $order)
{
    if (auth()->id() !== $order->user_id) {
        abort(403, 'Unauthorized access.');
    }

    $paymentMethods = PaymentMethod::all();

    return view('payment.instructions', compact('order', 'paymentMethods'));
}


    public function notifyPaid(Order $order)
    {
        if (Auth()->id() !== $order->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $order->update([
            'notified_seller' => true
        ]);

        return redirect()->back()->with('success', 'Pesan sudah dikirim ke admin bahwa kamu sudah melakukan pembayaran.');
    }

    public function uploadProof(Request $request, Order $order)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $order->payment_proof = $path;
            $order->notified_seller = true;
            $order->save();
        }

        return back()->with('success', 'Bukti transfer berhasil diupload dan pembayaran ditandai.');
    }
}
