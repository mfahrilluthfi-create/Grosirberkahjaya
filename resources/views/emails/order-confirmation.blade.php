<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { background: linear-gradient(135deg, #2563eb, #1e40af); color: white; padding: 30px; text-align: center; }
        .content { padding: 30px; }
        .order-info { background: #f3f4f6; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .alert { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>⚡ Grosir Berkah Jaya</h1>
        <p>Terima kasih atas pesanan Anda!</p>
    </div>

    <div class="content">
        <div class="alert">
            <strong>🎉 Pesanan Berhasil Dibuat!</strong>
            <p>Tim kami sedang mempersiapkan pesanan Anda. Mohon menunggu konfirmasi lebih lanjut.</p>
        </div>

        <p>Halo <strong>{{ $order->shipping_name }}</strong>,</p>

        <div class="order-info">
            <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d F Y, H:i') }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($order->payment_method) }}</p>
        </div>

        <h3>Produk yang Dipesan:</h3>
        <ul>
            @foreach($order->items as $item)
                <li>{{ $item->product_name }} ({{ $item->quantity }}x) - Rp {{ number_format($item->subtotal, 0, ',', '.') }}</li>
            @endforeach
        </ul>

        <h3>Alamat Pengiriman:</h3>
        <div class="order-info">
            <p>{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}</p>
        </div>

        <p><strong>📦 Pesanan Anda sedang kami persiapkan!</strong></p>
        <p>Mohon menunggu, kami akan menghubungi Anda segera.</p>

        <p>Butuh bantuan?</p>
        <p>📱 WhatsApp: +62 813-7849-0913 </p>
        <p>📧 Email: info@grosirberkahjaya.com </p>
    </div>
</body>
</html>
