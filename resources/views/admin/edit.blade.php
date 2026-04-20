<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Produk - Petshop Admin</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 font-sans">

<div class="flex">
    <aside id="sidebar"
           class="w-64 bg-white h-screen shadow-md flex flex-col justify-between fixed transform -translate-x-full md:translate-x-0 transition-all duration-300 z-50">
        <div>
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-purple-700">Petshop Admin</h1>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium">
                    Dashboard
                </a>
                <a href="{{ route('admin.menu') }}"
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-purple-700 font-bold">
                    Produk
                </a>
                <a href="{{ route('admin.reviews') }}" 
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium">
                    Ulasan
                </a>
                <a href="{{ route('admin.payments') }}"
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium">
                    Pembayaran
                </a>
                <a href="{{ route('admin.users') }}"
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium">
                    Pengguna
                </a>
            </nav>
        </div>

        <div class="p-4 bg-purple-50 border-t">
            <p class="text-sm text-gray-600">Logged in as:</p>
            <p class="font-semibold text-purple-700">{{ Auth::guard('admin')->user()->name }}</p>
            <form action="{{ route('admin.logout') }}" method="GET" class="mt-3">
                <button class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 md:ml-64 p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Edit Produk</h2>
                <p class="text-gray-500">Perbarui informasi produk dan stok toko Anda.</p>
            </div>
            <a href="{{ route('admin.menu') }}" class="text-purple-600 hover:underline"> Kembali ke Daftar</a>
        </div>

        <form action="{{ route('admin.menu.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-col lg:flex-row gap-8">
                
                <div class="w-full lg:w-1/3">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 sticky top-8">
                        <label class="block mb-4 font-bold text-gray-700 uppercase text-xs tracking-wider">Foto Produk Saat Ini</label>
                        <div class="relative group">
                            <img src="{{ asset('images/' . $product->gambar) }}" 
                                 class="w-full h-80 object-cover rounded-lg shadow-inner border"
                                 alt="Gambar Produk" />
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition rounded-lg text-white text-sm">
                                Preview Gambar
                            </div>
                        </div>
                        <div class="mt-6">
                            <label class="block mb-2 font-semibold text-gray-700">Ganti Foto Produk</label>
                            <input type="file" name="gambar" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 shadow-sm border rounded-lg p-2" />
                            <p class="text-xs text-gray-400 mt-2 italic">*Biarkan kosong jika tidak ingin mengganti gambar.</p>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3">
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="md:col-span-2">
                                <label class="block mb-2 font-semibold text-gray-700">Nama Produk</label>
                                <input type="text" name="nama_produk" value="{{ $product->nama_produk }}" 
                                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:outline-none transition shadow-sm" required />
                            </div>

                            <div>
                                <label class="block mb-2 font-semibold text-gray-700">Harga (Rp)</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold">Rp</span>
                                    <input type="number" name="harga" value="{{ $product->harga }}" 
                                        class="w-full border-gray-300 border rounded-lg p-3 pl-10 focus:ring-2 focus:ring-purple-500 focus:outline-none transition shadow-sm" required />
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 font-semibold text-gray-700">Stok Barang</label>
                                <input type="number" name="stok" value="{{ $product->stok }}" 
                                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:outline-none transition shadow-sm" required />
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block mb-2 font-semibold text-gray-700">Deskripsi Produk</label>
                            <textarea name="deskripsi" rows="5"
                                class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:outline-none transition shadow-sm" required>{{ $product->deskripsi }}</textarea>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" 
                                class="flex-1 bg-purple-700 text-white px-8 py-4 rounded-xl text-lg font-bold hover:bg-purple-800 transition transform active:scale-95 shadow-lg">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </main>
</div>

</body>
</html>