@extends('layouts.master')

@section('title', 'Checkout - ElektroMart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Pembayaran</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Shipping Information -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-bold text-lg mb-4">Informasi Pengiriman</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" name="full_name" value="{{ old('full_name', Auth::user()->name) }}" required
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">No. Telepon *</label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="081234567890">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Provinsi *</label>
                            <select name="province" required
                                    class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Provinsi</option>
                                <option value="DKI Jakarta" {{ old('province') == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                                <option value="Jawa Barat" {{ old('province') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                                <option value="Jawa Tengah" {{ old('province') == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                                <option value="Jawa Timur" {{ old('province') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                                <option value="Banten" {{ old('province') == 'Banten' ? 'selected' : '' }}>Banten</option>
                                <option value="Sumatera Utara" {{ old('province') == 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                                <option value="Sumatera Barat" {{ old('province') == 'Sumatera Barat' ? 'selected' : '' }}>Sumatera Barat</option>
                                <option value="Riau" {{ old('province') == 'Riau' ? 'selected' : '' }}>Riau</option>
                                <option value="Sulawesi Selatan" {{ old('province') == 'Sulawesi Selatan' ? 'selected' : '' }}>Sulawesi Selatan</option>
                                <option value="Kalimantan Timur" {{ old('province') == 'Kalimantan Timur' ? 'selected' : '' }}>Kalimantan Timur</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Kota/Kabupaten *</label>
                            <input type="text" name="city" value="{{ old('city', Auth::user()->city) }}" required
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Contoh: Pekanbaru ">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Kode Pos *</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', Auth::user()->postal_code) }}" required
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="28862">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 mb-2">Alamat Lengkap *</label>
                            <textarea name="address" rows="3" required
                                      class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Masukkan alamat lengkap termasuk nama jalan, nomor rumah, RT/RW, kelurahan">{{ old('address', Auth::user()->address) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-bold text-lg mb-4">Pilih Metode Pembayaran</h3>
                    <p class="text-sm text-gray-600 mb-4">Silakan pilih metode pembayaran yang Anda inginkan</p>

                    <div class="space-y-3">
                        <!-- Transfer Bank -->
                        <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer hover:bg-blue-50 transition"
                               onclick="selectPayment('bank_transfer')">
                            <input type="radio" name="payment_method" value="bank_transfer" checked class="mt-1 mr-3">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-semibold text-lg">Transfer Bank</span>
                                    <div class="flex gap-2">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">BCA</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Mandiri</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">BNI</span>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600">Transfer ke rekening bank pilihan Anda</p>
                            </div>
                        </label>

                        <!-- E-Wallet -->
                        <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer hover:bg-blue-50 transition"
                               onclick="selectPayment('e_wallet')">
                            <input type="radio" name="payment_method" value="e_wallet" class="mt-1 mr-3">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-semibold text-lg">E-Wallet</span>
                                    <div class="flex gap-2">
                                        <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">OVO</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">GoPay</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Dana</span>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600">Bayar menggunakan dompet digital</p>
                            </div>
                        </label>

                        <!-- Credit Card -->
                        <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer hover:bg-blue-50 transition"
                               onclick="selectPayment('credit_card')">
                            <input type="radio" name="payment_method" value="credit_card" class="mt-1 mr-3">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-semibold text-lg">Kartu Kredit/Debit</span>
                                    <div class="flex gap-2">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Visa</span>
                                        <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded">Mastercard</span>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600">Pembayaran dengan kartu kredit atau debit</p>
                            </div>
                        </label>

                        <!-- COD -->
                        <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer hover:bg-blue-50 transition"
                               onclick="selectPayment('cod')">
                            <input type="radio" name="payment_method" value="cod" class="mt-1 mr-3">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-semibold text-lg">Bayar di Tempat (COD)</span>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Tunai</span>
                                </div>
                                <p class="text-sm text-gray-600">Bayar saat barang sampai di tujuan</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Order Notes -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-bold text-lg mb-4">Catatan Pesanan (Opsional)</h3>
                    <textarea name="notes" rows="3" placeholder="Tambahkan catatan khusus untuk pesanan Anda..."
                              class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('notes') }}</textarea>
                </div>
            </div>

            <!-- Order Summary -->
            <div>
                <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                    <h3 class="font-bold text-lg mb-4">Ringkasan Pesanan</h3>

                    <!-- Cart Items -->
                    <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                        @foreach($cartItems as $item)
                        <div class="flex gap-3 pb-3 border-b">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                            <div class="flex-1">
                                <p class="font-semibold text-sm">{{ $item->product->name }}</p>
                                <p class="text-gray-600 text-sm">{{ $item->quantity }}x Rp {{ number_format($item->product->final_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-4 space-y-3 mb-4">
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
                        <div class="flex justify-between font-bold text-xl">
                            <span>Total Pembayaran</span>
                            <span class="text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold">
                        <i class="fas fa-check-circle mr-2"></i>Buat Pesanan
                    </button>

                    <div class="mt-4 flex items-center justify-center gap-2 text-sm text-gray-600">
                        <i class="fas fa-shield-alt text-green-600"></i>
                        <span>Transaksi Anda Aman & Terenkripsi</span>
                    </div>

                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded text-sm">
                        <p class="font-semibold text-yellow-800 mb-1">
                            <i class="fas fa-info-circle mr-1"></i>Informasi Penting
                        </p>
                        <p class="text-yellow-700">
                            Setelah Anda membuat pesanan, kami akan mengirimkan instruksi pembayaran ke email Anda. Pesanan akan diproses setelah pembayaran dikonfirmasi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function selectPayment(method) {
    // Remove active state from all
    document.querySelectorAll('label[onclick^="selectPayment"]').forEach(label => {
        label.classList.remove('border-blue-500', 'bg-blue-50');
        label.classList.add('border-gray-300');
    });

    // Add active state to selected
    event.currentTarget.classList.add('border-blue-500', 'bg-blue-50');
    event.currentTarget.classList.remove('border-gray-300');
}
</script>
@endsection
