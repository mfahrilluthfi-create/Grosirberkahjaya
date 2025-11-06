@extends('layouts.master')

@section('title', 'Pesanan Saya - ElektroMart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Pesanan Saya</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar Menu -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-user text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('customer.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 text-gray-700">
                        <i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                    <a href="{{ route('customer.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-50 text-blue-600">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Pesanan Saya</span>
                    </a>
                    <a href="{{ route('cart') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 text-gray-700">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Keranjang</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Orders List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-6">Riwayat Pesanan</h2>

                @if($orders->count() > 0)
                    <div class="space-y-4">
                        @foreach($orders as $order)
                        <div class="border rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <p class="font-bold text-blue-600">{{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-600">{{ $order->created_at->format('d F Y, H:i') }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
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

                            <div class="border-t pt-3 mb-3">
                                @foreach($order->items as $item)
                                <div class="flex justify-between items-center text-sm mb-2">
                                    <span>{{ $item->product_name }} ({{ $item->quantity }}x)</span>
                                    <span class="font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                                @endforeach
                            </div>

                            <div class="flex justify-between items-center pt-3 border-t">
                                <span class="font-bold">Total:</span>
                                <span class="font-bold text-blue-600 text-lg">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>

                            <div class="mt-3 pt-3 border-t">
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-credit-card mr-1"></i>
                                    @if($order->payment_method === 'bank_transfer') Transfer Bank
                                    @elseif($order->payment_method === 'e_wallet') E-Wallet
                                    @elseif($order->payment_method === 'credit_card') Kartu Kredit
                                    @else Bayar di Tempat (COD)
                                    @endif
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-shopping-bag text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 mb-4">Anda belum memiliki pesanan</p>
                        <a href="{{ route('products') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
