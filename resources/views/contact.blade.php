@extends('layouts.master')

@section('title', 'Hubungi Kami - Grosirberkahjaya')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Hubungi Kami</h1>
            <p class="text-xl opacity-90">Kami siap membantu Anda 24/7</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
            <!-- Contact Information -->
            <div class="bg-white rounded-xl shadow-xl p-8 lg:p-10">
                <h2 class="text-3xl font-bold mb-8 text-gray-800">Informasi Kontak</h2>

                <div class="space-y-6">
                    <div class="flex items-start gap-4 group">
                        <div class="bg-blue-100 w-16 h-16 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-200 transition">
                            <i class="fas fa-map-marker-alt text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-2 text-gray-800">Alamat</h3>
                            <p class="text-gray-600 leading-relaxed">Jl. Simpang Jengkol,Kulim <br>Kota Pekanbaru, Riau 28293<br>Indonesia</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 group">
                        <div class="bg-green-100 w-16 h-16 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-green-200 transition">
                            <i class="fas fa-phone text-green-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-2 text-gray-800">Telepon</h3>
                            <a href="tel:+6281234567890" class="text-gray-600 hover:text-green-600 transition block">+62 813-7849-0913 </a>

                        </div>
                    </div>

                    <div class="flex items-start gap-4 group">
                        <div class="bg-orange-100 w-16 h-16 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-orange-200 transition">
                            <i class="fas fa-envelope text-orange-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-2 text-gray-800">Email</h3>
                            <a href="mailto:elyctravoid@gmail.com" class="text-gray-600 hover:text-orange-600 transition block">info@grosirberkahjaya</a>

                        </div>
                    </div>

                    <div class="flex items-start gap-4 group">
                        <div class="bg-purple-100 w-16 h-16 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-purple-200 transition">
                            <i class="fas fa-clock text-purple-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-2 text-gray-800">Jam Operasional</h3>
                            <p class="text-gray-600 leading-relaxed">Senin - Jumat: 08:00 - 18:00<br>Sabtu - Minggu : 09:00 - 16:00</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-xl shadow-xl p-8 lg:p-10">
                <h2 class="text-3xl font-bold mb-8 text-gray-800">Ikuti Kami</h2>
                <div class="space-y-4">
                    <a href="https://www.facebook.com/share/1HcwyamkBV/"
                        class="flex items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 hover:shadow-lg transition transform hover:-translate-y-1">
                        <div class="bg-blue-100 w-14 h-14 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fab fa-facebook text-3xl text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 text-lg">Facebook</p>
                            <p class="text-sm text-gray-500">@grosirberkahjaya</p>
                        </div>
                        <i class="fas fa-arrow-right ml-auto text-gray-400"></i>
                    </a>

                    <a href="https://www.instagram.com/grosirberkahjaya_?igsh=MXdwZGVhcGpwbHc3dA=="
                        class="flex items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-pink-500 hover:bg-pink-50 hover:shadow-lg transition transform hover:-translate-y-1">
                        <div class="bg-pink-100 w-14 h-14 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fab fa-instagram text-3xl text-pink-600"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 text-lg">Instagram</p>
                            <p class="text-sm text-gray-500">@grosirberkahjaya</p>
                        </div>
                        <i class="fas fa-arrow-right ml-auto text-gray-400"></i>
                    </a>

                    <a href="https://wa.me/qr/5A4KBJ6FKL7YN1" target="_blank"
                        class="flex items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-green-500 hover:bg-green-50 hover:shadow-lg transition transform hover:-translate-y-1">
                        <div class="bg-green-100 w-14 h-14 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fab fa-whatsapp text-3xl text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 text-lg">WhatsApp</p>
                            <p class="text-sm text-gray-500">Chat Kami Sekarang</p>
                        </div>
                        <i class="fas fa-arrow-right ml-auto text-gray-400"></i>
                    </a>


                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="p-8 pb-6">
                <h2 class="text-3xl font-bold text-gray-800">Lokasi Kami</h2>
                <p class="text-gray-600 mt-2">Kunjungi toko kami untuk pengalaman berbelanja langsung</p>
            </div>
            <div class="w-full h-[500px] bg-gray-200">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4032.107662911761!2d101.36552647406902!3d0.4648896995244211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ac1a62b2d7ef%3A0x4a9e6b3c9479343c!2sUIN%20Sultan%20Syarif%20Kasim%20Riau!5e0!3m2!1sid!2sid!4v1730791520000!5m2!1sid!2sid"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
@endsection
