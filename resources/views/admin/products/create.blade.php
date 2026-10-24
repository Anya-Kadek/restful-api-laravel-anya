
@extends('admin.layout')

@section('title', 'Tambah Produk')
@section('page-heading', 'Tambah Produk')

@section('content')

<div class="bg-white rounded-xl shadow p-6 max-w-3xl">

    <h3 class="text-xl font-bold mb-6">
        Form Tambah Produk
    </h3>

    <form action="{{ route('admin.products.store') }}"
          method="POST">

        @csrf

        <div class="mb-5">
            <label class="block font-medium mb-2">
                Nama Produk
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-300"
                   placeholder="Contoh: Strawberry Cake">
        </div>

        <div class="mb-5">
            <label class="block font-medium mb-2">
                Kategori Produk
            </label>

            <select name="category_id"
                    required
                    class="w-full border rounded-lg p-3 bg-white">

                <option value="">Pilih kategori</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}"
                        {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach

            </select>

            @if ($categories->isEmpty())
                <p class="text-sm text-red-500 mt-2">
                    Belum ada kategori. Tambahkan kategori ke database terlebih dahulu.
                </p>
            @endif
        </div>

        <div class="mb-5">
            <label class="block font-medium mb-2">
                Deskripsi Produk
            </label>

            <textarea name="description"
                      rows="4"
                      class="w-full border rounded-lg p-3"
                      placeholder="Tuliskan deskripsi produk">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

            <div>
                <label class="block font-medium mb-2">
                    Harga (Rp)
                </label>

                <input type="number"
                       name="price"
                       value="{{ old('price') }}"
                       min="0"
                       required
                       class="w-full border rounded-lg p-3"
                       placeholder="Contoh: 50000">
            </div>

            <div>
                <label class="block font-medium mb-2">
                    Stok
                </label>

                <input type="number"
                       name="stock"
                       value="{{ old('stock') }}"
                       min="0"
                       required
                       class="w-full border rounded-lg p-3"
                       placeholder="Contoh: 20">
            </div>

        </div>

        <div class="mb-6">
            <label class="block font-medium mb-2">
                URL Gambar Produk
            </label>

            <input type="url"
                   name="img"
                   value="{{ old('img') }}"
                   class="w-full border rounded-lg p-3"
                   placeholder="https://contoh.com/gambar.jpg">

            <p class="text-gray-500 text-sm mt-2">
                Masukkan alamat gambar yang bisa diakses melalui internet.
            </p>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="bg-pink-600 text-white px-5 py-3 rounded-lg hover:bg-pink-700">
                Simpan Produk
            </button>

            <a href="{{ route('admin.products.index') }}"
               class="bg-gray-200 px-5 py-3 rounded-lg hover:bg-gray-300">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection