@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Tambah Transaksi Stok
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Catat transaksi barang masuk maupun barang keluar.
            </p>

        </div>

        

    </div>


    {{-- Card --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">

        <form action="{{ route('stock_transactions.store') }}"
            method="POST"
            class="p-6">

            @csrf

            @if ($errors->any())

                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                    <h3 class="mb-2 font-semibold text-red-700">
                        Terjadi kesalahan
                    </h3>

                    <ul class="list-disc pl-5 text-sm text-red-600">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Produk --}}
            <div class="mb-5">

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Produk
                </label>

                <select
                    name="product_id"
                    class="w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:ring-blue-500">

                    @foreach($products as $product)

                        <option value="{{ $product->id }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>

                            {{ $product->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Jenis --}}
            <div class="mb-5">

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Jenis Transaksi
                </label>

                <select
                    name="type"
                    class="w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:ring-blue-500">

                    <option value="IN" {{ old('type') == 'IN' ? 'selected' : '' }}>
                        Stock In
                    </option>

                    <option value="OUT" {{ old('type') == 'OUT' ? 'selected' : '' }}>
                        Stock Out
                    </option>

                </select>

            </div>


            {{-- Jumlah --}}
            <div class="mb-5">

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Jumlah Barang
                </label>

                <input
                    type="number"
                    name="quantity"
                    min="1"
                    value="{{ old('quantity') }}"
                    placeholder="Masukkan jumlah barang"
                    class="w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:ring-blue-500">

            </div>


            {{-- Catatan --}}
            <div class="mb-6">

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Catatan (Opsional)
                </label>

                <textarea
                    name="notes"
                    rows="4"
                    placeholder="Masukkan catatan transaksi..."
                    class="w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>

            </div>


            {{-- Button --}}
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">

                    Simpan Transaksi

                </button>

                <a href="{{ route('stock_transactions.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection