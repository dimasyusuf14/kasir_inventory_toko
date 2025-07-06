<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kasir - Aplikasi Transaksi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body class="bg-gray-100 text-gray-900">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-6 font-bold text-xl text-blue-600 border-b">Kasir Panel</div>

            <nav class="p-4 space-y-2">

                <a href="{{ route('kasir.dashboard') }}"
                    class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-100
            {{ request()->routeIs('kasir.dashboard') ? 'bg-blue-100 font-semibold' : '' }}">
                    📈 Dashboard Grafik
                </a>

                <a href="{{ route('kasir.transaction') }}"
                    class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-100
            {{ request()->routeIs('kasir.transaction') ? 'bg-blue-100 font-semibold' : '' }}">
                    🛒 Transaksi Baru
                </a>

                <a href="{{ route('kasir.riwayat') }}"
                    class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-100
            {{ request()->routeIs('kasir.riwayat') ? 'bg-blue-100 font-semibold' : '' }}">
                    📊 Riwayat Transaksi
                </a>


            </nav>

            <hr class="my-4">

            <form method="POST" action="{{ route('logout') }}" class="px-4">
                @csrf
                <button class="text-red-600 hover:underline">Logout</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    @stack('scripts')

</body>

</html>
