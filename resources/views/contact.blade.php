<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami | Pawfect Pet Shop</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        /* Custom scrollbar untuk list ulasan */
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #db2777; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#FFF9F9] text-gray-800">

<nav x-data="{ mobileOpen: false }" class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-6 flex items-center justify-between h-20">
        <a href="/" class="flex items-center group">
            <img src="{{ asset('images/logo.jpg') }}" 
                 alt="DM Animal Feed Store Logo" 
                 class="h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
        </a>

        <ul class="hidden lg:flex space-x-10 font-semibold text-gray-500">
            <li><a href="/" class="hover:text-pink-600 transition">Home</a></li>
            <li><a href="/about" class="hover:text-pink-600 transition">About Us</a></li>
            <li><a href="/shop" class="hover:text-pink-600 transition">Shop</a></li>
            <li><a href="/blog" class="hover:text-pink-600 transition">Blog</a></li>
            <li><a href="/contact" class="text-pink-600 border-b-2 border-pink-600 pb-1">Contact</a></li>
        </ul>

        <div class="hidden lg:flex items-center space-x-5">
            <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-pink-600 text-xl transition"><i class="bi bi-cart3"></i></a>
            @auth
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center focus:outline-none">
                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center border-2 border-transparent hover:border-pink-600 transition">
                        <i class="bi bi-person text-pink-600 text-xl"></i>
                    </div>
                </button>
                <div x-show="open" x-transition @click.away="open = false" class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 overflow-hidden">
                    <div class="px-5 py-4 border-b bg-gray-50">
                        <p class="text-sm font-bold">{{ Auth::user()->username }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="p-2">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 rounded-xl transition font-semibold">Logout</button>
                    </form>
                </div>
            </div>
            @endauth
            @guest
                <a href="/login" class="font-bold text-gray-600 hover:text-pink-600 transition">Login</a>
                <a href="/register" class="bg-pink-600 text-white px-6 py-2 rounded-full font-bold shadow-lg shadow-pink-100 hover:bg-pink-700 transition">Join</a>
            @endguest
        </div>

        <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-pink-600 text-3xl">
            <i :class="mobileOpen ? 'bi bi-x' : 'bi bi-list'"></i>
        </button>
    </div>
</nav>

<section class="py-12 text-center">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-2 tracking-tight uppercase">Suara Pelanggan <span class="text-pink-600">&</span> Lokasi</h1>
    <p class="text-gray-500">Kami senang mendengar pengalaman Anda bersama anabul kesayangan.</p>
</section>

<main class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

    <div class="space-y-10">
        <section class="bg-white p-8 rounded-[2rem] shadow-sm border border-pink-50 transition-all hover:shadow-md">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center">
                    <i class="bi bi-chat-heart-fill"></i>
                </div>
                <h2 class="text-xl font-bold">Beri Kami Ulasan</h2>
            </div>

            <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                @csrf
                <textarea name="content" rows="3" 
                    class="w-full border-2 border-gray-50 bg-gray-50 p-4 rounded-2xl focus:bg-white focus:border-pink-500 focus:ring-0 outline-none transition-all" 
                    placeholder="Bagaimana pengalaman belanja Anda?" required></textarea>

                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-1">
                        <select name="rating" class="w-full appearance-none border-2 border-gray-50 bg-gray-50 p-3 px-4 rounded-xl outline-none focus:border-pink-500 transition-all cursor-pointer" required>
                            <option value="">-- Beri Rating --</option>
                            <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                            <option value="4">⭐⭐⭐⭐ Puas</option>
                            <option value="3">⭐⭐⭐ Biasa Saja</option>
                            <option value="2">⭐⭐ Kurang</option>
                            <option value="1">⭐ Buruk</option>
                        </select>
                        <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400"></i>
                    </div>

                    <button class="bg-gray-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-pink-600 shadow-lg hover:shadow-pink-100 transition-all transform active:scale-95">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        </section>

        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Apa Kata Mereka?</h2>
                <span class="text-pink-600 font-bold bg-pink-50 px-4 py-1 rounded-full text-sm">{{ count($reviews) }} Ulasan</span>
            </div>

            <div class="space-y-4 h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                @foreach($reviews as $review)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-pink-200 transition-all group">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-purple-500 text-white flex items-center justify-center font-bold text-sm">
                                {{ substr($review->user->username, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 leading-none mb-1">{{ $review->user->username }}</p>
                                <div class="flex text-yellow-400 text-[10px]">
                                    @for($i=1; $i<=$review->rating; $i++) <i class="bi bi-star-fill mr-0.5"></i> @endfor
                                </div>
                            </div>
                        </div>
                        <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed italic text-sm">"{{ $review->content }}"</p>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <div class="sticky top-28 space-y-6">
        <div class="rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white h-[400px] group relative">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.8821033285627!2d110.4571991!3d-7.0231513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708c37d6e87f2d%3A0xc3f837130f1406e5!2sJl.%20Gemah%20Raya%2C%20Sendangguwo%2C%20Kec.%20Tembalang%2C%20Kota%20Semarang%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1713175200000!5m2!1sid!2sid" 
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" 
                class="group-hover:scale-105 transition duration-[2s]">
            </iframe>
        </div>

        <div class="bg-gradient-to-br from-pink-600 to-purple-700 rounded-[2rem] p-8 text-white shadow-xl shadow-pink-100">
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <i class="bi bi-shop"></i> Kunjungi Store Kami
            </h3>
            <div class="space-y-4">
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <p class="text-sm opacity-90">Jl. Gemah Raya, Sendangguwo, Kec. Tembalang, Kota Semarang, Jawa Tengah</p>
                </div>
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <p class="text-sm opacity-90">+62 882-2667-4147 <br><span class="text-[10px] font-bold uppercase">(Fast Response)</span></p>
                </div>
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                        <i class="bi bi-clock"></i>
                    </div>
                    <p class="text-sm opacity-90">Buka Setiap Hari: 10:00 - 20:00 WIB</p>
                </div>
            </div>
        </div>
    </div>

</main>

<footer class="bg-gray-900 text-white py-16 mt-20">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12">
        <div>
            <h3 class="text-2xl font-black text-pink-500 mb-6 uppercase tracking-tighter">DM Animal Feed Store</h3>
            <p class="text-gray-400 leading-relaxed text-sm">Sahabat terbaik untuk memenuhi segala kebutuhan nutrisi dan perlengkapan hewan kesayangan Anda sejak tahun 2020.</p>
        </div>

        <div>
            <h3 class="font-bold mb-6 text-lg tracking-wide uppercase">Navigasi Cepat</h3>
            <ul class="space-y-3 text-gray-400 text-sm">
                <li><a href="{{ route('shop') }}" class="hover:text-pink-500 transition">Katalog Produk</a></li>
                <li><a href="/about" class="hover:text-pink-600 transition">Tentang Kami</a></li>
                <li><a href="/blog" class="hover:text-pink-600 transition">Blog Terkini</a></li>
                <li><a href="/contact" class="hover:text-pink-500 transition">Lokasi Store</a></li>
            </ul>
        </div> 

        <div>
            <h3 class="font-bold mb-6 text-lg tracking-wide uppercase">Ikuti Kami</h3>
            <div class="flex gap-4">
                <a href="https://wa.me/6288226674147" target="_blank" class="w-12 h-12 bg-gray-800 rounded-2xl flex items-center justify-center hover:bg-[#25D366] hover:scale-110 transition shadow-lg">
                    <i class="bi bi-whatsapp text-xl"></i>
                </a>
                <a href="https://instagram.com/dm_animal_feed_store" target="_blank" class="w-12 h-12 bg-gray-800 rounded-2xl flex items-center justify-center hover:bg-gradient-to-tr hover:from-yellow-500 hover:to-purple-600 hover:scale-110 transition shadow-lg">
                    <i class="bi bi-instagram text-xl"></i>
                </a>
            </div>
            <p class="text-[10px] text-gray-500 mt-4 uppercase font-bold tracking-widest">Dapatkan Promo di Marketplace</p>
        </div>
    </div>
    <div class="max-w-6xl mx-auto px-6 border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-[10px] font-bold uppercase tracking-[0.2em]">
        © 2026 DM Animal Feed Store. Crafted for Pet Lovers.
    </div>
</footer>

</body>
</html>