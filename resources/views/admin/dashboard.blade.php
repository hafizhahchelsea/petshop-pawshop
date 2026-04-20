<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Petshop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

<div class="flex">
    <aside id="sidebar"
           class="w-64 bg-white h-screen shadow-md flex flex-col justify-between fixed transform -translate-x-full md:translate-x-0 transition-all duration-300 z-50">

        <div>
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-purple-700">Petshop Admin</h1>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-4 py-3 rounded-lg hover: bg-purple-100 text-purple-700 font-bold">
                    Dashboard
                </a>
                <a href="{{ route('admin.menu') }}"
                   class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium">
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

    <main class="flex-1 md:ml-64 w-full p-6">
        <h2 class="text-3xl font-bold text-gray-700 mb-6">Dashboard Overview</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500">
                <h3 class="text-gray-500 text-sm font-medium uppercase">Total Produk</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts ?? 0 }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                <h3 class="text-gray-500 text-sm font-medium uppercase">Total Pesanan</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $orders->count() }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-pink-500">
                <h3 class="text-gray-500 text-sm font-medium uppercase">Total Pengguna</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers ?? 0 }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b flex justify-between items-center bg-white">
                <h3 class="text-xl font-bold text-gray-700">Daftar Pesanan Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-xs uppercase font-semibold">
                            <th class="py-4 px-6 border-b">Nama Pelanggan</th>
                            <th class="py-4 px-6 border-b">Detail Pesanan</th>
                            <th class="py-4 px-6 border-b">Tanggal</th>
                            <th class="py-4 px-6 border-b">Alamat</th>
                            <th class="py-4 px-6 border-b">Status</th>
                            <th class="py-4 px-6 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($orders as $order)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-4 px-6">
                                <p class="font-bold text-gray-800">{{ $order->name }}</p>
                                
                                @php
                                    // 1. Bersihkan nomor telepon
                                    $phoneClean = preg_replace('/[^0-9]/', '', $order->phone);
                                    if (strpos($phoneClean, '0') === 0) {
                                        $phoneClean = '62' . substr($phoneClean, 1);
                                    }

                                    // 2. Buat Pesan Otomatis (Gunakan URL Encode agar spasi & baris baru terbaca)
                                    $message = "Halo " . $order->name . ",\n\nKami dari *Petshop Admin* ingin mengonfirmasi pesanan Anda:\n\n" .
                                               "*Detail Barang:* " . $order->items . "\n" .
                                               "*Total Harga:* Rp " . number_format($order->total_price ?? 0, 0, ',', '.') . "\n" .
                                               "*Alamat Kirim:* " . $order->address . "\n\n" .
                                               "Status pesanan saat ini: *" . strtoupper($order->status) . "*.\n" .
                                               "Terima kasih telah berbelanja!";
                                    
                                    $waUrl = "https://wa.me/" . $phoneClean . "?text=" . urlencode($message);
                                @endphp

                                <a href="{{ $waUrl }}" 
                                   target="_blank" 
                                   title="Kirim Detail Pesanan via WhatsApp"
                                   class="text-xs text-purple-600 hover:text-purple-800 font-medium flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.483 8.411-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.308 1.658zm6.25-3.328c1.547.917 3.36 1.4 5.204 1.401h.005c5.454 0 9.894-4.44 9.896-9.895.001-2.644-1.026-5.128-2.896-6.998s-4.355-2.897-6.999-2.897c-5.456 0-9.897 4.441-9.899 9.897-.001 1.922.501 3.791 1.451 5.403l-.966 3.535 3.608-.946zm11.367-7.612c-.301-.15-.1.301-.89-.093l-1.474-.727c-.273-.135-.471-.203-.672.1s-.776.974-.951 1.174-.35.226-.651.075c-.301-.15-1.272-.469-2.423-1.495-.895-.798-1.5-1.783-1.675-2.083s-.019-.463.132-.612c.135-.134.301-.351.451-.526.15-.175.201-.301.301-.501s.05-.376-.025-.526c-.075-.15-.672-1.62-.921-2.22-.242-.585-.487-.506-.672-.516s-.376-.012-.577-.012-.526.075-.801.376c-.275.301-1.051 1.026-1.051 2.503s1.076 2.903 1.226 3.103c.15.2 2.118 3.235 5.129 4.537.716.31 1.275.496 1.71.634.72.229 1.375.196 1.892.119.576-.085 1.774-.726 2.025-1.427.25-.7.25-1.301.175-1.427-.075-.126-.275-.201-.576-.351z"/>
                                    </svg>
                                    {{ $order->phone }}
                                </a>
                            </td>
                            <td class="py-4 px-6 text-sm">
                                <span class="bg-purple-50 text-purple-700 px-2 py-1 rounded border border-purple-100">
                                    {{ $order->items }}
                                </span>
                                <p class="text-xs font-bold text-gray-600 mt-1">Total: Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}</p>
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-500">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-sm line-clamp-2 w-48">{{ $order->address }}</p>
                            </td>
                            <td class="py-4 px-6">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                        'proses'  => 'bg-blue-100 text-blue-700 border-blue-200',
                                        'selesai' => 'bg-green-100 text-green-700 border-green-200',
                                    ];
                                    $class = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $class }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex items-center gap-2 justify-center">
                                    @csrf
                                    <select name="status" class="text-xs border rounded p-1.5 bg-gray-50 outline-none focus:ring-1 focus:ring-purple-500">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    <button type="submit" class="bg-purple-600 text-white px-3 py-1.5 rounded-md text-xs font-semibold hover:bg-purple-700 transition">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-500 italic">Belum ada pesanan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

</body>
</html>