@extends('layouts.master')

@section('title', 'Pesanan Berhasil - ElektroMart')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <!-- SUCCESS ICON -->
                <div class="mb-6">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-green-600 text-4xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Pesanan Berhasil!</h1>
                    <p class="text-gray-600">Terima kasih telah berbelanja di Grosir Berkah Jaya</p>
                </div>

                <!-- ORDER DETAILS -->
                <div class="bg-blue-50 rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-gray-600">Nomor Pesanan:</span>
                        <span class="font-bold">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-gray-600">Tanggal:</span>
                        <span class="font-semibold">{{ $order->created_at->format('d F Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total:</span>
                        <span class="font-bold text-blue-600 text-xl">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- EMAIL CONFIRMATION INFO -->
                <div class="mb-8">
                    <div class="flex items-start gap-3 p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-left">
                        <i class="fas fa-envelope text-yellow-600 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800 mb-1">Email Konfirmasi Telah Dikirim</p>
                            <p class="text-sm text-gray-600">
                                Kami telah mengirimkan email konfirmasi pesanan ke
                                <strong>{{ $order->shipping_email }}</strong>.
                                Silakan cek inbox atau folder spam.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- PAYMENT INSTRUCTIONS -->
                @if ($order->payment_method === 'bank_transfer')
                    <div class="mb-8 bg-orange-50 border border-orange-200 rounded-lg p-6 text-left">
                        <h3 class="font-bold text-lg mb-3">
                            <i class="fas fa-info-circle text-orange-600 mr-2"></i>
                            Instruksi Pembayaran
                        </h3>
                        <p class="text-gray-700 mb-3">Silakan transfer ke salah satu rekening berikut:</p>
                        <div class="space-y-2 text-sm bg-white p-4 rounded">
                            <div><strong>BCA - 1234567890</strong> a.n. ElektroMart</div>
                            <div><strong>Mandiri - 0987654321</strong> a.n. ElektroMart</div>
                            <div><strong>BNI - 5556667778</strong> a.n. ElektroMart</div>
                        </div>
                        <p class="text-sm text-gray-600 mt-3">
                            Setelah transfer, konfirmasi melalui WhatsApp:
                            <strong class="text-green-600">+62 812-3456-7890</strong>
                        </p>
                    </div>
                @elseif($order->payment_method === 'cod')
                    <div class="mb-8 bg-green-50 border border-green-200 rounded-lg p-6">
                        <h3 class="font-bold text-lg mb-2">
                            <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>
                            Bayar di Tempat (COD)
                        </h3>
                        <p class="text-gray-700">Siapkan uang tunai sebesar:</p>
                        <p class="text-2xl font-bold text-green-600 my-2">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </p>
                    </div>
                @endif

                <!-- NEXT STEPS -->
                <div class="space-y-4 mb-8">
                    <h3 class="font-bold text-lg text-left">Langkah Selanjutnya:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-blue-600 font-bold text-xl">1</span>
                            </div>
                            <p class="text-sm font-semibold mb-1">Konfirmasi Email</p>
                            <p class="text-xs text-gray-600">Cek email konfirmasi pesanan Anda</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-blue-600 font-bold text-xl">2</span>
                            </div>
                            <p class="text-sm font-semibold mb-1">Lakukan Pembayaran</p>
                            <p class="text-xs text-gray-600">Ikuti instruksi pembayaran di email</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-blue-600 font-bold text-xl">3</span>
                            </div>
                            <p class="text-sm font-semibold mb-1">Pesanan Diproses</p>
                            <p class="text-xs text-gray-600">Kami akan memproses pesanan Anda</p>
                        </div>
                    </div>
                </div>

                <!-- BUTTONS -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                        <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                    </a>
                    <a href="{{ route('products') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg font-semibold">
                        <i class="fas fa-shopping-bag mr-2"></i>Lanjut Belanja
                    </a>
                </div>

                <!-- CONTACT -->
                <div class="mt-8 pt-6 border-t">
                    <p class="text-sm text-gray-600 mb-3">Butuh bantuan? Hubungi kami:</p>
                    <div class="flex justify-center gap-4">
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="flex items-center gap-2 text-green-600 hover:text-green-700">
                            <i class="fab fa-whatsapp text-xl"></i>
                            <span class="text-sm">WhatsApp</span>
                        </a>
                        <a href="tel:+6281234567890" class="flex items-center gap-2 text-blue-600 hover:text-blue-700">
                            <i class="fas fa-phone text-xl"></i>
                            <span class="text-sm">Telepon</span>
                        </a>
                        <a href="mailto:info@elektromart.com"
                            class="flex items-center gap-2 text-orange-600 hover:text-orange-700">
                            <i class="fas fa-envelope text-xl"></i>
                            <span class="text-sm">Email</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- EmailJS SDK -->
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

<script>
    (function() {
        emailjs.init("Gi2CWCCdltl8azHB1"); // Ganti dengan PUBLIC KEY EmailJS kamu
    })();

    window.addEventListener('DOMContentLoaded', sendOrderEmail);

    function sendOrderEmail() {
        const emailData = {
            customer_name: "{{ $order->shipping_name }}",
            customer_email: "{{ $order->shipping_email }}",
            order_number: "{{ $order->order_number }}",
            order_date: "{{ $order->created_at->format('d F Y, H:i') }}",
            total: "{{ number_format($order->total, 0, ',', '.') }}",
            payment_method: "{{ $order->payment_method === 'bank_transfer' ? 'Transfer Bank' : ($order->payment_method === 'e_wallet' ? 'E-Wallet' : ($order->payment_method === 'credit_card' ? 'Kartu Kredit' : 'COD')) }}",
            products: "{{ implode('\n', $order->items->map(fn($item) => $item->product_name . ' (' . $item->quantity . 'x) - Rp ' . number_format($item->subtotal, 0, ',', '.'))->toArray()) }}",
            shipping_address: "{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}"
        };

        emailjs.send("service_web", "template_zlyhit9", emailData)
            .then(res => showNotification('Email konfirmasi telah dikirim ke ' + emailData.customer_email, 'success'))
            .catch(err => {
                console.error('Email gagal dikirim:', err);
                showNotification('Email konfirmasi akan dikirim segera.', 'info');
            });
    }

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className =
            `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500' :
                type === 'error' ? 'bg-red-500' :
                'bg-blue-500'
            } text-white`;
        notification.innerHTML = `
            <div class="flex items-center gap-2">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 5000);
    }
</script>
