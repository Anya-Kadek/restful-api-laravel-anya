<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Anya Pastry')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-50">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-pink-800 text-white p-6 shrink-0">
            <h1 class="text-xl font-bold mb-8">
                Anya Pastry & Dessert
            </h1>

            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block">
                    Dashboard
                </a>

                <a href="{{ route('admin.products.index') }}" class="block">
                    Kelola Produk
                </a>

                <a href="{{ route('admin.orders.index') }}" class="block">
                    Daftar Pesanan
                </a>
            </nav>
        </aside>

        <!-- KONTEN HALAMAN -->
        <main class="flex-1 min-w-0 p-8 bg-white">
            <h2 class="text-2xl font-bold mb-6">
                @yield('page-heading', 'Halaman Admin')
            </h2>

            <div class="text-gray-800">
                @yield('content')
            </div>
        </main>

    </div>

</body>
</html>