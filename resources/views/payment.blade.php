<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Pet Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50 min-h-screen pb-10">

    <div class="bg-white shadow-sm p-4 mb-6">
        <div class="max-w-3xl mx-auto flex items-center">
            <a href="{{ route('cart.index') }}" class="text-pink-600 mr-4 text-xl"><i class="bi bi-arrow-left"></i></a>
            <h1 class="text-xl font-bold text-gray-800">Konfirmasi & Pembayaran</h1>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4" x-data="{ method: '' }">
        <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="bg-white p-6 rounded-2xl shadow-sm mb-6 border border-pink-100">
                <h2 class="text-lg font-semibold text-purple-700 mb-4 flex items-center">
                    <i class="bi bi-geo-alt-fill mr-2"></i> Informasi Pengiriman
                </h2>
                <div class="space-y-3">
                    <div class="flex flex-col">
                        <span class="text-gray-500 text-sm">Nama Lengkap</span>
                        <input type="text" name="name" value="{{ $nama }}" readonly class="font-medium bg-transparent outline-none">
                    </div>

                    <div class="flex flex-col">
                        <span class="text-gray-500 text-sm">Nomor Telepon</span>
                        <input type="text" name="phone" value="{{ $phone }}" readonly class="font-medium bg-transparent outline-none">
                    </div>

                    <div class="flex flex-col">
                        <span class="text-gray-500 text-sm">Alamat Lengkap</span>
                        <textarea readonly class="font-medium bg-transparent outline-none resize-none">{{ $alamat }}</textarea>
                        <input type="hidden" name="address" value="{{ $alamat }}">
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm mb-6 border border-pink-100">
                <h2 class="text-lg font-semibold text-purple-700 mb-4">Pilih Metode Pembayaran</h2>
                
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative border-2 rounded-xl p-4 cursor-pointer transition" 
                        :class="method === 'cod' ? 'border-pink-500 bg-pink-50' : 'border-gray-200'">
                        <input type="radio" name="payment_method" value="cod" x-model="method" class="absolute opacity-0" required>
                        <div class="text-center">
                            <i class="bi bi-cash-stack text-2xl" :class="method === 'cod' ? 'text-pink-600' : 'text-gray-400'"></i>
                            <p class="font-bold block mt-1" :class="method === 'cod' ? 'text-pink-700' : 'text-gray-600'">COD</p>
                        </div>
                    </label>

                    <label class="relative border-2 rounded-xl p-4 cursor-pointer transition" 
                        :class="method === 'qris' ? 'border-pink-500 bg-pink-50' : 'border-gray-200'">
                        <input type="radio" name="payment_method" value="qris" x-model="method" class="absolute opacity-0">
                        <div class="text-center">
                            <i class="bi bi-qr-code-scan text-2xl" :class="method === 'qris' ? 'text-pink-600' : 'text-gray-400'"></i>
                            <p class="font-bold block mt-1" :class="method === 'qris' ? 'text-pink-700' : 'text-gray-600'">QRIS</p>
                        </div>
                    </label>
                </div>

                <div x-show="method === 'qris'" x-transition class="mt-6 p-4 border-t-2 border-dashed border-pink-200">
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-3">Silahkan scan QR di bawah ini untuk membayar:</p>
                        <img src="{{ asset('images/qris.jpeg') }}" 
                             alt="QRIS Code" class="mx-auto w-48 h-48 border-4 border-white shadow-md rounded-lg">
                        <p class="mt-4 font-bold text-lg text-gray-800">Pet Shop Indonesia</p>
                    </div>

                    <div class="mt-6">
                        <label class="block text-gray-700 font-medium mb-2">Upload Bukti Pembayaran</label>
                        <input type="file" name="bukti_pembayaran" 
                               :required="method === 'qris'"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 border p-2 rounded-lg">
                    </div>
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white text-lg font-bold py-4 rounded-2xl shadow-lg hover:opacity-90 transition transform active:scale-95">
                PESAN SEKARANG
            </button>
        </form>
    </div>

</body>
</html>