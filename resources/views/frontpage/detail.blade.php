
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Produk - Anya Pastry and Dessert</title>
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

        <!-- Konten Detail Produk -->
        <main class="max-w-4xl mx-auto py-10 px-4">
            <div class="bg-white shadow-xl rounded-2xl p-8 border border-pink-100">

                <a href="{{ url('/dashboard') }}"
                   class="text-pink-600 hover:underline text-sm font-medium mb-4 inline-block">
                    &larr; Kembali ke Dashboard
                </a>

                @if(isset($product))

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-4">

                        <!-- Foto Produk -->
                        <div class="h-80 bg-pink-100 rounded-xl overflow-hidden flex items-center justify-center">
                            @if($product->img)
                                <img
                                    src="{{ asset($product->img) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <span class="text-pink-500">
                                    Foto produk belum tersedia
                                </span>
                            @endif
                        </div>

                        <!-- Informasi Produk -->
                        <div>
                            <h1 class="text-3xl font-extrabold text-slate-800 mb-2">
                                {{ $product->name }}
                            </h1>

                            <p class="text-2xl font-bold text-pink-600 mb-4">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <p class="text-slate-600 mb-4">
                                {{ $product->description }}
                            </p>

                            <p class="text-sm text-slate-500 mb-6">
                                Stok Tersedia:
                                <span class="font-semibold text-slate-700">
                                    {{ $product->stock }}
                                </span>
                            </p>

                            <!-- Form Tambah ke Keranjang -->
                            @if($product->stock > 0)

                                <form
                                    action="{{ route('cart.add', ['id' => $product->product_id]) }}"
                                    method="POST"
                                    class="space-y-4"
                                >
                                    @csrf

                                    <div>
                                        <label
                                            for="quantity"
                                            class="block text-sm font-medium text-slate-700 mb-1"
                                        >
                                            Jumlah:
                                        </label>

                                        <input
                                            type="number"
                                            name="quantity"
                                            id="quantity"
                                            value="1"
                                            min="1"
                                            max="{{ $product->stock }}"
                                            required
                                            class="w-24 border border-pink-300 rounded-lg px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-pink-400 bg-white"
                                        >
                                    </div>

                                    <button
                                        type="submit"
                                        class="w-full bg-pink-600 text-white py-3 rounded-xl font-bold hover:bg-pink-700 transition shadow-md"
                                    >
                                        + Tambah ke Keranjang
                                    </button>
                                </form>

                            @else

                                <button
                                    type="button"
                                    disabled
                                    class="w-full bg-gray-400 text-white py-3 rounded-xl font-bold cursor-not-allowed"
                                >
                                    Stok Habis
                                </button>

                            @endif
                        </div>
                    </div>

                @else

                    <div class="text-center py-10">
                        <h1 class="text-xl font-bold text-slate-800">
                            Produk tidak ditemukan
                        </h1>

                        <a href="{{ url('/dashboard') }}"
                           class="text-pink-600 hover:underline mt-4 inline-block">
                            Kembali ke Dashboard
                        </a>
                    </div>

                @endif
            </div>
        </main>
    </div>
</body>
</html>
