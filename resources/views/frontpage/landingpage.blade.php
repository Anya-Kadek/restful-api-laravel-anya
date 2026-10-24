
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anya Pastry and Dessert</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-50 font-sans antialiased">
    <div class="min-h-screen">

        <!-- Navbar -->
        <nav class="bg-pink-500 border-b border-pink-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
                <div class="font-bold text-xl text-white">
                    Anya Pastry and Dessert 🍰
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ url('/dashboard') }}"
                       class="text-white hover:text-pink-200 font-medium transition">
                        Dashboard
                    </a>

                    <a href="{{ route('cart.view') }}"
                       class="text-white hover:text-pink-200 font-medium transition">
                        Keranjang
                    </a>

                    <a href="{{ route('checkout.view') }}"
                       class="text-white hover:text-pink-200 font-medium transition">
                        Checkout
                    </a>
                </div>
            </div>
        </nav>

        <!-- Konten Utama -->
        <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <div class="bg-pink-100 overflow-hidden shadow-xl rounded-2xl p-8 border border-pink-100">

                <!-- Judul -->
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-slate-800 mb-3">
                        Selamat Datang di Anya Pastry & Dessert
                    </h1>

                    <p class="text-lg text-slate-600 mb-8">
                        Pilihan menu kue, roti, dan dessert manis buatan tangan setiap hari.
                    </p>
                </div>

                <!-- Notifikasi Berhasil -->
                @if(session('success'))
                    <div class="mb-6 bg-white border border-pink-300 text-pink-700 px-4 py-3 rounded-lg text-center text-sm shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Notifikasi Error -->
                @if(session('error'))
                    <div class="mb-6 bg-white border border-red-300 text-red-700 px-4 py-3 rounded-lg text-center text-sm shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Pesan Validasi -->
                @if($errors->any())
                    <div class="mb-6 bg-white border border-red-300 text-red-700 px-4 py-3 rounded-lg text-sm shadow-sm">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Daftar Produk -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">

                    @forelse($products as $item)

                        <div class="bg-white border border-pink-200 rounded-xl p-4 shadow-sm hover:shadow-md transition flex flex-col justify-between">

                            <div>
                                <!-- Foto Produk -->
                                <div class="h-48 bg-pink-100 rounded-lg mb-4 flex items-center justify-center overflow-hidden">
                                    @if($item->img)
                                        <img
                                            src="{{ asset($item->img) }}"
                                            alt="{{ $item->name }}"
                                            class="w-full h-full object-cover"
                                        >
                                    @else
                                        <span class="text-xs text-pink-500">
                                            Foto belum tersedia
                                        </span>
                                    @endif
                                </div>

                                <!-- Informasi Produk -->
                                <span class="text-xs font-bold text-pink-500 uppercase">
                                    Kue & Dessert
                                </span>

                                <h3 class="font-bold text-lg text-slate-800 mt-1">
                                    {{ $item->name }}
                                </h3>

                                <p class="text-pink-600 font-bold mt-1">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>

                                <p class="text-sm text-slate-500 mt-2">
                                    {{ $item->description }}
                                </p>

                                <p class="text-xs text-slate-500 mt-2">
                                    Stok:
                                    <span class="font-semibold">
                                        {{ $item->stock }}
                                    </span>
                                </p>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="mt-4 space-y-2">

                                <!-- Lihat Detail -->
                                <a
                                    href="{{ route('product.show', ['id' => $item->product_id]) }}"
                                    class="block text-center w-full bg-pink-100 text-pink-700 py-2 rounded-lg font-medium hover:bg-pink-200 transition text-sm"
                                >
                                    Lihat Detail
                                </a>

                                <!-- Tambah ke Keranjang -->
                                @if($item->stock > 0)

                                    <form
                                        action="{{ route('cart.add', ['id' => $item->product_id]) }}"
                                        method="POST"
                                    >
                                        @csrf

                                        <input
                                            type="hidden"
                                            name="quantity"
                                            value="1"
                                        >

                                        <button
                                            type="submit"
                                            class="w-full bg-pink-600 text-white py-2 rounded-lg font-medium hover:bg-pink-700 transition text-sm shadow-sm"
                                        >
                                            + Tambah ke Keranjang
                                        </button>
                                    </form>

                                @else

                                    <button
                                        type="button"
                                        disabled
                                        class="w-full bg-gray-400 text-white py-2 rounded-lg font-medium text-sm cursor-not-allowed"
                                    >
                                        Stok Habis
                                    </button>

                                @endif
                            </div>
                        </div>

                    @empty

                        <div class="col-span-full text-center py-10 text-slate-500">
                            Belum ada produk yang tersedia.
                        </div>

                    @endforelse

                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="text-center py-6 text-sm text-slate-500">
            &copy; 2026 Anya Pastry and Dessert. All rights reserved.
        </footer>

    </div>
</body>
</html>
