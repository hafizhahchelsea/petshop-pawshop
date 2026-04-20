<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Keranjang Belanja - Pet Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-pattern {
            background-color: #fff9f9;
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23fbcfe8' fill-opacity='0.4' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='3'/%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="bg-pattern min-h-screen">

   <nav x-data="{ mobileOpen: false }" class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto px-6 flex items-center justify-between h-20">
        <a href="/" class="flex items-center group">
            <img src="{{ asset('images/logo.jpg') }}" 
                 alt="DM Animal Feed Store Logo" 
                 class="h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
        </a>

        <ul class="hidden lg:flex space-x-10 font-semibold text-gray-500">
            <li><a href="/" class="text-pink-600 border-b-2 border-pink-600 pb-1">Home</a></li>
            <li><a href="/about" class="hover:text-pink-600 transition">About Us</a></li>
            <li><a href="/shop" class="hover:text-pink-600 transition">Shop</a></li>
            <li><a href="/blog" class="hover:text-pink-600 transition">Blog</a></li>
            <li><a href="/contact" class="hover:text-pink-600 transition">Contact Us</a></li>
        </ul>

            <div class="hidden lg:flex items-center space-x-5 text-pink-600">
                <a href="{{ route('cart.index') }}" class="relative p-2 bg-pink-50 rounded-full">
                    <i class="bi bi-cart3 text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-pink-600 text-white text-[10px] font-bold px-1.5 rounded-full border-2 border-white">{{ $cart->count() }}</span>
                </a>

                @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center border-2 border-transparent hover:border-pink-600 transition">
                        <i class="bi bi-person text-xl"></i>
                    </button>
                    <div x-show="open" x-transition @click.away="open = false" class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                        <div class="px-5 py-4 border-b bg-gray-50">
                            <p class="text-sm font-bold text-gray-800">{{ Auth::user()->username }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="p-2">
                            @csrf
                            <button class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 rounded-xl transition">Logout</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>

            <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-pink-600 text-3xl">
                <i :class="mobileOpen ? 'bi bi-x' : 'bi bi-list'"></i>
            </button>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-12" x-data="{ checkoutOpen: false }">
        
        <header class="mb-12 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Keranjang <span class="text-pink-600">Belanja</span></h1>
            <div class="w-20 h-1.5 bg-pink-600 mx-auto rounded-full"></div>
        </header>

        @if($cart->count() == 0)
        <div class="bg-white/80 backdrop-blur p-12 rounded-[2.5rem] shadow-sm border border-pink-100 text-center">
            <div class="w-20 h-20 bg-pink-50 text-pink-300 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="bi bi-cart-x text-4xl"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">Keranjangmu Kosong</h2>
            <p class="text-gray-500 mb-6">Sepertinya anabulmu butuh sesuatu yang baru hari ini!</p>
            <a href="/shop" class="bg-pink-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-pink-100 hover:bg-pink-700 transition">
                Mulai Belanja
            </a>
        </div>
        @else

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart as $item)
                <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-50 flex flex-col sm:flex-row items-center gap-6 hover:shadow-md transition">
                    <img src="{{ asset('images/' . $item->product->gambar) }}" 
                         class="w-28 h-28 rounded-2xl object-cover shadow-sm bg-gray-50" />
                    
                    <div class="flex-grow text-center sm:text-left">
                        <h3 class="text-lg font-extrabold text-gray-800">{{ $item->product->nama_produk }}</h3>
                        <p class="text-pink-600 font-bold mb-3">Rp {{ number_format($item->product->harga, 0, ',', '.') }}</p>
                        
                        <div class="flex items-center justify-center sm:justify-start gap-4">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center bg-gray-50 p-1 rounded-xl border">
                                @csrf
                                <input type="number" name="quantity" min="1" max="{{ $item->product->stok }}" value="{{ $item->quantity }}"
                                       class="w-12 bg-transparent text-center font-bold text-gray-700 outline-none" />
                                <button class="bg-white text-pink-600 p-1 px-3 rounded-lg shadow-sm font-bold text-xs hover:bg-pink-600 hover:text-white transition">SET</button>
                            </form>
                            
                            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-400 hover:text-red-600 transition text-xl">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="text-right hidden sm:block">
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Subtotal</p>
                        <p class="text-xl font-black text-gray-900">Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <aside class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-pink-100 sticky top-28">
                <h3 class="text-xl font-bold mb-6 border-b pb-4 text-gray-800">Ringkasan Order</h3>
                
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between text-gray-500">
                        <span>Total Barang</span>
                        <span class="font-bold text-gray-800">{{ $cart->sum('quantity') }} Pcs</span>
                    </div>
                    <div class="flex justify-between text-xl font-black text-gray-900 pt-4 border-t border-dashed">
                        <span>Total</span>
                        <span class="text-pink-600">Rp {{ number_format($cart->sum(fn($i) => $i->product->harga * $i->quantity), 0, ',', '.') }}</span>
                    </div>
                </div>

                <button @click="checkoutOpen = true" 
                        class="w-full bg-gray-900 text-white py-4 rounded-2xl font-bold shadow-xl hover:bg-pink-600 transition-all transform active:scale-95">
                    Lanjut Checkout
                </button>
                <p class="text-center text-[10px] text-gray-400 mt-4 uppercase tracking-widest font-bold italic">*Pajak & Ongkir dihitung nanti</p>
            </aside>
        </div>

        <div x-show="checkoutOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center z-[100] px-4">
            
            <div @click.away="checkoutOpen = false" 
                 class="bg-white w-full max-w-lg p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
                
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-pink-500 to-purple-600"></div>

                <h2 class="text-3xl font-black text-gray-900 mb-8 text-center uppercase tracking-tighter">Data <span class="text-pink-600">Pengiriman</span></h2>

                <form action="/payment" method="GET" class="space-y-5">
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-gray-400 ml-1">Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Contoh: Budi Santoso" required
                               class="w-full bg-gray-50 border-2 border-gray-50 p-4 rounded-2xl focus:bg-white focus:border-pink-500 transition-all outline-none" />
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-gray-400 ml-1">WhatsApp</label>
                        <input type="text" name="phone" placeholder="0812..." required
                               class="w-full bg-gray-50 border-2 border-gray-50 p-4 rounded-2xl focus:bg-white focus:border-pink-500 transition-all outline-none" />
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-gray-400 ml-1">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" placeholder="Nama jalan, nomor rumah, kec, kota..." required
                                  class="w-full bg-gray-50 border-2 border-gray-50 p-4 rounded-2xl focus:bg-white focus:border-pink-500 transition-all outline-none resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <button type="button" @click="checkoutOpen = false"
                                class="py-4 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit"
                                class="py-4 bg-pink-600 text-white font-bold rounded-2xl shadow-lg shadow-pink-100 hover:bg-pink-700 transition">
                            Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @endif
    </main>

</body>
</html>