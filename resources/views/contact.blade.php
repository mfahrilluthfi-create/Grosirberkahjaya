@extends('layouts.master')

@section('title', 'Hubungi Kami - Grosirberkahjaya')

@section('content')
<div class="bg-blue-600 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Hubungi Kami</h1>
        <p class="text-xl">Kami siap membantu Anda 24/7</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Kirim Pesan</h2>
                <form id="contact-form" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Nama Lengkap *</label>
                        <input type="text" name="name" required
                               class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" required
                               class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">No. Telepon</label>
                        <input type="tel" name="phone"
                               class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Subjek *</label>
                        <input type="text" name="subject" required
                               class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Pesan *</label>
                        <textarea name="message" rows="5" required
                                  class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Informasi Kontak</h2>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Alamat</h3>
                            <p class="text-gray-600">Jl Simpang Jengko,Kulim </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Telepon</h3>
                            <p class="text-gray-600">+62 813-7849-0913 </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-orange-100 w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-orange-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Email</h3>
                            <p class="text-gray-600">@grosirberkahjaya.com<br>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Jam Operasional</h3>
                            <p class="text-gray-600">Senin - Jumat: 08:00 - 21:00<br>Sabtu: 09:00 - 16:00<br>Minggu: Tutup</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Ikuti Kami</h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="https://www.facebook.com/share/1A2g2Qxc2F/" class="flex items-center gap-3 p-4 border rounded-lg hover:bg-blue-50 transition">
                        <i class="fab fa-facebook text-3xl text-blue-600"></i>
                        <div>
                            <p class="font-semibold">Facebook</p>
                            <p class="text-sm text-gray-600">@GrosirBerkahJaya</p>
                        </div>
                    </a>
                    <a href="https://www.instagram.com/damdmw_?igsh=M2tuOGprbXF5YXpu" class="flex items-center gap-3 p-4 border rounded-lg hover:bg-pink-50 transition">
                        <i class="fab fa-instagram text-3xl text-pink-600"></i>
                        <div>
                            <p class="font-semibold">Instagram</p>
                            <p class="text-sm text-gray-600">@GrosirBerkahJaya</p>
                        </div>
                    </a>
                    <a href="https://x.com/farelluth_?t=jxgvV8OqjYwz15GK_isvIQ&s=09" class="flex items-center gap-3 p-4 border rounded-lg hover:bg-blue-50 transition">
                        <i class="fab fa-twitter text-3xl text-blue-400"></i>
                        <div>
                            <p class="font-semibold">Twitter</p>
                            <p class="text-sm text-gray-600">@GrosirBerkahJaya</p>
                        </div>
                    </a>
                    <a href="https://wa.me/qr/5A4KBJ6FKL7YN1" target="_blank" class="flex items-center gap-3 p-4 border rounded-lg hover:bg-green-50 transition">
                        <i class="fab fa-whatsapp text-3xl text-green-600"></i>
                        <div>
                            <p class="font-semibold">WhatsApp</p>
                            <p class="text-sm text-gray-600">Chat Kami</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 bg-white rounded-lg shadow-lg p-4">
    <h2 class="text-2xl font-bold mb-6 px-4 pt-4">Lokasi Kami</h2>
    <div class="w-full h-96 bg-gray-200 rounded-lg overflow-hidden">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4032.107662911761!2d101.36552647406902!3d0.4648896995244211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ac1a62b2d7ef%3A0x4a9e6b3c9479343c!2sUIN%20Sultan%20Syarif%20Kasim%20Riau!5e0!3m2!1sid!2sid!4v1730791520000!5m2!1sid!2sid"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault();

        // Simulate form submission
        alert('Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
        this.reset();
    });
</script>
@endsection
