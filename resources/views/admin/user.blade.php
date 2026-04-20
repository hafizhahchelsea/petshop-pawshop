<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow-lg fixed inset-y-0 left-0 flex flex-col">

    <!-- LOGO -->
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-purple-700">Petshop Admin</h1>
        </div>

        <!-- MENU -->
        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('admin.dashboard') }}" 
               class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium">
                Dashboard
            </a>

            <a href="#" 
               class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium">
                Produk
            </a>

            <a href="#" 
               class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium">
                Ulasan
            </a>

            <a href="#" 
               class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium">
                Pembayaran
            </a>

            <a href="{{ route('admin.users') }}"
               class="block px-4 py-3 rounded-lg hover:bg-purple-100 text-gray-700 font-medium">
                Pengguna
            </a>

        </nav>

        <!-- ADMIN ACCOUNT (FIXED BOTTOM) -->
        <div class="p-4 bg-purple-50 border-t">
            <p class="text-sm text-gray-600">Logged in as:</p>

            <p class="font-semibold text-purple-700">
                {{ Auth::guard('admin')->user()->name }}
            </p>

            <form action="{{ route('admin.logout') }}" method="GET" class="mt-3">
                <button class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 ml-64 w-full p-10">

        <h1 class="text-3xl font-bold mb-6 text-gray-700">Daftar Pengguna</h1>

        <!-- Success Notification -->
        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        <!-- TABLE -->
        <div class="bg-white shadow rounded-lg overflow-hidden">

            <table class="min-w-full text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Tanggal Bergabung</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b">

                        <td class="px-6 py-4 font-semibold">{{ $user->username }}</td>

                        <td class="px-6 py-4">{{ $user->email }}</td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                       

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </main>
</div>

</body>
</html>
