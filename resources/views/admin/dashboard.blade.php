{{-- File: resources/views/admin/dashboard.blade.php --}}

@extends('layouts.admin')

@section('title', 'Dashboard Admin - GrosirBerkahJaya')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600">Selamat datang di admin panel Grosir berkah jaya</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Pesanan</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalOrders }}</p>
            </div>
            <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center">
                <i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Revenue</p>
                <p class="text-3xl font-bold text-gray-800">{{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center">
                <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Produk</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalProducts }}</p>
            </div>
            <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center">
                <i class="fas fa-box text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Pelanggan</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalCustomers }}</p>
            </div>
            <div class="bg-orange-100 w-12 h-12 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-orange-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold">Pesanan Terbaru</h2>
        </div>
        <div class="p-6">
            @if($recentOrders->count() > 0)
                <div class="space-y-4">
                    @foreach($recentOrders as $order)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold">{{ $order->order_number }}</p>
                                <p class="text-sm text-gray-600">{{ $order->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-blue-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'paid') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'processing') bg-purple-100 text-purple-800
                                    @elseif($order->status === 'shipped') bg-orange-100 text-orange-800
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    @if($order->status === 'pending') Menunggu
                                    @elseif($order->status === 'paid') Dibayar
                                    @elseif($order->status === 'processing') Diproses
                                    @elseif($order->status === 'shipped') Dikirim
                                    @elseif($order->status === 'delivered') Terkirim
                                    @else Batal
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.orders.index') }}" class="block text-center text-blue-600 hover:underline mt-4">
                    Lihat Semua Pesanan →
                </a>
            @else
                <p class="text-center text-gray-500 py-8">Belum ada pesanan</p>
            @endif
        </div>
    </div>

    <!-- Low Stock Products -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold">Produk Stok Rendah</h2>
        </div>
        <div class="p-6">
            @if($lowStockProducts->count() > 0)
                <div class="space-y-4">
                    @foreach($lowStockProducts as $product)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold">{{ $product->name }}</p>
                                <p class="text-sm text-gray-600">{{ $product->category->name }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    @if($product->stock <= 2) bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    Stok: {{ $product->stock }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.products.index') }}" class="block text-center text-blue-600 hover:underline mt-4">
                    Kelola Produk →
                </a>
            @else
                <p class="text-center text-gray-500 py-8">Semua produk memiliki stok yang cukup</p>
            @endif
        </div>
    </div>
</div>
@endsection
