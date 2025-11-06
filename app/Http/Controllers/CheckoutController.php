<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use Illuminate\Routing\Controller;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong!');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->final_price * $item->quantity);
        $shippingCost = $subtotal >= 500000 ? 0 : 0;
        $total = $subtotal + $shippingCost;

        return view('checkout', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email',
            'phone'          => 'required|string|max:20',
            'province'       => 'required|string',
            'city'           => 'required|string',
            'postal_code'    => 'required|string|max:10',
            'address'        => 'required|string',
            'payment_method' => 'required|in:bank_transfer,e_wallet,credit_card,cod',
            'notes'          => 'nullable|string',
        ]);

        $cartItems = Auth::user()->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong!');
        }

        // ✅ Cek stok produk sebelum transaksi
        foreach ($cartItems as $item) {
            if ($item->product->stock < $item->quantity) {
                return redirect()->route('cart')->with('error', "Stok {$item->product->name} tidak mencukupi! Stok tersedia: {$item->product->stock}");
            }
        }

        DB::beginTransaction();

        try {
            $subtotal = $cartItems->sum(fn($item) => $item->product->final_price * $item->quantity);
            $shippingCost = $subtotal >= 500000 ? 0 : 0;
            $total = $subtotal + $shippingCost;

            // ✅ Simpan pesanan
            $order = Order::create([
                'order_number'      => Order::generateOrderNumber(),
                'user_id'           => Auth::id(),
                'subtotal'          => $subtotal,
                'shipping_cost'     => $shippingCost,
                'discount'          => 0,
                'total'             => $total,
                'payment_method'    => $validated['payment_method'],
                'status'            => 'pending',
                'shipping_name'     => $validated['full_name'],
                'shipping_phone'    => $validated['phone'],
                'shipping_email'    => $validated['email'],
                'shipping_address'  => $validated['address'],
                'shipping_city'     => $validated['city'],
                'shipping_province' => $validated['province'],
                'shipping_postal_code' => $validated['postal_code'],
                'notes'             => $validated['notes'] ?? null,
            ]);

            // ✅ Simpan detail item pesanan & update stok
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product_id,
                    'product_name' => $item->product->name,
                    'price'        => $item->product->final_price,
                    'quantity'     => $item->quantity,
                    'subtotal'     => $item->product->final_price * $item->quantity,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            // ✅ Hapus keranjang setelah order selesai
            Auth::user()->carts()->delete();

            DB::commit();

            // ✅ Kirim email konfirmasi
            try {
                Mail::to($order->shipping_email)->send(new OrderConfirmation($order));
            } catch (\Exception $e) {
                \Log::error('Gagal mengirim email konfirmasi: ' . $e->getMessage());
            }

            return redirect()->route('checkout.success', $order->order_number)
                ->with('success', 'Pesanan berhasil dibuat! Konfirmasi dikirim ke ' . $order->shipping_email);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Checkout gagal: ' . $e->getMessage());
            return redirect()->route('cart')->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
        }
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->with('items') // ✅ include item pesanan untuk halaman sukses
            ->firstOrFail();

        return view('checkout-success', compact('order'));
    }
}
