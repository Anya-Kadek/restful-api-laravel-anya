<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - Anya Pastry and Dessert</title>
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

                <div class="space-x-6">
                    <a href="/dashboard"
                       class="text-white hover:text-pink-200 font-medium transition">
                        Dashboard
                    </a>

                    <a href="/cart"
                       class="text-white hover:text-pink-200 font-medium transition">
                        Keranjang
                    </a>

                    <a href="/checkout"
                       class="text-white font-bold underline">
                        Checkout
                    </a>
                </div>
            </div>
        </nav>

        <!-- Konten Checkout -->
        <main class="max-w-5xl mx-auto py-10 px-4">

            <h1 class="text-3xl font-extrabold text-slate-800 mb-2">
                Checkout
            </h1>

            <p class="text-slate-600 mb-8">
                Periksa pesanan dan lengkapi data pengirimanmu.
            </p>

            <!-- Pesan Berhasil atau Error -->
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-5">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                    <p class="font-semibold mb-2">
                        Periksa kembali data yang kamu masukkan.
                    </p>

                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $total = 0;
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Ringkasan Pesanan -->
                <section class="bg-white shadow-xl rounded-2xl p-6 border border-pink-100">

                    <h2 class="text-xl font-bold text-slate-800 mb-5">
                        Ringkasan Pesanan
                    </h2>

                    @forelse ($cart as $item)

                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp

                        <div class="flex gap-4 py-4 border-b border-pink-100">

                            @if (!empty($item['img']))
                                <img
                                    src="{{ asset('storage/' . $item['img']) }}"
                                    alt="{{ $item['name'] }}"
                                    class="w-20 h-20 object-cover rounded-xl"
                                    onerror="this.style.display='none'"
                                >
                            @endif

                            <div class="flex-1">

                                <h3 class="font-semibold text-slate-800">
                                    {{ $item['name'] }}
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                    × {{ $item['quantity'] }}
                                </p>

                                <p class="text-pink-600 font-bold mt-2">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </p>

                            </div>
                        </div>

                    @empty

                        <p class="text-slate-500 mb-4">
                            Keranjang kamu masih kosong.
                        </p>

                        <a href="/dashboard"
                           class="inline-block text-pink-600 font-semibold hover:underline">
                            Kembali Belanja
                        </a>

                    @endforelse

                    @if (count($cart) > 0)

                        <div class="flex justify-between items-center mt-6 pt-4">

                            <span class="font-bold text-lg">
                                Total Belanja
                            </span>

                            <span class="text-xl font-extrabold text-pink-600">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>

                        </div>

                    @endif

                </section>

                <!-- Form Data Pembeli -->
                <section class="bg-white shadow-xl rounded-2xl p-6 border border-pink-100">

                    <h2 class="text-xl font-bold text-slate-800 mb-5">
                        Data Pembeli
                    </h2>

                    @if (count($cart) > 0)

                        <form action="{{ route('checkout.process') }}"
                              method="POST"
                              class="space-y-5">

                            @csrf

                            <!-- Nama -->
                            <div>
                                <label for="name"
                                       class="block font-medium text-slate-700 mb-2">
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                    class="w-full border border-pink-200 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                                >

                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Nomor HP -->
                            <div>
                                <label for="phone"
                                       class="block font-medium text-slate-700 mb-2">
                                    Nomor HP
                                </label>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="Masukkan nomor HP"
                                    required
                                    class="w-full border border-pink-200 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                                >

                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label for="address"
                                       class="block font-medium text-slate-700 mb-2">
                                    Alamat Pengiriman
                                </label>

                                <textarea
                                    id="address"
                                    name="address"
                                    rows="4"
                                    placeholder="Masukkan alamat lengkap"
                                    required
                                    class="w-full border border-pink-200 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                                >{{ old('address') }}</textarea>

                                @error('address')
                                    <p class="text-red-500 text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Tombol Buat Pesanan -->
                            <button
                                type="submit"
                                class="w-full bg-pink-600 text-white py-3 rounded-lg font-bold hover:bg-pink-700 transition">
                                Buat Pesanan
                            </button>

                        </form>

                    @endif

                </section>

            </div>
        </main>
    </div>
</body>
</html>