@extends('layouts.admin')

@section('title', 'Kelola Pesanan - Admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Kelola Pesanan</h1>
</div>

<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form action="{{ route('admin.orders.index') }}" method="GET" class="flex gap-4">
        <select name="status" class="border rounded px-4 py-2" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Sudah Dibayar</option>
            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Sedang Dikirim</option>
            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Terkirim</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pesanan..."
               class="flex-1 border rounded px-4 py-2">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Pesanan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($orders as $order)
            <tr>
                <td class="px-6 py-4 font-semibold">{{ $order->order_number }}</td>
                <td class="px-6 py-4">
                    <div>{{ $order->user->name }}</div>
                    <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                </td>
                <td class="px-6 py-4 font-bold text-blue-600">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                <td class="px-6 py-4">
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
                </td>
                <td class="px-6 py-4 text-sm">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    Belum ada pesanan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection
