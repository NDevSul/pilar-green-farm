@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h2 class="text-3xl font-bold text-green-800 mb-6 text-center">📦 Daftar Order Customer</h2>

    <!-- Filter -->
    <form method="GET" class="mb-8 flex flex-wrap justify-center items-center gap-4 bg-green-50 dark:bg-gray-800 p-4 rounded-lg shadow">
        <select name="status" class="border rounded px-4 py-2 bg-white dark:bg-gray-700 dark:text-white">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
        </select>

        <input type="date" name="date" value="{{ request('date') }}"
            class="border rounded px-4 py-2 bg-white dark:bg-gray-700 dark:text-white">

        <button class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition-all">
            <i class="fas fa-filter mr-1"></i> Filter
        </button>
    </form>

    <!-- Orders -->
    <div class="space-y-8">
        @forelse($orders as $order)
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md hover:shadow-lg transition space-y-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-300">
                        Order #{{ $order->id }} oleh <strong>{{ $order->user->name }}</strong>
                    </p>
                    <p class="text-sm text-green-800 dark:text-green-300 mt-1">
                        Total: <strong>Rp{{ number_format($order->orderItems->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}</strong>
                    </p>
                </div>
                <span class="text-sm px-3 py-1 rounded-full font-semibold
                    {{ $order->status === 'paid' ? 'bg-green-200 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div>
                <p class="font-semibold text-green-700 dark:text-green-200 mb-2">🧾 Produk:</p>
                <ul class="list-disc ml-6 text-green-900 dark:text-green-100 text-sm space-y-1">
                    @foreach ($order->orderItems as $item)
                        <li>{{ $item->product->name }} × {{ $item->quantity }}</li>
                    @endforeach
                </ul>
            </div>

            @if($order->notified_seller && $order->status === 'pending')
                <p class="text-xs text-blue-500 italic">Pelanggan telah klik "Saya Sudah Bayar"</p>
            @endif

            @if($order->payment_proof)
            <div>
                <p class="font-semibold text-green-700 dark:text-green-200 mb-2">📎 Bukti Transfer:</p>
                <div class="flex flex-col sm:flex-row items-start gap-4">
                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">
                        <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Transfer"
                            class="w-32 h-32 object-cover rounded border hover:scale-105 transition duration-200">
                    </a>
                </div>
            </div>
            @endif

            @if($order->status === 'pending' && ($order->notified_seller || $order->payment_proof))
            <div class="mt-4">
                <form action="{{ route('admin.orders.verify', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                        Tandai sebagai Paid
                    </button>
                </form>
            </div>
            @endif
        </div>
        @empty
        <div class="bg-yellow-100 text-yellow-800 p-6 rounded-lg shadow text-center font-semibold">
            Tidak ada order ditemukan.
        </div>
        @endforelse
    </div>
</div>
@endsection
