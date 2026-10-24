
@extends('admin.layout')

@section('title', 'Daftar Pesanan')
@section('page-heading', 'Daftar Pesanan')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">
        <h3 class="text-xl font-bold">
            Semua Pesanan
        </h3>

        <p class="text-gray-500 text-sm mt-1">
            Lihat dan kelola pesanan pelanggan Anya Pastry & Dessert.
        </p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">

            <thead>
                <tr class="bg-pink-50 border-b">
                    <th class="p-3">No.</th>
                    <th class="p-3">Nomor Pesanan</th>
                    <th class="p-3">Pelanggan</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-b">

                        <td class="p-3">
                            {{ $loop->iteration }}
                        </td>

                        <td class="p-3 font-medium">
                            {{ $order->order_number }}
                        </td>

                        <td class="p-3">
                            {{ $order->customer_name }}
                        </td>

                        <td class="p-3 whitespace-nowrap">
                            Rp{{ number_format($order->total, 0, ',', '.') }}
                        </td>

                        <td class="p-3">
                            <span class="inline-block rounded-full bg-yellow-100 px-3 py-1 text-sm">
                                {{ $order->status }}
                            </span>
                        </td>

                        <td class="p-3">
                            <a href="{{ route('admin.orders.show', $order->order_id) }}"
                               class="text-pink-600 font-medium hover:underline">
                                Lihat Detail
                            </a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="p-8 text-center text-gray-500">
                            Belum ada pesanan dari pelanggan.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection