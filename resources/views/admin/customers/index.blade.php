@extends('layouts.admin')

@section('title', 'Kelola Pelanggan - Admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Kelola Pelanggan</h1>
</div>

<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form action="{{ route('admin.customers.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pelanggan..."
               class="flex-1 border rounded px-4 py-2">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Pesanan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Terdaftar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($customers as $customer)
            <tr>
                <td class="px-6 py-4 font-semibold">{{ $customer->name }}</td>
                <td class="px-6 py-4">{{ $customer->email }}</td>
                <td class="px-6 py-4">{{ $customer->phone ?? '-' }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                        {{ $customer->orders_count }} pesanan
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">{{ $customer->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.customers.show', $customer->id) }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    Belum ada pelanggan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $customers->links() }}
</div>
@endsection
