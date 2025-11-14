@extends('layouts.master')

@section('title', 'Tentang Kami - Grosirberkahjaya')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-600 to-blue-800 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Tentang Grosir Berkah Jaya </h1>
            <p class="text-xl">Toko Grosir Terpercaya Sejak 2020</p>
        </div>
    </div>

    <!-- About Content -->
    <div class="container mx-auto px-4 py-12">
        <!-- Company Story -->
        <div class="max-w-4xl mx-auto mb-16">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold mb-6 text-center">OUR STORY </h2>
                <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                    <p>
                        <strong>Grosir Berkah Jaya </strong> berdiri sejak tahun 2020 dengan satu tujuan sederhana membantu
                        masyarakat mendapatkan berbagai kebutuhan grosir dengan harga yang terjangkau tanpa mengorbankan
                        kualitas.

                    </p>
                    <p>
                        Berawal dari toko kecil yang melayani pelanggan sekitar, kini kami telah tumbuh menjadi salah satu
                        platform grosir terpercaya di Indonesia. Ribuan pelanggan dari berbagai daerah telah merasakan
                        kemudahan dan keuntungan berbelanja di Grosir Berkah Jaya, mulai dari produk sembako, makanan
                        kemasan, hingga perlengkapan elektronik rumah tangga
                    </p>
                    <p>
                        kami berusaha memberikan pelayanan terbaik dan menjaga kepercayaan pelanggan. Dengan semangat kerja
                        keras dan kejujuran, kami ingin terus menjadi pilihan utama bagi siapa pun yang mencari produk
                        grosir dengan harga bersahabat dan pelayanan cepat.
                    </p>
                </div>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <div class="bg-blue-50 rounded-lg p-8">
                <div class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-eye text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Visi Kami</h3>
                <p class="text-gray-700 leading-relaxed">
                    Menjadi toko grosir terdepan dan terpercaya yang menghadirkan kemudahan serta keberkahan bagi seluruh
                    pelanggan di Indonesia.
                </p>
            </div>
            <div class="bg-green-50 rounded-lg p-8">
                <div class="bg-green-600 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-bullseye text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Misi Kami</h3>
                <ul class="text-gray-700 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-600 mt-1 mr-2"></i>
                        <span>Menyediakan produk berkualitas tinggi dengan harga yang kompetitif untuk memenuhi kebutuhan
                            pelanggan.

                        </span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-600 mt-1 mr-2"></i>
                        <span>Membangun hubungan yang kuat dan berkelanjutan dengan pelanggan serta mitra berdasarkan
                            kepercayaan.
                        </span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-600 mt-1 mr-2"></i>
                        <span>Terus berinovasi dalam layanan dan teknologi untuk menciptakan pengalaman berbelanja
                            yang lebih baik.</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Our Values -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold mb-8 text-center text-gray-900">Nilai-Nilai Grosir Berkah Jaya</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-6xl mx-auto">

                <div
                    class="bg-white rounded-2xl shadow-lg p-6 text-center hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-boxes text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2 text-gray-800">Kelengkapan Produk</h3>
                    <p class="text-gray-600 text-sm">
                        Dari kebutuhan rumah tangga hingga perlengkapan usaha, kami sediakan semuanya dalam satu tempat.
                    </p>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-lg p-6 text-center hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hand-holding-usd text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2 text-gray-800">Harga Bersahabat</h3>
                    <p class="text-gray-600 text-sm">
                        Kami percaya belanja grosir tak harus mahal. Semakin banyak beli, semakin besar hematnya.
                    </p>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-lg p-6 text-center hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                    <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-yellow-500 text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2 text-gray-800">Pelayanan Sepenuh Hati</h3>
                    <p class="text-gray-600 text-sm">
                        Tim kami selalu siap membantu dengan cepat, ramah, dan tulus untuk setiap pelanggan.
                    </p>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-lg p-6 text-center hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-rocket text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2 text-gray-800">Inovasi & Kecepatan</h3>
                    <p class="text-gray-600 text-sm">
                        Kami terus berinovasi dalam layanan dan pengiriman agar pelanggan selalu puas dan percaya.
                    </p>
                </div>

            </div>
        </div>


        <!-- Statistics -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow-lg p-12 mb-16">
            <h2 class="text-3xl font-bold mb-8 text-center">Grosir Berkah Jaya</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">5+</div>
                    <div class="text-blue-200">Tahun Pengalaman</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">50k+</div>
                    <div class="text-blue-200">Pelanggan Puas</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">2000+</div>
                    <div class="text-blue-200">Produk Tersedia</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">4,9/5</div>
                    <div class="text-blue-200">Rating Kepuasan</div>
                </div>
            </div>
        </div>

        <!-- Produk Lengkap & Berkualitas -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold mb-8 text-center">Mengapa Memilih Grosir Berkah Jaya?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center hover:-translate-y-2 hover:shadow-xl transition duration-300">
                    <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-3 text-gray-800">Produk Lengkap & Berkualitas</h3>
                    <p class="text-gray-600 text-sm">
                        Menyediakan berbagai produk kebutuhan pokok, makanan, minuman, alat kebersihan, dan perlengkapan
                        usaha dari merek terpercaya.
                    </p>
                </div>

                <!-- Harga Termurah -->
                <div
                    class="bg-white rounded-2xl shadow-md p-8 text-center hover:-translate-y-2 hover:shadow-xl transition duration-300">
                    <div
                        class="bg-gradient-to-r from-red-600 to-pink-500 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-tags text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-3 text-gray-800">Harga Grosir Termurah</h3>
                    <p class="text-gray-600 text-sm">
                        Kami menawarkan harga grosir terbaik dan kompetitif. Semakin banyak Anda membeli, semakin besar
                        potongan harganya!
                    </p>
                </div>

                <!-- Pengiriman Cepat -->
                <div
                    class="bg-white rounded-2xl shadow-md p-8 text-center hover:-translate-y-2 hover:shadow-xl transition duration-300">
                    <div
                        class="bg-gradient-to-r from-green-600 to-green-400 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-truck text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-3 text-gray-800">Pengiriman Cepat & Aman</h3>
                    <p class="text-gray-600 text-sm">
                        Kami melayani pengiriman ke seluruh Indonesia dengan kemasan aman dan pengantaran cepat agar barang
                        sampai tepat waktu.
                    </p>
                </div>

                <!-- Pelayanan Ramah -->
                <div
                    class="bg-white rounded-2xl shadow-md p-8 text-center hover:-translate-y-2 hover:shadow-xl transition duration-300">
                    <div
                        class="bg-gradient-to-r from-orange-500 to-yellow-400 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-headset text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-3 text-gray-800">Pelayanan Ramah & Responsif</h3>
                    <p class="text-gray-600 text-sm">
                        Tim kami siap membantu Anda kapan saja untuk konsultasi produk, pemesanan, atau informasi promo
                        melalui WhatsApp dan media sosial.
                    </p>
                </div>

                <!-- Pembayaran Mudah -->
                <div
                    class="bg-white rounded-2xl shadow-md p-8 text-center hover:-translate-y-2 hover:shadow-xl transition duration-300">
                    <div
                        class="bg-gradient-to-r from-purple-600 to-indigo-400 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-credit-card text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-3 text-gray-800">Pembayaran Mudah & Aman</h3>
                    <p class="text-gray-600 text-sm">
                        Dukung berbagai metode pembayaran: transfer bank, e-wallet, COD, dan pembayaran digital lainnya
                        dengan sistem yang aman.
                    </p>
                </div>

                <!-- Kepercayaan & Reputasi -->
                <div
                    class="bg-white rounded-2xl shadow-md p-8 text-center hover:-translate-y-2 hover:shadow-xl transition duration-300">
                    <div
                        class="bg-gradient-to-r from-yellow-500 to-orange-400 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-3 text-gray-800">Terpercaya Sejak Lama</h3>
                    <p class="text-gray-600 text-sm">
                        Grosir Berkah Jaya telah dipercaya oleh ratusan pelanggan dan toko retail karena konsistensi dalam
                        kualitas, harga, dan pelayanan.
                    </p>
                </div>

            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-blue-50 rounded-lg p-12 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap Berbelanja?</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Belanja kebutuhan harian kini makin mudah di Grosir Berkah Jaya! Harga grosir, produk segar, dan pengiriman
                cepat langsung ke rumah Anda.
            </p>
            <div class="flex gap-4 justify-center">
                <a href="{{ route('products') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold">
                    Belanja Sekarang
                </a>
                <a href="{{ route('contact') }}"
                    class="bg-white hover:bg-gray-100 text-blue-600 border-2 border-blue-600 px-8 py-3 rounded-lg font-semibold">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
@endsection
