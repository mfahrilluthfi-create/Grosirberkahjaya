@extends('layouts.master')

@section('title', 'Grosirberkahjaya - Beranda')

@section('content')
<!-- Hero Banner -->
<!-- Hero Section -->
<div class="bg-gradient-to-r from-red-600 via-blue-700 to-blue-900 text-white relative overflow-hidden">
  <div class="container mx-auto px-6 py-20 relative z-10">
    <div class="flex flex-col md:flex-row items-center justify-between gap-10">

      <!-- Text Section -->
      <div class="max-w-xl text-center md:text-left">
        <h1 class="text-5xl font-extrabold mb-4 leading-tight">
          <span class="block text-yellow-300">Berkah Tiap Transaksi,</span>
          Hemat Tiap Belanja!
        </h1>
        <p class="text-lg text-blue-100 mb-8">
          Belanja grosir makin mudah di <span class="font-semibold text-white">Grosir Berkah Jaya</span> —
          cepat, aman, dan harga bersahabat untuk semua kebutuhan Anda.
        </p>
        <a href="{{ route('products') }}"
           class="bg-white text-blue-700 px-8 py-3 rounded-lg font-semibold hover:bg-yellow-100 hover:scale-105 transition-transform duration-200 inline-block shadow-md">
          Belanja Sekarang
        </a>
      </div>

      <!-- Icon / Illustration -->
      <div class="hidden md:block">
        <i class="fas fa-store text-[12rem] opacity-40"></i>
      </div>

    </div>
  </div>

  <!-- Decorative Blur Effect -->
  <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400 rounded-full mix-blend-overlay blur-3xl opacity-30"></div>
  <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-300 rounded-full mix-blend-overlay blur-3xl opacity-20"></div>
</div>


<!-- Promo Banner -->
<div class="relative bg-gradient-to-r from-yellow-400 via-amber-400 to-orange-400 py-3 overflow-hidden">
  <!-- Efek cahaya berjalan -->
  <div class="absolute inset-0 bg-[linear-gradient(120deg,rgba(255,255,255,0.4)_0%,transparent_40%,transparent_60%,rgba(255,255,255,0.4)_100%)] animate-[shine_3s_linear_infinite]"></div>

  <div class="container mx-auto px-4 text-center relative z-10">
    <p class="font-bold text-gray-900 text-lg flex items-center justify-center flex-wrap gap-2">
      <i class="fas fa-fire text-red-600 text-xl animate-bounce"></i>
      <span> <span class="text-white drop-shadow"></span> Diskon hingga <span class="text-red-700">50%</span> untuk kategori <span class="underline decoration-wavy decoration-red-600">Sembako</span> & <span class="underline decoration-wavy decoration-red-600">Perlengkapan Rumah Tangga</span>
      </span>
      <i class="fas fa-fire text-red-600 text-xl animate-bounce"></i>
    </p>
  </div>
</div>

<!-- Categories -->
<div class="container mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold mb-8 text-center">Kategori Produk</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($categories as $category)
        <a href="{{ route('products', ['category' => $category->slug]) }}" class="bg-white p-6 rounded-lg shadow hover:shadow-xl transition text-center">
            <i class="fas {{ $category->icon }} text-5xl text-blue-600 mb-4"></i>
            <h3 class="font-semibold">{{ $category->name }}</h3>
            <p class="text-sm text-gray-500">{{ $category->products_count }} produk</p>
        </a>
        @endforeach
    </div>
</div>

<!-- Featured Products -->
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold">Produk Unggulan</h2>
            <a href="{{ route('products') }}" class="text-blue-600 hover:underline">Lihat Semua →</a>
        </div>

        @if($featuredProducts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-lg shadow hover:shadow-xl transition flex flex-col h-full">
                <div class="relative h-48 flex-shrink-0">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-t-lg">
                    @else
                        <div class="w-full h-full bg-gray-200 rounded-t-lg flex items-center justify-center">
                            <i class="fas fa-image text-4xl text-gray-400"></i>
                        </div>
                    @endif

                    @if($product->discount > 0)
                    <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">-{{ $product->discount }}%</span>
                    @endif

                    @if($product->stock == 0)
                    <span class="absolute top-2 left-2 bg-gray-800 text-white px-2 py-1 rounded text-sm">Stok Habis</span>
                    @endif
                </div>
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="font-semibold mb-2 line-clamp-2 min-h-[3rem]">{{ $product->name }}</h3>
                    <div class="mb-2">
                        @if($product->discount > 0)
                            <span class="text-gray-400 line-through text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="text-blue-600 font-bold text-lg block">Rp {{ number_format($product->final_price, 0, ',', '.') }}</span>
                        @else
                            <span class="text-blue-600 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Stok: {{ $product->stock > 0 ? $product->stock : 'Habis' }}</p>
                    <a href="{{ route('product.detail', $product->slug) }}" class="block w-full bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700 transition mt-auto">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Belum ada produk tersedia</p>
        </div>
        @endif
    </div>
</div>

<!-- Mengapa Pilih Grosir Berkah Jaya -->
<div class="bg-gradient-to-b from-blue-50 to-white py-16">
  <div class="container mx-auto px-6">
    <h2 class="text-3xl font-bold mb-10 text-center text-blue-800">
      Mengapa Belanja di <span class="text-blue-600">Grosir Berkah Jaya?</span>
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

      <!-- Garansi Produk -->
      <div class="text-center transform transition duration-300 hover:scale-105">
        <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
          <i class="fas fa-shield-alt text-blue-700 text-3xl"></i>
        </div>
        <h3 class="font-semibold text-lg text-gray-800 mb-2">Produk Terjamin Asli</h3>
        <p class="text-gray-600 text-sm">Setiap produk di Grosir Berkah Jaya dijamin berkualitas dan 100% original dari pemasok terpercaya.</p>
      </div>

      <!-- Pengiriman -->
      <div class="text-center transform transition duration-300 hover:scale-105">
        <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
          <i class="fas fa-truck-fast text-green-700 text-3xl"></i>
        </div>
        <h3 class="font-semibold text-lg text-gray-800 mb-2">Pengiriman Cepat & Aman</h3>
        <p class="text-gray-600 text-sm">Kami pastikan pesanan Anda dikirim dengan aman, cepat, dan tepat waktu ke seluruh Indonesia.</p>
      </div>

      <!-- Pembayaran -->
      <div class="text-center transform transition duration-300 hover:scale-105">
        <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
          <i class="fas fa-wallet text-purple-700 text-3xl"></i>
        </div>
        <h3 class="font-semibold text-lg text-gray-800 mb-2">Transaksi Mudah & Aman</h3>
        <p class="text-gray-600 text-sm">Dukung berbagai metode pembayaran mulai dari transfer bank, e-wallet, hingga COD.</p>
      </div>

      <!-- Layanan -->
      <div class="text-center transform transition duration-300 hover:scale-105">
        <div class="bg-orange-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
          <i class="fas fa-headset text-orange-700 text-3xl"></i>
        </div>
        <h3 class="font-semibold text-lg text-gray-800 mb-2">Dukungan Pelanggan 24/7</h3>
        <p class="text-gray-600 text-sm">Tim Grosir Berkah Jaya siap membantu kapan pun Anda butuh — ramah, cepat, dan responsif.</p>
      </div>

    </div>
  </div>
</div>

@endsection
