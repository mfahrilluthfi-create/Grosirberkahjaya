@extends('layouts.master')

@section('title', 'Produk - Grosirberkahjaya ')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Semua Produk</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filter -->
            <div class="w-full lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-bold text-lg mb-4">Filter</h3>

                    <form action="{{ route('products') }}" method="GET">
                        <!-- Category Filter -->
                        <div class="mb-6">
                            <h4 class="font-semibold mb-2">Kategori</h4>
                            <div class="space-y-2">
                                @foreach ($categories as $cat)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="category[]" value="{{ $cat->slug }}"
                                            {{ in_array($cat->slug, (array) request('category', [])) ? 'checked' : '' }}
                                            class="mr-2" onchange="this.form.submit()">
                                        <span class="text-sm">{{ $cat->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <h4 class="font-semibold mb-2">Range Harga</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="price_range" value="0-100000"
                                        {{ request('price_range') == '0-100000' ? 'checked' : '' }} class="mr-2"
                                        onchange="this.form.submit()">
                                    <span class="text-sm">
                                        < Rp 100.000</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="radio" name="price_range" value="100000-300000"
                                        {{ request('price_range') == '100000-300000' ? 'checked' : '' }} class="mr-2"
                                        onchange="this.form.submit()">
                                    <span class="text-sm">Rp 100rb - 300rb</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="radio" name="price_range" value="300000-800000"
                                        {{ request('price_range') == '300000-800000' ? 'checked' : '' }} class="mr-2"
                                        onchange="this.form.submit()">
                                    <span class="text-sm">Rp 300rb - 800rb</span>
                                </label>
                            </div>
                        </div>

                        <!-- Stock Filter -->
                        <div class="mb-6">
                            <h4 class="font-semibold mb-2">Ketersediaan Stok</h4>
                            <label class="flex items-center">
                                <input type="checkbox" name="in_stock" value="1"
                                    {{ request('in_stock') ? 'checked' : '' }} class="mr-2" onchange="this.form.submit()">
                                <span class="text-sm">Stok Tersedia</span>
                            </label>
                        </div>

                        <a href="{{ route('products') }}"
                            class="w-full bg-gray-200 hover:bg-gray-300 py-2 rounded text-sm text-center block">
                            Reset Filter
                        </a>
                    </form>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="flex-1">
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">{{ $products->total() }} produk ditemukan</p>
                    <form action="{{ route('products') }}" method="GET" class="flex items-center gap-2">
                        @foreach (request()->except('sort') as $key => $value)
                            @if (is_array($value))
                                @foreach ($value as $v)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <select name="sort" onchange="this.form.submit()" class="border rounded px-4 py-2">
                            <option value="">Urutkan</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah
                            </option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga
                                Tertinggi</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                        </select>
                    </form>
                </div>

                @if ($products->count() > 0)
                    @php
                        // Pisahkan produk berdasarkan stok
                        $productsArray = $products->items();
                        $productsInStock = collect($productsArray)->filter(function ($product) {
                            return $product->stock > 0;
                        });
                        $productsOutOfStock = collect($productsArray)->filter(function ($product) {
                            return $product->stock == 0;
                        });
                        $sortedProducts = $productsInStock->concat($productsOutOfStock);
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($sortedProducts as $product)
                            <div
                                class="bg-white rounded-lg shadow hover:shadow-xl transition {{ $product->stock == 0 ? 'opacity-75' : '' }}">
                                <div class="relative">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-48 object-cover rounded-t-lg {{ $product->stock == 0 ? 'grayscale' : '' }}">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                                            <i class="fas fa-image text-4xl text-gray-400"></i>
                                        </div>
                                    @endif

                                    @if ($product->discount > 0 && $product->stock > 0)
                                        <span
                                            class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">-{{ $product->discount }}%</span>
                                    @endif

                                    @if ($product->stock == 0)
                                        <span
                                            class="absolute top-2 left-2 bg-red-600 text-white px-3 py-1 rounded text-sm font-bold">STOK
                                            HABIS</span>
                                    @endif
                                </div>
                                <div class="p-4 {{ $product->stock == 0 ? 'bg-red-50' : '' }}">
                                    <h3
                                        class="font-semibold mb-2 truncate {{ $product->stock == 0 ? 'text-gray-500' : '' }}">
                                        {{ $product->name }}</h3>
                                    <p class="text-xs text-gray-500 mb-2">{{ $product->category->name }}</p>
                                    <div class="mb-2">
                                        @if ($product->discount > 0)
                                            <span class="text-gray-400 line-through text-sm">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</span>
                                            <span
                                                class="font-bold text-lg block {{ $product->stock == 0 ? 'text-red-600' : 'text-blue-600' }}">Rp
                                                {{ number_format($product->final_price, 0, ',', '.') }}</span>
                                        @else
                                            <span
                                                class="font-bold text-lg {{ $product->stock == 0 ? 'text-red-600' : 'text-blue-600' }}">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <p
                                        class="text-sm mb-3 {{ $product->stock == 0 ? 'text-red-600 font-semibold' : 'text-gray-600' }}">
                                        {{ $product->stock > 0 ? 'Stok: ' . $product->stock . ' unit' : 'Stok Habis' }}
                                    </p>
                                    <a href="{{ route('product.detail', $product->slug) }}"
                                        class="block w-full text-white text-center py-2 rounded transition {{ $product->stock == 0 ? 'bg-gray-400 hover:bg-gray-500' : 'bg-blue-600 hover:bg-blue-700' }}">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-12 bg-white rounded-lg">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Tidak ada produk ditemukan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
