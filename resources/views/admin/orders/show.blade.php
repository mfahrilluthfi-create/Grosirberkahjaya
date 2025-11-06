@extends('layouts.admin')

@section('title', 'Detail Pesanan - Admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Detail Pesanan</h2>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-gray-600 text-sm">Nomor Pesanan</p>
                    <p class="font-semibold">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Tanggal</p>
                    <p class="font-semibold">{{ $order->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Metode Pembayaran</p>
                    <p class="font-semibold">
                        @if($order->payment_method === 'bank_transfer') Transfer Bank
                        @elseif($order->payment_method === 'e_wallet') E-Wallet
                        @elseif($order->payment_method === 'credit_card') Kartu Kredit
                        @else COD
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status === 'paid') bg-blue-100 text-blue-800
                        @elseif($order->status === 'processing') bg-purple-100 text-purple-800
                        @elseif($order->status === 'shipped') bg-orange-100 text-orange-800
                        @elseif($order->status === 'delivered') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        @if($order->status === 'pending') Menunggu Pembayaran
                        @elseif($order->status === 'paid') Sudah Dibayar
                        @elseif($order->status === 'processing') Sedang Diproses
                        @elseif($order->status === 'shipped') Sedang Dikirim
                        @elseif($order->status === 'delivered') Terkirim
                        @else Dibatalkan
                        @endif
                    </span>
                </div>
            </div>

            <!-- Order Items -->
            <h3 class="font-bold mb-3">Produk</h3>
            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                    <div>
                        <p class="font-semibold">{{ $item->product_name }}</p>
                        <p class="text-sm text-gray-600">{{ $item->quantity }}x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <p class="font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>

            <div class="mt-6 pt-6 border-t space-y-2">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Ongkos Kirim</span>
                    <span>{{ $order->shipping_cost == 0 ? 'Gratis' : 'Rp ' . number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between font-bold text-lg pt-2 border-t">
                    <span>Total</span>
                    <span class="text-blue-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Alamat Pengiriman</h2>
            <p class="font-semibold">{{ $order->shipping_name }}</p>
            <p class="text-gray-600">{{ $order->shipping_phone }}</p>
            <p class="text-gray-600">{{ $order->shipping_email }}</p>
            <p class="text-gray-600 mt-2">{{ $order->shipping_address }}</p>
            <p class="text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}</p>

            @if($order->notes)
            <div class="mt-4 pt-4 border-t">
                <p class="text-sm font-semibold text-gray-700">Catatan:</p>
                <p class="text-gray-600">{{ $order->notes }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Update Status -->
    <div>
        <div class="bg-white rounded-lg shadow p-6 sticky top-24">
            <h2 class="text-xl font-bold mb-4">Update Status</h2>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <select name="status" class="w-full border rounded px-4 py-2 mb-4">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Sudah Dibayar</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Sedang Dikirim</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Terkirim</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
                    Update Status
                </button>
            </form>

            <div class="mt-6 pt-6 border-t">
                <h3 class="font-semibold mb-3">Info Pelanggan</h3>
                <p class="text-sm"><strong>Nama:</strong> {{ $order->user->name }}</p>
                <p class="text-sm"><strong>Email:</strong> {{ $order->user->email }}</p>
                <p class="text-sm"><strong>Phone:</strong> {{ $order->user->phone }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
