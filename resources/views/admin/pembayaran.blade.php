<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Admin - Petshop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        
        <aside id="sidebar"
               class="w-64 bg-white h-screen shadow-sm flex flex-col justify-between fixed border-r border-gray-100 z-50">
            <div>
                <div class="p-6 border-b">
                    <h1 class="text-2xl font-bold text-purple-700">Petshop Admin</h1>
                </div>

                <nav class="flex-1 p-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl hover:bg-purple-50 text-gray-600 font-medium transition">Dashboard</a>
                    <a href="{{ route('admin.menu') }}" class="block px-4 py-3 rounded-xl hover:bg-purple-50 text-gray-600 font-medium transition">Produk</a>
                    <a href="{{ route('admin.reviews') }}" class="block px-4 py-3 rounded-xl hover:bg-purple-50 text-gray-600 font-medium transition">Ulasan</a>
                    <a href="{{ route('admin.payments') }}" class="block px-4 py-3 rounded-xl bg-purple-100 text-purple-700 font-bold transition">Pembayaran</a>
                    <a href="{{ route('admin.users') }}" class="block px-4 py-3 rounded-xl hover:bg-purple-50 text-gray-600 font-medium transition">Pengguna</a>
                </nav>
            </div>

            <div class="p-4 bg-gray-50 border-t">
                <div class="flex items-center gap-3 px-2 mb-4">
                    <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 leading-none">Admin</p>
                        <p class="text-sm font-bold text-gray-800">{{ Auth::guard('admin')->user()->name }}</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="GET">
                    <button class="w-full bg-red-50 text-red-600 py-2.5 rounded-xl font-bold hover:bg-red-100 transition text-sm">
                        <i class="bi bi-box-arrow-right mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 ml-64 p-10">
            
            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-10 gap-6">
                <div>
                    <h2 class="text-3xl font-black text-gray-800 tracking-tight">Data Pembayaran</h2>
                    <p class="text-gray-500 mt-1">Lakukan verifikasi transaksi masuk secara real-time.</p>
                </div>
                
                <div class="flex gap-4">
                    <div class="bg-white p-4 px-6 rounded-2xl shadow-sm border border-gray-100">
                        <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Total Transaksi</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $payments->count() }}</p>
                    </div>
                    <div class="bg-purple-600 p-4 px-6 rounded-2xl shadow-lg shadow-purple-100">
                        <p class="text-[10px] font-black uppercase text-purple-200 tracking-widest mb-1">Total Estimasi</p>
                        <p class="text-2xl font-bold text-white">Rp {{ number_format($payments->sum('total_price'), 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="py-5 px-8 text-[11px] font-black uppercase text-gray-400 tracking-widest">Pelanggan</th>
                            <th class="py-5 px-6 text-[11px] font-black uppercase text-gray-400 tracking-widest text-center">Metode</th>
                            <th class="py-5 px-6 text-[11px] font-black uppercase text-gray-400 tracking-widest text-right">Nominal</th>
                            <th class="py-5 px-6 text-[11px] font-black uppercase text-gray-400 tracking-widest text-center">Bukti Bayar</th>
                            <th class="py-5 px-8 text-[11px] font-black uppercase text-gray-400 tracking-widest text-right">Waktu Transaksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($payments as $payment)
                        <tr class="hover:bg-gray-50/80 transition group">
                            <td class="py-5 px-8">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 group-hover:bg-purple-100 group-hover:text-purple-600 transition">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 leading-tight">{{ $payment->name }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5 tracking-tight">{{ $payment->phone }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="py-5 px-6 text-center">
                                @php
                                    $isQris = strtolower($payment->payment_method) == 'qris';
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-full text-[10px] font-black border {{ $isQris ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-green-50 text-green-600 border-green-100' }}">
                                    {{ strtoupper($payment->payment_method) }}
                                </span>
                            </td>

                            <td class="py-5 px-6 text-right">
                                <p class="text-sm font-black text-gray-900">Rp {{ number_format($payment->total_price, 0, ',', '.') }}</p>
                            </td>

                            <td class="py-5 px-6">
                                <div class="flex justify-center">
                                    @if($payment->bukti_pembayaran)
                                        <a href="{{ asset('storage/' . $payment->bukti_pembayaran) }}" target="_blank" class="relative block w-12 h-12">
                                            <img src="{{ asset('storage/' . $payment->bukti_pembayaran) }}" 
                                                 class="w-full h-full object-cover rounded-xl shadow-sm ring-2 ring-transparent group-hover:ring-purple-400 transition transform group-hover:scale-110">
                                            <div class="absolute inset-0 bg-purple-900/40 rounded-xl opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                                                <i class="bi bi-zoom-in text-white"></i>
                                            </div>
                                        </a>
                                    @else
                                        <div class="flex flex-col items-center opacity-40">
                                            <i class="bi bi-cash-stack text-lg text-gray-400"></i>
                                            <span class="text-[9px] font-bold uppercase tracking-tighter">Tunai/COD</span>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td class="py-5 px-8 text-right">
                                <p class="text-xs font-bold text-gray-700">{{ $payment->created_at->format('d M, Y') }}</p>
                                <p class="text-[10px] text-gray-400 font-medium">{{ $payment->created_at->format('H:i') }} WIB</p>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-32 text-center">
                                <div class="flex flex-col items-center opacity-20">
                                    <i class="bi bi-wallet2 text-6xl mb-4"></i>
                                    <p class="font-bold tracking-widest uppercase">Belum ada transaksi hari ini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>