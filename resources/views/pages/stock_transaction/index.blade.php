@extends('layouts.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Stock Transaction
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Riwayat seluruh transaksi barang masuk dan barang keluar.
            </p>

        </div>

        <a href="{{ route('stock_transactions.create') }}"
            class="inline-flex items-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">

            + Tambah Transaksi

        </a>

    </div>

    {{-- Alert --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif


    {{-- Total Transaction --}}
    <div class="mb-6 rounded-xl border border-blue-100 bg-blue-50 p-5 shadow-sm">

        <p class="text-sm font-medium text-blue-700">

            Total Transaksi

        </p>

        <h2 class="mt-2 text-4xl font-bold text-blue-700">

            {{ $totalTransaction }}

        </h2>

        <p class="mt-2 text-sm text-gray-500">

            @if($activeType == 'IN')

                Menampilkan transaksi <span class="font-semibold text-green-600">Stock In</span>

            @elseif($activeType == 'OUT')

                Menampilkan transaksi <span class="font-semibold text-red-600">Stock Out</span>

            @elseif($startDate || $endDate)

                Filter berdasarkan tanggal transaksi

            @else

                Seluruh transaksi

            @endif

        </p>

    </div>


    {{-- Card Filter --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mb-6">

        {{-- Stock In --}}
        <a href="{{ $activeType == 'IN'
                ? route('stock_transactions.index', request()->except('type'))
                : route('stock_transactions.index', array_merge(request()->all(), ['type' => 'IN'])) }}"

            class="rounded-xl border p-5 transition hover:shadow-md

            {{ $activeType == 'IN'
                ? 'border-green-500 bg-green-100'
                : 'border-green-200 bg-green-50' }}">

            <p class="text-sm font-medium text-green-700">

                Stock In

            </p>

            <h2 class="mt-2 text-4xl font-bold text-green-700">

                {{ $totalIn }}

            </h2>

            <p class="mt-2 text-sm font-medium text-green-700">

                +{{ number_format($totalInQty) }} Barang

            </p>

        </a>


        {{-- Stock Out --}}
        <a href="{{ $activeType == 'OUT'
                ? route('stock_transactions.index', request()->except('type'))
                : route('stock_transactions.index', array_merge(request()->all(), ['type' => 'OUT'])) }}"

            class="rounded-xl border p-5 transition hover:shadow-md

            {{ $activeType == 'OUT'
                ? 'border-red-500 bg-red-100'
                : 'border-red-200 bg-red-50' }}">

            <p class="text-sm font-medium text-red-700">

                Stock Out

            </p>

            <h2 class="mt-2 text-4xl font-bold text-red-700">

                {{ $totalOut }}

            </h2>

            <p class="mt-2 text-sm font-medium text-red-700">

                -{{ number_format($totalOutQty) }} Barang

            </p>

        </a>

    </div>


    {{-- Search & Filter --}}
    <form
        method="GET"
        class="mb-6 rounded-xl border border-gray-200 bg-white p-5 shadow-sm">

        @if($activeType)

            <input
                type="hidden"
                name="type"
                value="{{ $activeType }}">

        @endif

        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">

            {{-- Search --}}
            <div class="md:col-span-2">

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Search

                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari produk, user atau catatan..."
                    class="w-full rounded-lg border border-gray-300 p-2.5">

            </div>

            {{-- Start --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Tanggal Awal

                </label>

                <input
                    type="date"
                    name="start_date"
                    value="{{ $startDate }}"
                    class="w-full rounded-lg border border-gray-300 p-2.5">

            </div>

            {{-- End --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Tanggal Akhir

                </label>

                <input
                    type="date"
                    name="end_date"
                    value="{{ $endDate }}"
                    class="w-full rounded-lg border border-gray-300 p-2.5">

            </div>

        </div>

        <div class="mt-5 flex justify-end gap-3">

            <button
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">

                Cari

            </button>

            <a href="{{ route('stock_transactions.index') }}"
                class="rounded-lg bg-gray-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-700">

                Reset

            </a>

        </div>

    </form>

        {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 uppercase text-xs text-gray-600">

                    <tr>

                        <th class="px-6 py-4 text-center">
                            No
                        </th>

                        <th class="px-6 py-4 text-left">
                            Produk
                        </th>

                        <th class="px-6 py-4 text-center">
                            Jenis
                        </th>

                        <th class="px-6 py-4 text-center">
                            Qty
                        </th>

                        <th class="px-6 py-4 text-center">
                            Stock Awal
                        </th>

                        <th class="px-6 py-4 text-center">
                            Stock Akhir
                        </th>

                        <th class="px-6 py-4 text-left">
                            User
                        </th>

                        <th class="px-6 py-4 text-left">
                            Catatan
                        </th>

                        <th class="px-6 py-4 text-center">
                            Tanggal
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($transactions as $transaction)

                        <tr class="border-t transition hover:bg-gray-50">

                            <td class="px-6 py-4 text-center">

                                {{ $loop->iteration }}

                            </td>

                            <td class="px-6 py-4 font-medium text-gray-800">

                                {{ $transaction->product->name }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($transaction->type == 'IN')

                                    <span class="inline-flex whitespace-nowrap rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                        Stock In

                                    </span>

                                @else

                                    <span class="inline-flex whitespace-nowrap rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                                        Stock Out

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-center font-semibold">

                                {{ $transaction->quantity }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ $transaction->stock_before }}

                            </td>

                            <td class="px-6 py-4 text-center font-semibold text-blue-600">

                                {{ $transaction->stock_after }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $transaction->user->name }}

                            </td>

                            <td class="px-6 py-4">

                                @if($transaction->notes)

                                    <span class="inline-block whitespace-nowrap rounded-lg bg-blue-100 px-3 py-2 text-xs font-medium text-blue-700">
                                        {{ $transaction->notes }}
                                    </span>

                                @else

                                    <span class="text-gray-400">

                                        -

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-center whitespace-nowrap">

                                {{ $transaction->transaction_date->format('d M Y') }}

                                <br>

                                <span class="text-xs text-gray-500">

                                    {{ $transaction->transaction_date->format('H:i') }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="mb-3 h-14 w-14 text-gray-300"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M9 17v-6h13v6M3 7h18M5 7V5a2 2 0 012-2h10a2 2 0 012 2v2"/>

                                    </svg>

                                    <h3 class="text-lg font-semibold text-gray-700">

                                        Tidak ada transaksi

                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">

                                        Tidak ditemukan transaksi
                                        sesuai filter yang dipilih.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection