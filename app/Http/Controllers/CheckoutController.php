<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem; 
use App\Models\Order;
use App\Models\Product; // Pastikan model Product dipanggil
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // WAJIB ADA INI

class CheckoutController extends Controller 
{
    public function checkout(Request $request)
    {
        // 1. Ambil data keranjang
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('shop')->with('error', 'Keranjang kosong!');
        }

        // 2. Siapkan data sebelum transaksi
        $daftarNamaProduk = $cartItems->map(function ($item) {
            return $item->product->nama_produk . ' (' . $item->quantity . ')';
        })->implode(', ');

        $totalHarga = $cartItems->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });

        $pathBukti = null; 
        if ($request->hasFile('bukti_pembayaran')) {
            $pathBukti = $request->file('bukti_pembayaran')->store('bukti_bayar', 'public');
        }

        // --- MULAI TRANSAKSI DI SINI ---
        try {
            DB::transaction(function () use ($request, $cartItems, $totalHarga, $daftarNamaProduk, $pathBukti) {
                
                // A. Simpan ke tabel Order
                Order::create([
                    'user_id'          => Auth::id(),
                    'name'             => $request->name,
                    'address'          => $request->address,
                    'phone'            => $request->phone,
                    'total_price'      => $totalHarga,
                    'items'            => $daftarNamaProduk,
                    'payment_method'   => $request->payment_method,
                    'bukti_pembayaran' => $pathBukti,
                    'status'           => 'pending',
                ]);

                // B. Kurangi stok setiap produk
                foreach ($cartItems as $item) {
                    $product = $item->product;

                    // Validasi stok lagi di dalam transaksi agar lebih aman
                    if ($product->stok < $item->quantity) {
                        throw new \Exception('Stok ' . $product->nama_produk . ' mendadak habis!');
                    }

                    $product->stok -= $item->quantity;
                    $product->save();
                }

                // C. Hapus keranjang
                CartItem::where('user_id', Auth::id())->delete();
            });

            // Jika sampai sini, berarti semua proses di atas BERHASIL
            return redirect()->route('home')->with('success', 'Checkout Berhasil!');

        } catch (\Exception $e) {
            // Jika ada yang error di dalam transaksi, akan lari ke sini
            return redirect()->back()->with('error', 'Gagal checkout: ' . $e->getMessage());
        }
    }
}