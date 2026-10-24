
@extends('admin.layout')

@section('title', 'Kelola Produk')
@section('page-heading', 'Kelola Produk')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-xl font-bold">Daftar Produk</h3>
            <p class="text-gray-500 text-sm mt-1">
                Kelola produk Anya Pastry & Dessert.
            </p>
        </div>

        <a href="{{ route('admin.products.create') }}"
           class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700">
            + Tambah Produk
        </a>
    </div>

    @if ($products->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 mb-4">
                Belum ada produk yang ditambahkan.
            </p>

            <a href="{{ route('admin.products.create') }}"
               class="text-pink-600 font-semibold hover:underline">
                Tambahkan produk pertama
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-pink-50 border-b">
                        <th class="p-3">No.</th>
                        <th class="p-3">Produk</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Stok</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b">
                            <td class="p-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="p-3 font-medium">
                                {{ $product->name }}
                            </td>

                            <td class="p-3">
                                {{ $product->category->category ?? '-' }}
                            </td>

                            <td class="p-3">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </td>

                            <td class="p-3">
                                {{ $product->stock }}
                            </td>

                            <td class="p-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.products.edit', $product->product_id) }}"
                                       class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->product_id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>

@endsection