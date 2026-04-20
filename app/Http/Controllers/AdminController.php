<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan semua pesanan di Dashboard Admin
    public function orders()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $orders = Order::latest()->get();
        $totalOrders = $orders->count();

        return view('admin.dashboard', compact('totalProducts', 'totalUsers', 'orders', 'totalOrders'));
    }

    // Update status pesanan (Pending/Proses/Selesai)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // Khusus halaman list pembayaran (untuk cek bukti transfer)
    public function pembayaran()
    {
        $payments = Order::whereNotNull('payment_method')->latest()->get();
        return view('admin.pembayaran', compact('payments'));
    }
}