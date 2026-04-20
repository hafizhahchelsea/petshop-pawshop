<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Petshop Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans">

<div class="flex">
    <aside id="sidebar"
           class="w-64 bg-white h-screen shadow-md flex flex-col justify-between fixed transform -translate-x-full md:translate-x-0 transition-all duration-300 z-50 border-r">
        <div>
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-purple-700">Petshop Admin</h1>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium transition">
                    Dashboard
                </a>
                <a href="{{ route('admin.menu') }}"
                   class="block px-4 py-3 rounded-lg bg-purple-100 text-purple-700 font-bold transition">
                    Produk
                </a>
                <a href="{{ route('admin.reviews') }}" 
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium transition">
                    Ulasan
                </a>
                <a href="{{ route('admin.payments') }}"
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium transition">
                    Pembayaran
                </a>
                <a href="{{ route('admin.users') }}"
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium transition">
                    Pengguna
                </a>
            </nav>
        </div>

        <div class="p-4 bg-purple-50 border-t">
            <p class="text-sm text-gray-600">Logged in as:</p>
            <p class="font-semibold text-purple-700">
                {{ Auth::guard('admin')->user()->name }}
            </p>
            <form action="{{ route('admin.logout') }}" method="GET" class="mt-3">
                <button class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition shadow-sm">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 md:ml-64 min-h-screen p-8">
        
        @if(session('success'))
            <div class="max-w-7xl mx-auto mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.style.display='none'" class="font-bold">&times;</button>
            </div>
        @endif

        <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Produk</h2>
                <p class="text-gray-500 text-sm">Kelola katalog produk petshop Anda di sini.</p>
            </div>

            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center px-5 py-2.5 bg-purple-600 text-white font-semibold rounded-xl hover:bg-purple-700 transition shadow-lg shadow-purple-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Produk
            </a>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $p)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 flex flex-col">
                
                <div class="relative group">
                    <img src="{{ asset('images/' . $p->gambar) }}"
                         onerror="this.src='https://placehold.co/400x300?text=No+Image'"
                         alt="{{ $p->nama_produk }}"
                         class="w-full h-48 object-cover transition duration-500 group-hover:scale-105">
                    
                    <div class="absolute top-3 right-3">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-[10px] font-bold uppercase rounded-full shadow-sm text-gray-700 border border-gray-100">
                            Stok: {{ $p->stok }}
                        </span>
                    </div>
                </div>

                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="text-gray-800 font-bold text-lg mb-1 leading-tight capitalize">
                        {{ $p->nama_produk }}
                    </h3>
                    
                    <p class="text-gray-400 text-xs mb-4 line-clamp-2 italic">
                        {{ $p->deskripsi ?? 'Tidak ada deskripsi produk.' }}
                    </p>

                    <div class="mt-auto">
                        <p class="text-purple-700 font-black text-xl mb-4">
                            Rp {{ number_format($p->harga, 0, ',', '.') }}
                        </p>

                        <div class="flex gap-2">
                            <a href="{{ route('admin.menu.edit', $p->id) }}"
                               class="flex-1 text-center bg-gray-50 text-gray-700 hover:bg-purple-50 hover:text-purple-700 py-2.5 rounded-xl text-sm font-bold border border-gray-100 transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.menu.delete', $p->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-white text-red-500 hover:bg-red-50 py-2.5 rounded-xl text-sm font-bold border border-red-50 transition"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </main>
</div>

</body>
</html>