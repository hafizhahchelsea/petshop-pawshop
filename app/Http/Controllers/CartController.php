<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Jika belum login, redirect ke login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $cart = CartItem::where('user_id', auth()->id())
                        ->with('product')
                        ->get();

        return view('cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        // Hanya user login yang boleh tambah cart
        if (!auth()->check()) {
            return redirect()->route('login')
                             ->with('error', 'Silakan login untuk menambahkan ke keranjang!');
        }

        // Pastikan produk ada
        $product = Product::findOrFail($id);

        // Cek apakah product ini sudah ada di cart user
        $cart = CartItem::where('user_id', auth()->id())
                        ->where('product_id', $id)
                        ->first();

        if ($cart) {
            // Jika sudah ada → tambah quantity
            $cart->increment('quantity');
        } else {
            // Jika belum ada → buat baru
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        // Redirect ke halaman keranjang
        return redirect()->route('cart.index')
                         ->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Pastikan item milik user
        $cart = CartItem::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Jumlah berhasil diperbarui!');
    }

    public function delete($id)
    {
        // Hanya boleh hapus cart milik user sendiri
        $cart = CartItem::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        $cart->delete();

        return back()->with('success', 'Item berhasil dihapus!');
    }
}
