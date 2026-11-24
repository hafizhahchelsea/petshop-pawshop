<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - PawShop</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-fixed bg-cover bg-center min-h-screen pb-20" 
      style="background-image: url('{{ asset('images/Group 8 (1).png') }}');">

   <nav x-data="{ mobileOpen: false }" class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-6 flex items-center justify-between h-20">
        <a href="/" class="flex items-center group">
            <img src="{{ asset('images/logo.jpg') }}" 
                 alt="DM Animal Feed Store Logo" 
                 class="h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
        </a>

            <ul class="hidden lg:flex space-x-10 font-semibold text-gray-600">
                <li><a href="/" class="hover:text-pink-600 transition">Home</a></li>
                <li><a href="/about" class="hover:text-pink-600 transition">About</a></li>
                <li><a href="/shop" class="text-pink-600 border-b-2 border-pink-600 pb-1">Shop</a></li>
                <li><a href="/blog" class="hover:text-pink-600 transition">Blog</a></li>
                <li><a href="/contact" class="hover:text-pink-600 transition">Contact</a></li>
            </ul>

            <div class="hidden lg:flex items-center space-x-5">
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-pink-600 transition">
                    <i class="bi bi-cart3 text-2xl"></i>
                    <span class="absolute top-0 right-0 bg-pink-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">3</span>
                </a>

                @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="focus:outline-none">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-purple-500 flex items-center justify-center text-white">
                            <i class="bi bi-person-fill text-xl"></i>
                        </div>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition
                         class="absolute right-0 mt-3 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">
                        <div class="px-4 py-2 border-b border-gray-50 mb-2">
                            <p class="text-sm font-bold text-gray-800">{{ Auth::user()->username }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="px-2">
                            @csrf
                            <button class="w-full text-left px-3 py-2 text-sm text-red-500 hover:bg-red-50 rounded-lg transition">
                                <i class="bi bi-box-arrow-right mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endauth

                @guest
                    <a href="/login" class="text-gray-600 font-semibold hover:text-pink-600 transition">Login</a>
                    <a href="/register" class="bg-pink-600 text-white px-6 py-2.5 rounded-full font-bold shadow-lg shadow-pink-200 hover:bg-pink-700 transition transform active:scale-95">Register</a>
                @endguest
            </div>

            <button class="lg:hidden" @click="mobileOpen = !mobileOpen">
                <i class="bi bi-list text-3xl text-pink-600"></i>
            </button>
        </div>

        <div x-show="mobileOpen" x-transition class="lg:hidden bg-white border-t px-6 py-6 space-y-4 shadow-xl">
            <a href="/" class="block text-lg font-semibold text-gray-700">Home</a>
            <a href="/shop" class="block text-lg font-bold text-pink-600">Shop</a>
            <a href="/blog" class="block text-lg font-semibold text-gray-700">Blog</a>
            <a href="/contact" class="block text-lg font-semibold text-gray-600">contact</a>
            <a href="/cart" class="block text-lg font-semibold text-gray-600">Keranjang</a>
            <hr>
            <a href="{{ route('cart.index') }}" class="block text-lg font-semibold text-gray-700">Keranjang</a>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-6 pt-12 text-center">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-2">Kebutuhan Anabul <span class="text-pink-600">Terlengkap</span></h1>
        <p class="text-gray-500 mb-8">Temukan makanan, mainan, dan aksesori terbaik untuk hewan kesayanganmu.</p>

        <section class="max-w-2xl mx-auto">
            <form method="GET" action="{{ route('shop') }}" class="relative group">
                <input type="text" name="search" placeholder="Cari produk favoritmu..." value="{{ request('search') }}"
                       class="w-full pl-12 pr-32 py-4 bg-white rounded-2xl shadow-lg border-2 border-transparent focus:border-pink-500 focus:ring-0 outline-none transition-all duration-300">
                <i class="bi bi-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-xl group-focus-within:text-pink-500 transition"></i>
                <button type="submit"
                        class="absolute right-2 top-2 bottom-2 bg-pink-600 text-white px-8 rounded-xl font-bold hover:bg-pink-700 transition transform active:scale-95">
                    Cari
                </button>
            </form>
        </section>
    </header>
      
    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="flex items-center space-x-4 mb-10">
            <h2 class="text-2xl font-bold text-gray-800 shrink-0">Produk Pilihan</h2>
            <div class="h-[2px] bg-pink-100 w-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $p)
            <div class="glass-effect group rounded-[2rem] p-5 border border-white/50 shadow-sm hover:shadow-2xl hover:border-pink-200 transition-all duration-500 flex flex-col relative overflow-hidden">
                
                @if($p->stok <= 0)
                <div class="absolute inset-0 bg-white/60 z-10 flex items-center justify-center backdrop-blur-[2px]">
                     <span class="bg-gray-800 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">Stok Habis</span>
                </div>
                @endif

                <div class="relative overflow-hidden rounded-2xl bg-gray-50 mb-5 aspect-square flex items-center justify-center">
                    <img src="{{ asset('images/' . $p->gambar) }}"
                         alt="{{ $p->nama_produk }}"
                         class="w-full h-full object-contain p-4 transition duration-500 group-hover:scale-110">
                </div>

                <div class="flex flex-col flex-grow">
                    <span class="text-[10px] font-bold text-purple-500 uppercase tracking-widest mb-1">{{ $p->deskripsi }}</span>
                    <h3 class="text-gray-800 font-bold text-lg leading-tight mb-2 group-hover:text-pink-600 transition">{{ $p->nama_produk }}</h3>

                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-xs text-gray-400">Harga</p>
                            <p class="text-lg font-extrabold text-pink-600">
                                Rp{{ number_format($p->harga, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] text-gray-400 font-bold uppercase">Stok</p>
                            <p class="text-sm font-bold {{ $p->stok > 0 ? 'text-gray-700' : 'text-red-500' }}">
                                {{ $p->stok }} pcs
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        @if($p->stok > 0)
                            <form action="{{ route('cart.add', $p->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                    class="w-full bg-gray-900 text-white py-3 rounded-xl font-bold hover:bg-pink-600 shadow-lg shadow-gray-200 hover:shadow-pink-200 transition-all duration-300 transform active:scale-95 flex items-center justify-center gap-2">
                                    <i class="bi bi-plus-lg"></i> Keranjang
                                </button>
                            </form>
                        @else
                            <button type="button" disabled 
                                class="w-full bg-gray-100 text-gray-400 py-3 rounded-xl font-bold cursor-not-allowed">
                                Kosong
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

</body>
</html>