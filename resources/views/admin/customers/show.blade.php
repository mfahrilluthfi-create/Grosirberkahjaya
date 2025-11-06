@extends('layouts.admin')

@section('title', 'Detail Pelanggan - Admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.customers.index') }}" class="text-blue-600 hover:underline">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Customer Info -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Informasi Pelanggan</h2>

        <div class="mb-4">
            <p class="text-sm text-gray-600">Nama Lengkap</p>
            <p class="font-semibold">{{ $customer->name }}</p>
        </div>

        <div class="mb-4">
            <p class="text-sm text-gray-600">Email</p>
            <p class="font-semibold">{{ $customer->email }}</p>
        </div>

        <div class="mb-4">
            <p class="text-sm text-gray-600">Telepon</p>
            <p class="font-semibold">{{ $customer->phone ?? '-' }}</p>
        </div>

        @if($customer->address)
        <div class="mb-4">
            <p class="text-sm text-gray-600">Alamat</p>
            <p class="text-sm">{{ $customer->address }}</p>
            <p class="text-sm">{{ $customer->city }}, {{ $customer->province }}</p>
            <p class="text-sm">{{ $customer->postal_code }}</p>
        </div>
        @endif

        <div class="mb-4">
            <p class="text-sm text-gray-600">Terdaftar Sejak</p>
            <p class="font-semibold">{{ $customer->created_at->format('d F Y') }}</p>
        </div>

        <div class="pt-4 border-t">
            <p class="text-sm text-gray-600">Total Pesanan</p>
            <p class="text-2xl font-bold text-blue-600">{{ $customer->orders->count() }}</p>
        </div>
    </div>

    <!-- Order History -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Riwayat Pesanan</h2>

        @if($customer->orders->count() > 0)
        <div class="space-y-4">
            @foreach($customer->orders as $order)
            <div class="border rounded-lg p-4">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <p class="font-semibold">{{ $order->order_number }}</p>
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
                        @if($order->status === 'pending') Menunggu
                        @elseif($order->status === 'paid') Dibayar
                        @elseif($order->status === 'processing') Diproses
                        @elseif($order->status === 'shipped') Dikirim
                        @elseif($order->status === 'delivered') Terkirim
                        @else Batal
                        @endif
                    </span>
                </div>

                <div class="space-y-2 mb-3">
                    @foreach($order->items as $item)
                    <div class="flex justify-between text-sm">
                        <span>{{ $item->product_name }} ({{ $item->quantity }}x)</span>
                        <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="flex justify-between items-center pt-3 border-t">
                    <span class="font-bold">Total:</span>
                    <span class="font-bold text-blue-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>

                <div class="mt-3">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:underline text-sm">
                        <i class="fas fa-eye mr-1"></i>Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12 text-gray-500">
            <i class="fas fa-shopping-bag text-4xl mb-2"></i>
            <p>Belum ada pesanan</p>
        </div>
        @endif
    </div>
</div>
@endsection
