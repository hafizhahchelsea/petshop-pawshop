<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog PawShop - Inspirasi & Perawatan Hewan</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .bg-pattern {
            background-color: #fff9f9;
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23fbcfe8' fill-opacity='0.4' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='3'/%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body x-data="{ mobileMenu: false, cartCount: 3 }" class="bg-pattern text-gray-800">

    <nav class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 flex items-center justify-between h-20">
            <a href="/" class="flex items-center group">
                <img src="{{ asset('images/logo.jpg') }}" 
                     alt="DM Animal Feed Store Logo" 
                     class="h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
            </a>

            <ul class="hidden lg:flex space-x-10 font-semibold text-gray-500">
                <li><a href="/" class="hover:text-pink-600 transition">Home</a></li>
                <li><a href="/about" class="hover:text-pink-600 transition">About</a></li>
                <li><a href="/shop" class="hover:text-pink-600 transition">Shop</a></li>
                <li><a href="/blog" class="text-pink-600 border-b-2 border-pink-600 pb-1">Blog</a></li>
                <li><a href="/contact" class="hover:text-pink-600 transition">Contact</a></li>
            </ul>

            <div class="hidden lg:flex items-center space-x-6">
                <a href="/cart" class="relative p-2.5 bg-pink-50 rounded-full text-pink-600 hover:bg-pink-100 transition inline-flex items-center justify-center">
                    <i class="bi bi-cart3 text-xl"></i>
                    <template x-if="cartCount > 0">
                        <span x-text="cartCount" 
                              class="absolute -top-1 -right-1 bg-pink-600 text-white text-[10px] font-black h-5 w-5 flex items-center justify-center rounded-full border-2 border-white shadow-sm">
                        </span>
                    </template>
                </a>

                @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="focus:outline-none">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-purple-500 flex items-center justify-center text-white border-2 border-white shadow-md">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         @click.away="open = false" 
                         class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-50">
                        <div class="px-4 py-3 border-b border-gray-50 mb-1">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Signed in as</p>
                            <p class="text-sm font-bold text-gray-800">{{ Auth::user()->username }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 rounded-xl transition font-semibold">Logout</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>

            <button @click="mobileMenu = !mobileMenu" class="lg:hidden text-pink-600 focus:outline-none">
                <i :class="mobileMenu ? 'bi bi-x-lg' : 'bi bi-list-nested'" class="text-3xl"></i>
            </button>
        </div>

        <div x-show="mobileMenu" x-transition class="lg:hidden bg-white border-t border-gray-100 p-6 space-y-4 shadow-xl">
            <a href="/" class="block font-bold text-gray-600 hover:text-pink-600">Home</a>
            <a href="/shop" class="block font-bold text-gray-600 hover:text-pink-600">Shop</a>
            <a href="/blog" class="block font-bold text-pink-600">Blog</a>
            <a href="/contact" class="block text-lg font-semibold text-gray-600">Contact</a>
            <a href="/cart" class="flex items-center justify-between font-bold text-gray-600">
                Keranjang <span class="bg-pink-600 text-white px-2 py-0.5 rounded-full text-xs" x-text="cartCount"></span>
            </a>
        </div>
    </nav>

    <header class="relative overflow-hidden bg-gray-900 py-24 px-6">
        <div class="absolute inset-0 opacity-40">
            <img src="https://images.unsplash.com/photo-1548191265-cc70d3d45ba1?auto=format&fit=crop&w=1600&q=80" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
        
        <div class="relative max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight uppercase">Inspirasi Untuk <span class="text-pink-500">Anabul</span></h1>
            <p class="text-lg md:text-xl text-gray-300 leading-relaxed font-medium">Temukan tips ahli, cerita menggemaskan, dan panduan lengkap untuk memastikan hewan kesayangan Anda hidup sehat dan bahagia.</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-20 px-6">
        <div class="flex items-center gap-4 mb-12">
            <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tighter shrink-0">Artikel <span class="text-pink-600 text-6xl">.</span></h2>
            <div class="h-[2px] bg-pink-100 flex-grow"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <article class="glass-card group rounded-[2.5rem] overflow-hidden hover:shadow-2xl hover:shadow-pink-100 transition-all duration-500 hover:-translate-y-3 flex flex-col"> 
                <div class="relative overflow-hidden h-64">
                    <img src="https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&w=800&q=80"
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="bg-pink-600 text-white px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest">Tips Anjing</span>
                    </div>
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="flex items-center text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-3">
                        <i class="bi bi-calendar3 mr-2"></i> 12 April 2026
                    </div>
                    <h4 class="text-xl font-extrabold text-gray-900 mb-4 group-hover:text-pink-600 transition leading-tight">Rahasia Nutrisi Terbaik untuk Golden Retriever</h4> 
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">Menjaga kesehatan bulu dan sendi anjing Golden membutuhkan diet khusus. Simak daftar makanan super pilihan kami...</p> 
                    <a href="#" class="inline-flex items-center text-pink-600 font-black text-xs uppercase tracking-[0.2em] group/btn">
                        Baca Artikel 
                        <span class="ml-2 w-8 h-8 rounded-full bg-pink-50 flex items-center justify-center group-hover/btn:bg-pink-600 group-hover/btn:text-white transition">
                            <i class="bi bi-arrow-right"></i>
                        </span>
                    </a>
                </div> 
            </article>

            <article class="glass-card group rounded-[2.5rem] overflow-hidden hover:shadow-2xl hover:shadow-pink-100 transition-all duration-500 hover:-translate-y-3 flex flex-col">
                <div class="relative overflow-hidden h-64">
                    <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=800&q=80" 
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="bg-purple-600 text-white px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest">Panduan Kucing</span>
                    </div>
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="flex items-center text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-3">
                        <i class="bi bi-calendar3 mr-2"></i> 08 April 2026
                    </div>
                    <h4 class="text-xl font-extrabold text-gray-900 mb-4 group-hover:text-pink-600 transition leading-tight">Teknik Grooming di Rumah Tanpa Membuat Kucing Stres</h4>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">Memandikan kucing tidak harus menjadi drama. Gunakan metode "Slow Motion" ini agar kucing Anda tetap tenang...</p> 
                    <a href="#" class="inline-flex items-center text-pink-600 font-black text-xs uppercase tracking-[0.2em] group/btn">
                        Baca Artikel 
                        <span class="ml-2 w-8 h-8 rounded-full bg-pink-50 flex items-center justify-center group-hover/btn:bg-pink-600 group-hover/btn:text-white transition">
                            <i class="bi bi-arrow-right"></i>
                        </span>
                    </a>
                </div>
            </article>

            <article class="glass-card group rounded-[2.5rem] overflow-hidden hover:shadow-2xl hover:shadow-pink-100 transition-all duration-500 hover:-translate-y-3 flex flex-col">
                <div class="relative overflow-hidden h-64">
                    <img src="https://images.unsplash.com/photo-1452570053594-1b985d6ea890?auto=format&fit=crop&w=800&q=80"
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="bg-orange-500 text-white px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest">Hobi Burung</span>
                    </div>
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="flex items-center text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-3">
                        <i class="bi bi-calendar3 mr-2"></i> 01 April 2026
                    </div>
                    <h4 class="text-xl font-extrabold text-gray-900 mb-4 group-hover:text-pink-600 transition leading-tight">5 Rahasia Agar Suara Burung Berkicau Lantang & Merdu</h4> 
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">Racikan pakan tradisional dan modern yang telah terbukti membantu burung kicau kesayangan Anda tampil prima di kontes...</p>
                    <a href="#" class="inline-flex items-center text-pink-600 font-black text-xs uppercase tracking-[0.2em] group/btn">
                        Baca Artikel 
                        <span class="ml-2 w-8 h-8 rounded-full bg-pink-50 flex items-center justify-center group-hover/btn:bg-pink-600 group-hover/btn:text-white transition">
                            <i class="bi bi-arrow-right"></i>
                        </span>
                    </a>
                </div>
            </article>
        </div>
    </main>

    <footer class="bg-gray-900 py-16 px-6 overflow-hidden relative">
        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-pink-600/10 rounded-full blur-3xl"></div>
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-10">
            <div>
                <a href="#" class="text-3xl font-black text-white tracking-tighter">DM <span class="text-pink-600">ANIMAL FEED STORE</span></a>
                <p class="text-gray-400 mt-2 max-w-sm">Didedikasikan untuk kesejahteraan anabul di seluruh dunia melalui edukasi dan kasih sayang.</p>
            </div>
            
            <div class="flex space-x-6">
               <a href="https://wa.me/6288226674147" target="_blank" class="w-12 h-12 bg-white/10 text-white rounded-2xl flex items-center justify-center hover:bg-[#25D366] hover:scale-110 transition shadow-lg">
                    <i class="bi bi-whatsapp text-xl"></i>
                </a>
                <a href="https://instagram.com/dm_animal_feed_store" target="_blank" class="w-12 h-12 bg-white/10 text-white rounded-2xl flex items-center justify-center hover:bg-gradient-to-tr hover:from-yellow-500 hover:to-purple-600 hover:scale-110 transition shadow-lg">
                    <i class="bi bi-instagram text-xl"></i>
                </a>
            </div>
        </div>
        <div class="max-w-6xl mx-auto border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-xs font-bold uppercase tracking-widest">
            &copy; 2026 DM ANIMAL FEED STORE. Crafted for Pet Lovers.
        </div>
    </footer>

</body>
</html>