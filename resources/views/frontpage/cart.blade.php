<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang Belanja - Anya Pastry and Dessert</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navbar Sederhana (Tanpa Beranda) -->
        <nav class="bg-pink-500 border-b border-pink-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
                <div class="font-bold text-xl text-white">
                    Anya Pastry and Dessert 🍰
                </div>
                <div class="space-x-6">
                    <a href="/dashboard" class="text-white hover:text-pink-200 font-medium transition">Dashboard</a>
                    <a href="/cart" class="text-white font-bold underline transition">Keranjang</a>
                    <a href="/checkout" class="text-white hover:text-pink-200 font-medium transition">Checkout</a>
                </div>
            </div>
        </nav>

        <!-- Main Content Keranjang -->
        <main class="max-w-4xl mx-auto py-10 px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-pink-100">
                <h1 class="text-3xl font-extrabold text-slate-800 mb-6 text-center">Keranjang Belanja Kamu</h1>

                @if(session('success'))
                    <div class="mb-6 bg-pink-100 border border-pink-300 text-pink-700 px-4 py-3 rounded-lg text-sm text-center">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('cart') && count(session('cart')) > 0)
                    <div class="space-y-4 mb-6">
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <div class="flex items-center justify-between border-b border-pink-100 pb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 bg-pink-200 rounded-lg overflow-hidden flex-shrink-0 flex items-center justify-center">
                                        @if(isset($details['img']) && $details['img'])
                                            <img src="{{ asset($details['img']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-xs text-pink-500">Foto</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-800">{{ $details['name'] }}</h3>
                                        <p class="text-sm text-pink-600">Rp {{ number_format($details['price'], 0, ',', '.') }} x {{ $details['quantity'] }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-slate-700 mb-1">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center border-t border-pink-200 pt-4 mb-6">
                        <span class="text-lg font-bold text-slate-800">Total Harga:</span>
                        <span class="text-2xl font-extrabold text-pink-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <a href="/dashboard" class="bg-pink-100 text-pink-700 px-6 py-2 rounded-lg font-medium hover:bg-pink-200 transition">
                            Lanjut Belanja
                        </a>
                        <a href="/checkout" class="bg-pink-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-pink-700 transition">
                            Proses Checkout &rarr;
                        </a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-slate-600 mb-6">Belum ada produk kue atau dessert yang dimasukkan ke dalam keranjang.</p>
                        <a href="/dashboard" class="inline-block bg-pink-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-pink-700 transition">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>