@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-5">
        Tambah Transaksi Stok
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('stock_transactions.index') }}"
            class="px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700">
            Batal
        </a>
    </div>

    <form action="{{ route('stock_transactions.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label>Produk</label>

            <select
                name="product_id"
                class="border rounded-lg p-2 w-full">

                @foreach($products as $product)

                    <option value="{{ $product->id }}">
                        {{ $product->name }}
                    </option>

                @endforeach

            </select>
        </div>

        <div class="mb-4">
            <label>Jenis Transaksi</label>

            <select
                name="type"
                class="border rounded-lg p-2 w-full">

                <option value="IN">
                    Barang Masuk
                </option>

                <option value="OUT">
                    Barang Keluar
                </option>

            </select>
        </div>

        <div class="mb-4">
            <label>Jumlah</label>

            <input
                type="number"
                name="quantity"
                class="border rounded-lg p-2 w-full"
                min="1">
        </div>

        

        <div class="mb-4">
            <label>Catatan</label>

            <textarea
                name="notes"
                class="border rounded-lg p-2 w-full"
                rows="4"></textarea>
        </div>

        <button
            type="submit"
            class="bg-blue-700 text-white px-5 py-2 rounded-lg hover:bg-blue-800">
            Simpan
        </button>

    </form>

</div>

@endsection