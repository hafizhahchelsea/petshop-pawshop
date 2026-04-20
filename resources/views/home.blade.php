<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawShop - Solusi Sahabat Berbulu</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-gradient {
            background: radial-gradient(circle at top right, rgba(219, 39, 119, 0.05), transparent),
                        radial-gradient(circle at bottom left, rgba(147, 51, 234, 0.05), transparent);
        }
    </style>
</head>
<body class="bg-white text-gray-800 hero-gradient min-h-screen">

<nav x-data="{ mobileOpen: false }" class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
    <nav x-data="{ mobileOpen: false }" class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
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

        <div class="hidden lg:flex items-center space-x-5">
            <a href="#" class="text-gray-600 hover:text-pink-600 text-xl transition relative">
                <i class="bi bi-cart3"></i>
                <span class="absolute -top-2 -right-2 bg-pink-600 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">0</span>
            </a>

            @auth
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center focus:outline-none group">
                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center border-2 border-transparent group-hover:border-pink-600 transition">
                        <i class="bi bi-person text-pink-600 text-xl"></i>
                    </div>
                </button>
                <div x-show="open" x-transition @click.away="open = false" 
                     class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                    <div class="px-5 py-4 bg-gray-50">
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->username }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="p-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-xl transition">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endauth

            @guest
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="font-bold text-gray-600 hover:text-pink-600 transition">Login</a>
                <a href="{{ route('register') }}" class="bg-pink-600 text-white px-6 py-2.5 rounded-full font-bold shadow-lg shadow-pink-200 hover:bg-pink-700 transition">Join Us</a>
            </div>
            @endguest
        </div>

        <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-gray-700 text-3xl">
            <i :class="mobileOpen ? 'bi bi-x' : 'bi bi-list'"></i>
        </button>
    </div>

    <div x-show="mobileOpen" x-transition class="lg:hidden bg-white border-t px-6 py-8 space-y-4">
        <a href="/" class="block text-lg font-bold text-pink-600">Home</a>
        <a href="/about" class="block text-lg font-semibold text-gray-600">About Us</a>
        <a href="/shop" class="block text-lg font-semibold text-gray-600">Shop</a>
        <a href="/blog" class="block text-lg font-semibold text-gray-600">Blog</a>
        <hr class="border-gray-100">
        @auth
            <p class="text-sm font-bold text-gray-800">{{ Auth::user()->username }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-50 text-red-600 py-3 rounded-xl font-bold mt-2">Logout</button>
            </form>
        @else
            <div class="grid grid-cols-2 gap-4">
                <a href="/login" class="text-center py-3 font-bold text-gray-600">Login</a>
                <a href="/register" class="text-center py-3 bg-pink-600 text-white rounded-xl font-bold">Register</a>
            </div>
        @endauth
    </div>
</nav>

<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col lg:flex-row items-center gap-16">
    <div class="lg:w-1/2 order-2 lg:order-1 text-center lg:text-left">
        <span class="inline-block px-4 py-2 bg-pink-50 text-pink-600 rounded-full text-sm font-bold mb-6 tracking-wide uppercase">
            🐾 We love your pets too
        </span>
        <h1 class="text-5xl md:text-7xl font-extrabold leading-[1.1] mb-8 text-gray-900">
            Kebahagiaan untuk <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600">Sahabat Berbulu</span> Anda
        </h1>
        <p class="text-lg text-gray-500 mb-10 leading-relaxed max-w-lg mx-auto lg:mx-0">
            Temukan kurasi produk premium untuk kenyamanan hewan kesayangan Anda. Mulai dari nutrisi terbaik hingga perlengkapan yang menggemaskan.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
            <a href="{{ route('shop') }}" class="px-10 py-4 bg-pink-600 text-white font-bold rounded-2xl shadow-xl shadow-pink-200 hover:bg-pink-700 hover:-translate-y-1 transition duration-300">
                Belanja Sekarang
            </a>
            <a href="/about" class="px-10 py-4 bg-white text-gray-700 font-bold rounded-2xl border border-gray-200 hover:bg-gray-50 transition duration-300">
                Pelajari Lebih Lanjut
            </a>
        </div>

        <div class="grid grid-cols-3 gap-8 mt-16 border-t border-gray-100 pt-10">
            <div>
                <p class="text-2xl font-extrabold text-gray-900">10k+</p>
                <p class="text-gray-400 text-sm font-medium">Produk</p>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">50k+</p>
                <p class="text-gray-400 text-sm font-medium">Pelanggan</p>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">4.9/5</p>
                <p class="text-gray-400 text-sm font-medium">Rating</p>
            </div>
        </div>
    </div>

    <div class="lg:w-1/2 order-1 lg:order-2">
        <div class="relative group">
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse delay-700"></div>
            
            <div class="relative bg-gradient-to-tr from-pink-100 to-purple-100 p-4 rounded-[3rem] overflow-hidden shadow-2xl">
                <img src="https://images.unsplash.com/photo-1558788353-f76d92427f16"
                     alt="Happy Golden Retriever"
                     class="rounded-[2.5rem] w-full object-cover transform transition duration-500 group-hover:scale-105">
                
                <div class="absolute bottom-8 left-8 right-8 bg-white/90 backdrop-blur-md p-5 rounded-2xl shadow-xl flex items-center gap-4 border border-white/50">
                    <div class="w-12 h-12 bg-pink-600 rounded-full flex items-center justify-center text-white">
                        <i class="bi bi-shield-check text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Kualitas Terjamin</p>
                        <p class="text-xs text-gray-500">Produk telah melalui kurasi ketat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#DB2777',
        customClass: {
            popup: 'rounded-3xl',
            confirmButton: 'rounded-xl px-10 py-3 font-bold'
        }
    });
</script>
@endif

</body>
</html>