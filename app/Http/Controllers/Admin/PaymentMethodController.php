<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('admin.payment_methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.payment_methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'qris_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'type' => strtolower($request->bank_name . '_' . $request->account_number), // auto unique
        ];

        if ($request->hasFile('qris_image')) {
            $data['image_path'] = $request->file('qris_image')->store('payment_qr', 'public');
        }

        PaymentMethod::create($data);

        return redirect()->route('admin.payment.methods.index')->with('success', 'Metode pembayaran berhasil disimpan.');
    }

    public function edit($id)
    {
        $method = PaymentMethod::findOrFail($id);
        return view('admin.payment_methods.edit', compact('method'));
    }

    public function update(Request $request, $id)
    {
        $method = PaymentMethod::findOrFail($id);

        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'qris_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $method->bank_name = $request->bank_name;
        $method->account_number = $request->account_number;
        $method->account_name = $request->account_name;
        $method->type = strtolower($request->bank_name . '_' . $request->account_number); 

        if ($request->hasFile('qris_image')) {
            if ($method->image_path && Storage::disk('public')->exists($method->image_path)) {
                Storage::disk('public')->delete($method->image_path);
            }
            $method->image_path = $request->file('qris_image')->store('payment_qr', 'public');
        }

        $method->save();

        return redirect()->route('admin.payment.methods.index')->with('success', 'Metode pembayaran diperbarui.');
    }

    public function destroy($id)
    {
        $method = PaymentMethod::findOrFail($id);

        if ($method->image_path && Storage::disk('public')->exists($method->image_path)) {
            Storage::disk('public')->delete($method->image_path);
        }

        $method->delete();

        return redirect()->route('admin.payment.methods.index')->with('success', 'Metode pembayaran dihapus.');
    }
}
