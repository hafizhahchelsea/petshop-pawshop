<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang PawShop - Dedikasi untuk Anabul</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-pattern {
            background-color: #db2777;
            background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-white text-gray-800">

<nav x-data="{ mobileOpen: false }" class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
    <nav x-data="{ mobileOpen: false }" class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-6 flex items-center justify-between h-20">
        <a href="/" class="flex items-center group">
            <img src="{{ asset('images/logo.jpg') }}" 
                 alt="DM Animal Feed Store Logo" 
                 class="h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
        </a>

        <ul class="hidden lg:flex space-x-10 font-semibold text-gray-500">
            <li><a href="/" class="hover:text-pink-600 transition">Home</a></li>
            <li><a href="/about" class="text-pink-600 border-b-2 border-pink-600 pb-1">About Us</a></li>
            <li><a href="/shop" class="hover:text-pink-600 transition">Shop</a></li>
            <li><a href="/blog" class="hover:text-pink-600 transition">Blog</a></li>
            <li><a href="/contact" class="hover:text-pink-600 transition">Contact Us</a></li>
        </ul>

        <div class="hidden lg:flex items-center space-x-5">
            <a href="#" class="text-gray-600 hover:text-pink-600 text-xl transition"><i class="bi bi-cart3"></i></a>

            @auth
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center focus:outline-none">
                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center border-2 border-transparent hover:border-pink-600 transition">
                        <i class="bi bi-person text-pink-600 text-xl"></i>
                    </div>
                </button>
                <div x-show="open" x-transition @click.away="open = false" 
                     class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                    <div class="px-5 py-4 border-b">
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->username }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="p-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 rounded-xl transition">
                                Logout
                            </button>
                        </form>
                    </div>
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

    <div x-show="mobileOpen" x-transition class="lg:hidden bg-white border-t px-6 py-8 space-y-4 shadow-xl">
        <a href="/" class="block text-lg font-semibold text-gray-600">Home</a>
        <a href="/about" class="block text-lg font-bold text-pink-600">About Us</a>
        <a href="/shop" class="block text-lg font-semibold text-gray-600">Shop</a>
        <a href="/contact" class="block text-lg font-semibold text-gray-600">contact</a>
        <hr>
        <div class="flex gap-4 pt-2">
            <a href="/login" class="flex-1 text-center py-3 bg-gray-100 rounded-xl font-bold">Login</a>
            <a href="/register" class="flex-1 text-center py-3 bg-pink-600 text-white rounded-xl font-bold">Register</a>
        </div>
    </div>
</nav>

<header class="hero-pattern text-white py-24 px-6 text-center">
    <div class="max-w-4xl mx-auto">
        <span class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold uppercase tracking-widest mb-6">Established 2020</span>
        <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">Mengenal Lebih Dekat <br> <span class="underline decoration-pink-300">PawShop</span></h1>
        <p class="text-lg md:text-xl text-pink-50 opacity-90 leading-relaxed max-w-2xl mx-auto">
            Kami bukan sekadar toko; kami adalah partner Anda dalam memastikan setiap momen dengan hewan kesayangan penuh kebahagiaan.
        </p>
    </div>
</header>

<section class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-16 items-center">
    <div class="order-2 md:order-1">
        <div class="inline-block p-3 bg-pink-50 rounded-2xl mb-6">
            <i class="bi bi-book text-2xl text-pink-600"></i>
        </div>
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">Perjalanan Kecil yang Menjadi <span class="text-pink-600">Keluarga Besar</span></h2>
        <div class="space-y-5 text-gray-600 text-lg leading-relaxed">
            <p>
                PawShop lahir dari sebuah mimpi sederhana di garasi kecil pada tahun 2020. Dimulai dari kesulitan kami mencari pakan berkualitas untuk peliharaan pribadi, kami memutuskan untuk membangun solusi bagi para pecinta hewan lainnya.
            </p>
            <p>
                Kini, kami bangga telah menjadi rumah bagi lebih dari <strong>50,000 pemilik hewan</strong> di seluruh Indonesia. Komitmen kami tetap sama: memastikan kualitas produk yang kami jual sama baiknya dengan apa yang kami berikan untuk hewan peliharaan kami sendiri.
            </p>
        </div>
    </div>

    <div class="order-1 md:order-2 flex justify-center relative">
        <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-purple-100 rounded-full mix-blend-multiply filter blur-2xl opacity-70"></div>
        <div class="relative overflow-hidden rounded-[2.5rem] shadow-2xl rotate-3 hover:rotate-0 transition duration-500">
            <img src="https://images.unsplash.com/photo-1592194996308-7b43878e84a6"
                 alt="Cats cuddling"
                 class="w-full max-w-sm object-cover aspect-[4/5]">
        </div>
    </div>
</section>

<section class="bg-gray-50 py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Nilai-Nilai Inti Kami</h2>
            <div class="w-20 h-1.5 bg-pink-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <div class="group bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 text-center">
                <div class="w-16 h-16 mx-auto flex items-center justify-center rounded-2xl bg-pink-50 text-pink-600 mb-6 group-hover:bg-pink-600 group-hover:text-white transition-colors duration-300">
                    <i class="bi bi-heart-fill text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl text-gray-800 mb-3">Cinta Hewan</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Setiap anabul berhak mendapatkan nutrisi dan kasih sayang yang tulus.</p>
            </div>

            <div class="group bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 text-center">
                <div class="w-16 h-16 mx-auto flex items-center justify-center rounded-2xl bg-purple-50 text-purple-600 mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                    <i class="bi bi-shield-check text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl text-gray-800 mb-3">Kualitas Tinggi</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Kami hanya mengurasi produk yang aman dan teruji klinis untuk kesehatan.</p>
            </div>

            <div class="group bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 text-center">
                <div class="w-16 h-16 mx-auto flex items-center justify-center rounded-2xl bg-pink-50 text-pink-600 mb-6 group-hover:bg-pink-600 group-hover:text-white transition-colors duration-300">
                    <i class="bi bi-people-fill text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl text-gray-800 mb-3">Transparansi</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Kepercayaan Anda adalah prioritas. Kami jujur dalam setiap layanan.</p>
            </div>

            <div class="group bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 text-center">
                <div class="w-16 h-16 mx-auto flex items-center justify-center rounded-2xl bg-purple-50 text-purple-600 mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                    <i class="bi bi-star-fill text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl text-gray-800 mb-3">Inovasi</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Terus berkembang untuk memberikan kemudahan belanja kebutuhan hewan.</p>
            </div>

        </div>
    </div>
</section>

<footer class="bg-gray-900 text-white py-12 px-6">
    <div class="max-w-7xl mx-auto text-center">
        <p class="text-gray-500 text-sm">&copy; 2026 DM Animal Feed Store. All rights reserved.</p>
    </div>
</footer>

</body>
</html>