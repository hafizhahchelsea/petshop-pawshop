<!DOCTYPE html>
<html>
<head>
    <title>Admin Produk</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">

<!-- MOBILE NAVBAR -->
<div class="md:hidden bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-purple-700">Petshop Admin</h1>
    <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">☰</button>
</div>

<!-- SIDEBAR MOBILE -->
<div id="mobileMenu" class="hidden md:hidden bg-white shadow p-4 space-y-2">
    <a href="{{ route('admin.dashboard') }}" class="block py-2">Dashboard</a>
    <a href="{{ route('admin.menu') }}" class="block py-2 font-bold text-purple-600">Produk</a>
    <a href="#" class="block py-2">Ulasan</a>
    <a href="#" class="block py-2">Pembayaran</a>
    <a href="{{ route('admin.users') }}" class="block py-2">Pengguna</a>

    <form action="{{ route('admin.logout') }}" method="GET" class="pt-4">
        <button class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">Logout</button>
    </form>
</div>

<div class="flex">

    <!-- SIDEBAR DESKTOP -->
    <div class="flex">
    <aside id="sidebar"
           class="w-64 bg-white h-screen shadow-md flex flex-col justify-between fixed transform -translate-x-full md:translate-x-0 transition-all duration-300 z-50">

        <div>
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-purple-700">Petshop Admin</h1>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-4 py-3 rounded-lg bg-purple-100 text-gray-700 font-bold">
                    Dashboard
                </a>
                <a href="{{ route('admin.menu') }}"
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-purple-700 font-medium">
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
            <p class="font-semibold text-purple-700">
                {{ Auth::guard('admin')->user()->name }}
            </p>
            <form action="{{ route('admin.logout') }}" method="GET" class="mt-3">
                <button class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 md:ml-64">

        <h1 class="text-3xl font-bold mb-6">Tambah Produk</h1>

        @if ($errors->any())
            <div class="bg-red-200 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <div class="bg-white p-6 rounded shadow mb-10">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf

                <input type="text" name="nama_produk" placeholder="Nama Produk" class="border p-2 w-full rounded">

                <input type="number" name="harga" placeholder="Harga" class="border p-2 w-full rounded">

                <input type="number" name="stok" placeholder="Stok" class="border p-2 w-full rounded">

                <textarea name="deskripsi" class="border p-2 w-full rounded" placeholder="Deskripsi"></textarea>

                <input type="file" name="gambar" class="border p-2 w-full rounded">

                <div class="flex gap-3">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Tambah Produk
                    </button>

                    <a href="{{ route('admin.menu') }}" class="px-4 py-2 bg-gray-300 rounded">
                        Batal
                    </a>
                </div>

            </form>
        </div>

    </main>

</div>

</body>
</html>
