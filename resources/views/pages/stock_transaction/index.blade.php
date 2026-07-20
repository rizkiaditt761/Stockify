@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Transaksi Stok
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


    {{-- Alert Success --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif


    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 uppercase text-xs text-gray-600">

                    <tr>

                        <th class="px-6 py-4 text-left">
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
                            Stok Awal
                        </th>

                        <th class="px-6 py-4 text-center">
                            Stok Akhir
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

                            <td class="px-6 py-4">

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
                                        Stock In
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

                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs text-blue-700">

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
                                class="py-10 text-center text-gray-500">

                                Belum ada transaksi stok.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection