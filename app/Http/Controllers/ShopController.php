<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // SEARCH
        $query = Product::query();

        if ($request->search) {
            $query->where('nama_produk', 'like', "%".$request->search."%");
        }

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // Ambil produk dari database
        $products = $query->latest()->get();

        return view('shop', compact('products'));
    }
}
