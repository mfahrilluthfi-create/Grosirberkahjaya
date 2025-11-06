@extends('layouts.master')

@section('title', 'Keranjang Belanja - ElektroMart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Keranjang Belanja</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            @if($cartItems->count() > 0)
                <div class="space-y-4">
                    @foreach($cartItems as $item)
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex gap-4">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded">
                            @else
                                <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center">
                                    <i class="fas fa-image text-2xl text-gray-400"></i>
                                </div>
                            @endif

                            <div class="flex-1">
                                <h3 class="font-semibold mb-2">{{ $item->product->name }}</h3>
                                <p class="text-blue-600 font-bold mb-3">Rp {{ number_format($item->product->final_price, 0, ',', '.') }}</p>

                                <div class="flex items-center justify-between">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                               min="1" max="{{ $item->product->stock }}"
                                               class="w-16 text-center border rounded py-1"
                                               onchange="this.form.submit()">
                                        <span class="text-sm text-gray-500">Max: {{ $item->product->stock }}</span>
                                    </form>

                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800"
                                                onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>

                                <p class="text-sm text-gray-500 mt-2">
                                    Subtotal: Rp {{ number_format($item->product->final_price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline text-sm"
                            onclick="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?')">
                        <i class="fas fa-trash mr-1"></i>Kosongkan Keranjang
                    </button>
                </form>
            @else
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Keranjang Anda Kosong</h3>
                    <p class="text-gray-600 mb-6">Belum ada produk di keranjang belanja Anda</p>
                    <a href="{{ route('products') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>

        <!-- Order Summary -->
        <div>
            <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                <h3 class="font-bold text-lg mb-4">Ringkasan Pesanan</h3>

                <div class="space-y-3 mb-4">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Ongkos Kirim</span>
                        <span>{{ $shippingCost == 0 ? 'Gratis' : 'Rp ' . number_format($shippingCost, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t pt-4 mb-6">
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span class="text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($cartItems->count() > 0)
                <a href="{{ route('checkout') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold mb-3 text-center">
                    Lanjut ke Pembayaran
                </a>
                @else
                <button disabled class="block w-full bg-gray-400 text-white py-3 rounded-lg font-semibold mb-3 cursor-not-allowed">
                    Lanjut ke Pembayaran
                </button>
                @endif

                <a href="{{ route('products') }}" class="block w-full text-center bg-gray-200 hover:bg-gray-300 py-3 rounded-lg font-semibold">
                    Lanjut Belanja
                </a>

                <div class="mt-6 space-y-3">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="fas fa-shield-alt text-green-600"></i>
                        <span>Pembayaran 100% Aman</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="fas fa-truck text-blue-600"></i>
                        <span>Gratis Ongkir Min. Rp 150.000</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="fas fa-undo text-orange-600"></i>
                        <span>Garansi 7 Hari Pengembalian</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
