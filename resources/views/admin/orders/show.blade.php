
@extends('admin.layout')

@section('title', 'Detail Pesanan')
@section('page-heading', 'Detail Pesanan')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="flex flex-wrap justify-between items-center gap-3 mb-6">
        <div>
            <h3 class="text-xl font-bold">
                {{ $order->order_number }}
            </h3>

            <p class="text-gray-500 text-sm mt-1">
                Detail informasi pesanan pelanggan.
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">
            Kembali
        </a>
    </div>

    <!-- Informasi Pelanggan -->
    <div class="bg-pink-50 rounded-lg p-5 mb-6">
        <h4 class="font-bold text-lg mb-4">
            Informasi Pelanggan
        </h4>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <p class="text-sm text-gray-500">
                    Nama Pelanggan
                </p>

                <p class="font-medium">
                    {{ $order->customer_name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Nomor Telepon
                </p>

                <p class="font-medium">
                    {{ $order->phone }}
                </p>
            </div>

            <div class="md:col-span-2">
                <p class="text-sm text-gray-500">
                    Alamat Pengiriman
                </p>

                <p class="font-medium">
                    {{ $order->address }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Tanggal Pesanan
                </p>

                <p class="font-medium">
                    {{ $order->created_at->format('d-m-Y H:i') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Status Saat Ini
                </p>

                <p class="font-medium">
                    {{ $order->status }}
                </p>
            </div>

        </div>
    </div>

    <!-- Daftar Produk Pesanan -->
    <h4 class="font-bold text-lg mb-4">
        Produk yang Dipesan
    </h4>

    <div class="overflow-x-auto mb-6">
        <table class="w-full text-left">

            <thead>
                <tr class="bg-pink-50 border-b">
                    <th class="p-3">Nama Produk</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Jumlah</th>
                    <th class="p-3">Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($order->items as $item)
                    <tr class="border-b">
                        <td class="p-3">
                            {{ $item->product_name }}
                        </td>

                        <td class="p-3 whitespace-nowrap">
                            Rp{{ number_format($item->price, 0, ',', '.') }}
                        </td>

                        <td class="p-3">
                            {{ $item->quantity }}
                        </td>

                        <td class="p-3 whitespace-nowrap">
                            Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="p-6 text-center text-gray-500">
                            Belum ada detail produk pada pesanan ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <!-- Total Pembayaran -->
    <div class="flex justify-end mb-8">
        <div class="text-right">
            <p class="text-gray-500">
                Total Pembayaran
            </p>

            <p class="text-2xl font-bold text-pink-700">
                Rp{{ number_format($order->total, 0, ',', '.') }}
            </p>
        </div>
    </div>

    <!-- Ubah Status Pesanan -->
    <div class="border-t pt-6">
        <h4 class="font-bold text-lg mb-4">
            Ubah Status Pesanan
        </h4>

        <form action="{{ route('admin.orders.status', $order->order_id) }}"
              method="POST"
              class="flex flex-wrap items-end gap-4">

            @csrf
            @method('PATCH')

            <div class="flex-1 min-w-52">
                <label class="block font-medium mb-2">
                    Status Pesanan
                </label>

                <select name="status"
                        required
                        class="w-full border rounded-lg p-3 bg-white">

                    @foreach ([
                        'Menunggu Konfirmasi',
                        'Diproses',
                        'Dikirim',
                        'Selesai',
                        'Dibatalkan'
                    ] as $status)
                        <option value="{{ $status }}"
                            {{ $order->status === $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach

                </select>
            </div>

            <button type="submit"
                    class="bg-pink-600 text-white px-5 py-3 rounded-lg hover:bg-pink-700">
                Simpan Status
            </button>

        </form>
    </div>

</div>

@endsection
