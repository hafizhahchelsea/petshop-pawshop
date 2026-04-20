<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{   
    // ============================
    // INDEX (LIST + SEARCH + FILTER)
    // ============================
    public function index(Request $request)
    {
        $search = $request->search;
        $category = $request->category;

        $products = Product::query();

        // Search nama_produk
        if ($search) {
            $products->where('nama_produk', 'LIKE', '%'.$search.'%');
        }

        // Filter berdasarkan deskripsi (atau kategori jika ada kolomnya)
        if ($category) {
            $products->where('deskripsi', 'LIKE', '%'.$category.'%');
        }

        // Menggunakan appends agar pagination tetap membawa parameter search/filter
        $products = $products->latest()->paginate(10)->appends($request->all());

        return view('admin.menu', compact('products', 'search', 'category'));
    }

    // ============================
    // FORM CREATE
    // ============================
    public function create() 
    {
        return view('admin.products');
    }

    // ============================
    // STORE PRODUK BARU
    // ============================
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'required|image|mimes:jpg,png,jpeg|max:2048', // Batas 2MB
            'deskripsi'   => 'required'
        ]);

        // Proses Upload gambar
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $gambarName);
            $validatedData['gambar'] = $gambarName;
        }

        Product::create($validatedData);

        return redirect()->route('admin.menu')->with('success', 'Produk berhasil ditambahkan!');
    }

    // ============================
    // FORM EDIT
    // ============================
    public function edit($id) 
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    // ============================
    // UPDATE PRODUK
    // ============================
    public function update(Request $request, $id) 
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'required',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Opsional saat update
        ]);

        // Jika user mengunggah gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada di folder public
            $oldFilePath = public_path('images/' . $product->gambar);
            if ($product->gambar && File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }

            // Upload gambar baru
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $gambarName);
            $validatedData['gambar'] = $gambarName;
        }

        $product->update($validatedData);

        return redirect()->route('admin.menu')->with('success', 'Produk berhasil diupdate!');
    }

    // ============================
    // HAPUS PRODUK
    // ============================
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar dari penyimpanan
        $filePath = public_path('images/' . $product->gambar);
        if ($product->gambar && File::exists($filePath)) {
            File::delete($filePath);
        }

        $product->delete();

        return redirect()->route('admin.menu')->with('success', 'Produk berhasil dihapus!');
    }
}