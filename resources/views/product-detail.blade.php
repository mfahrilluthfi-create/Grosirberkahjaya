@extends('layouts.master')

@section('title', $product->name . ' - ElektroMart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <div class="text-sm text-gray-600 mb-6">
        <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a> /
        <a href="{{ route('products') }}" class="hover:text-blue-600">Produk</a> /
        <a href="{{ route('products', ['category' => $product->category->slug]) }}" class="hover:text-blue-600">{{ $product->category->name }}</a> /
        <span>{{ $product->name }}</span>
    </div>

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

    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Product Image -->
            <div>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg">
                @else
                    <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                        <i class="fas fa-image text-6xl text-gray-400"></i>
                    </div>
                @endif

                @if($product->discount > 0)
                <div class="mt-4 bg-red-500 text-white px-4 py-2 rounded inline-block font-semibold">
                    DISKON {{ $product->discount }}%
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $product->category->name }}</p>

                <div class="mb-6">
                    @if($product->discount > 0)
                        <div class="text-gray-400 line-through text-lg mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="text-blue-600 font-bold text-3xl">Rp {{ number_format($product->final_price, 0, ',', '.') }}</div>
                    @else
                        <div class="text-blue-600 font-bold text-3xl">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    @endif
                </div>

                <div class="mb-6">
                    <p class="text-gray-600 mb-2">Ketersediaan Stok:</p>
                    @if($product->stock > 0)
                        <p class="text-lg font-semibold text-green-600">{{ $product->stock }} unit tersedia</p>
                    @else
                        <p class="text-lg font-semibold text-red-600">Stok Habis</p>
                    @endif
                </div>

                @if($product->description)
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-3">Deskripsi:</h3>
                    <p class="text-gray-700">{{ $product->description }}</p>
                </div>
                @endif

                @if($product->specifications && count($product->specifications) > 0)
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-3">Spesifikasi Produk:</h3>
                    <ul class="space-y-2">
                        @foreach($product->specifications as $spec)
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-1 mr-2"></i>
                            <span class="text-gray-700">{{ $spec }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @auth
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Jumlah:</label>
                        <div class="flex items-center gap-4">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                   class="w-20 text-center border rounded py-2" {{ $product->stock == 0 ? 'disabled' : '' }}>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold {{ $product->stock == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ $product->stock == 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                        </button>
                    </div>
                </form>
                @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                    <p class="text-gray-700"><i class="fas fa-info-circle text-yellow-600 mr-2"></i>Silakan <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> untuk menambahkan produk ke keranjang</p>
                </div>
                @endauth

                <div class="mt-6 border-t pt-6">
                    <h3 class="font-bold mb-3">Informasi Penjual:</h3>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <p class="font-semibold">Grosir Berkah Jaya</p>
                            <p class="text-sm text-gray-600">Kulim,Pekanbaru</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <a href="tel:+6281378490913" class="flex-1 bg-gray-100 hover:bg-gray-200 py-2 text-center rounded">
                            <i class="fas fa-phone mr-2"></i>Telepon
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 text-center rounded">
                            <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6">Produk Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            <div class="bg-white rounded-lg shadow hover:shadow-xl transition">
                <div class="relative">
                    @if($related->image)
                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-48 object-cover rounded-t-lg">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                            <i class="fas fa-image text-4xl text-gray-400"></i>
                        </div>
                    @endif

                    @if($related->discount > 0)
                    <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">-{{ $related->discount }}%</span>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-semibold mb-2 truncate">{{ $related->name }}</h3>
                    <div class="text-blue-600 font-bold mb-3">Rp {{ number_format($related->final_price, 0, ',', '.') }}</div>
                    <a href="{{ route('product.detail', $related->slug) }}" class="block w-full bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
