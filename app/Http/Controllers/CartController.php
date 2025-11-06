<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();

        $subtotal = $cartItems->sum(function($item) {
            return $item->product->final_price * $item->quantity;
        });

        $shippingCost = $subtotal >= 500000 ? 0 : 0; // Free shipping
        $total = $subtotal + $shippingCost;

        return view('cart', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $request->quantity;

            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }

            $cart->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, Cart $cart)
    {
        // Manual authorization check
        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($cart->product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Keranjang berhasil diupdate!');
    }

    public function destroy(Cart $cart)
    {
        // Manual authorization check
        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $cart->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function clear()
    {
        Auth::user()->carts()->delete();

        return back()->with('success', 'Keranjang berhasil dikosongkan!');
    }

    public function count()
    {
        $count = Auth::check() ? Auth::user()->carts()->sum('quantity') : 0;
        return response()->json(['count' => $count]);
    }
}
