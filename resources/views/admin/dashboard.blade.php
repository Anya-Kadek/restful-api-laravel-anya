
@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('page-heading', 'Dashboard Admin')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <!-- Total Produk -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-pink-500">
        <p class="text-gray-500 text-sm">Total Produk</p>
        <h3 class="text-3xl font-bold mt-2">
            {{ $totalProducts }}
        </h3>
        <p class="text-sm text-gray-500 mt-2">
            Produk dalam toko
        </p>
    </div>

    <!-- Total Pesanan -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-purple-500">
        <p class="text-gray-500 text-sm">Total Pesanan</p>
        <h3 class="text-3xl font-bold mt-2">
            {{ $totalOrders }}
        </h3>
        <p class="text-sm text-gray-500 mt-2">
            Seluruh pesanan pelanggan
        </p>
    </div>

    <!-- Total Pendapatan -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
        <p class="text-gray-500 text-sm">Total Pendapatan</p>
        <h3 class="text-2xl font-bold mt-2">
            Rp{{ number_format($totalRevenue, 0, ',', '.') }}
        </h3>
        <p class="text-sm text-gray-500 mt-2">
            Dari pesanan selesai
        </p>
    </div>

    <!-- Pesanan Menunggu -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500">
        <p class="text-gray-500 text-sm">Pesanan Menunggu</p>
        <h3 class="text-3xl font-bold mt-2">
            {{ $pendingOrders }}
        </h3>
        <p class="text-sm text-gray-500 mt-2">
            Perlu dikonfirmasi
        </p>
    </div>

</div>

<!-- Pesanan Terbaru -->
<div class="bg-white rounded-xl shadow mt-8 p-6">

    <h3 class="text-xl font-bold mb-5">
        Pesanan Terbaru
    </h3>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b bg-pink-50">
                    <th class="p-3">No. Pesanan</th>
                    <th class="p-3">Nama Pelanggan</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($latestOrders as $order)
                    <tr class="border-b">
                        <td class="p-3">
                            {{ $order->order_number }}
                        </td>

                        <td class="p-3">
                            {{ $order->customer_name }}
                        </td>

                        <td class="p-3">
                            Rp{{ number_format($order->total, 0, ',', '.') }}
                        </td>

                        <td class="p-3">
                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-sm">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            Belum ada pesanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection