<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Ulasan - Petshop Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans text-gray-900">

<div class="flex">
    <aside id="sidebar"
           class="w-64 bg-white h-screen shadow-md flex flex-col justify-between fixed transform -translate-x-full md:translate-x-0 transition-all duration-300 z-50 border-r border-gray-100">

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
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium transition">
                    Produk
                </a>
                <a href="{{ route('admin.reviews') }}" 
                   class="block px-4 py-3 rounded-lg bg-purple-100 text-purple-700 font-bold transition">
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

    <main class="flex-1 md:ml-64 p-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Manajemen Ulasan</h1>
                <p class="text-gray-500 text-sm">Lihat dan moderasi ulasan dari pelanggan Anda.</p>
            </div>

            <form method="GET" class="flex items-center gap-3 bg-white p-2 rounded-xl shadow-sm border border-gray-200">
                <span class="pl-2 text-xs font-bold text-gray-400 uppercase">Filter:</span>
                <select name="status" onchange="this.form.submit()" class="bg-gray-50 border-none text-sm rounded-lg focus:ring-purple-500 block w-full p-2 text-gray-700 font-medium cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status')=='pending' ? 'selected':'' }}>⏳ Menunggu</option>
                    <option value="accepted" {{ request('status')=='accepted' ? 'selected':'' }}>✅ Diterima</option>
                    <option value="rejected" {{ request('status')=='rejected' ? 'selected':'' }}>❌ Ditolak</option>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            @forelse($reviews as $review)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition duration-300">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-700 font-bold text-lg">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 leading-none mb-1">{{ $review->user->name }}</h3>
                                <div class="flex text-yellow-400 text-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20 shadow-sm"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    @endfor
                                    <span class="ml-2 text-gray-500 font-medium">({{ $review->rating }}.0)</span>
                                </div>
                            </div>
                        </div>

                        @php
                            $statusClasses = [
                                'pending'  => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                                'accepted' => 'bg-green-50 text-green-600 border-green-100',
                                'rejected' => 'bg-red-50 text-red-600 border-red-100',
                            ];
                            $currentClass = $statusClasses[$review->status] ?? 'bg-gray-50 text-gray-600 border-gray-100';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $currentClass }}">
                            {{ $review->status }}
                        </span>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 mb-4">
                        <p class="text-gray-700 text-sm italic leading-relaxed">
                            "{{ $review->content }}"
                        </p>
                    </div>

                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xs text-gray-400 font-medium">
                            Diposting pada {{ $review->created_at->format('d M Y') }}
                        </span>
                        
                        <div class="flex gap-2">
                            @if($review->status !== 'accepted')
                            <form method="POST" action="{{ route('admin.reviews.status', $review->id) }}">
                                @csrf
                                <input type="hidden" name="status" value="accepted">
                                <button class="p-2 px-4 bg-green-500 hover:bg-green-600 text-white text-xs font-bold rounded-lg transition flex items-center gap-1">
                                    Setujui
                                </button>
                            </form>
                            @endif
                            
                            <form method="POST" action="{{ route('admin.reviews.delete', $review->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus ulasan ini secara permanen?')"
                                    class="p-2 px-4 bg-white border border-red-100 text-red-500 hover:bg-red-50 text-xs font-bold rounded-lg transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-white rounded-2xl p-20 border border-dashed border-gray-300 flex flex-col items-center justify-center text-center">
                <div class="bg-gray-100 p-4 rounded-full mb-4 text-3xl">💬</div>
                <h3 class="text-lg font-bold text-gray-800">Tidak ada ulasan ditemukan</h3>
                <p class="text-gray-500">Ulasan dari pelanggan akan muncul di sini.</p>
            </div>
            @endforelse
        </div>

    </main>
</div>

</body>
</html>