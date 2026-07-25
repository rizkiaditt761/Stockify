@extends('layouts.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Detail Stock Transaction
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Informasi lengkap transaksi stok barang.
            </p>

        </div>

        

    </div>



    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Header Card --}}
        <div class="border-b px-8 py-6">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-bold text-blue-700">

                        {{ $transaction->transaction_code }}

                    </h2>

                    <p class="mt-1 text-sm text-gray-500">

                        Dibuat pada
                        {{ $transaction->transaction_date->format('d F Y H:i') }}

                    </p>

                </div>



                <div>

                    @switch($transaction->status)

                        @case('Pending')

                            <span class="rounded-full bg-yellow-100 px-4 py-2 font-semibold text-yellow-700">
                                Pending
                            </span>

                            @break


                        @case('Completed')

                            <span class="rounded-full bg-green-100 px-4 py-2 font-semibold text-green-700">
                                Completed
                            </span>

                            @break


                        @case('Rejected')

                            <span class="rounded-full bg-red-100 px-4 py-2 font-semibold text-red-700">
                                Rejected
                            </span>

                            @break


                        @case('Cancelled')

                            <span class="rounded-full bg-gray-200 px-4 py-2 font-semibold text-gray-700">
                                Cancelled
                            </span>

                            @break

                    @endswitch

                </div>

            </div>

        </div>



        <div class="grid gap-8 p-8 md:grid-cols-2">

            {{-- LEFT --}}
            <div>

                <h3 class="mb-4 text-lg font-bold text-gray-800">

                    Informasi Transaksi

                </h3>

                <table class="w-full">

                    <tr>

                        <td class="w-44 py-2 text-gray-500">

                            Kode Transaksi

                        </td>

                        <td class="font-semibold text-blue-600">

                            {{ $transaction->transaction_code }}

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500">

                            Produk

                        </td>

                        <td class="font-medium">

                            {{ $transaction->product->name }}

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500">

                            Supplier

                        </td>

                        <td>

                            {{ $transaction->product->supplier->name }}

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500">

                            Kategori

                        </td>

                        <td>

                            {{ $transaction->product->category->name }}

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500">

                            Jenis

                        </td>

                        <td>

                            @if($transaction->type == 'IN')

                                <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">

                                    Stock In

                                </span>

                            @else

                                <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">

                                    Stock Out

                                </span>

                            @endif

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500">

                            Jumlah

                        </td>

                        <td>

                            {{ $transaction->quantity }} unit

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500">

                            Stock Sebelum

                        </td>

                        <td>

                            {{ $transaction->stock_before }} unit

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500">

                            Stock Sesudah

                        </td>

                        <td>

                            @if($transaction->type == 'IN')

                                <span class="font-semibold text-green-600">

                                    {{ $transaction->stock_after }} unit

                                </span>

                            @else

                                <span class="font-semibold text-red-600">

                                    {{ $transaction->stock_after }} unit

                                </span>

                            @endif

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500 align-top">

                            Catatan

                        </td>

                        <td>

                            <div class="rounded-lg border bg-gray-50 p-3">

                                {{ $transaction->notes ?: '-' }}

                            </div>

                        </td>

                    </tr>

                </table>
                            </div>



            {{-- RIGHT --}}
            <div>

                <h3 class="mb-4 text-lg font-bold text-gray-800">

                    Informasi User

                </h3>

                <table class="w-full">

                    <tr>

                        <td class="w-44 py-2 text-gray-500">

                            Dibuat Oleh

                        </td>

                        <td>

                            <div class="font-medium">

                                {{ $transaction->user->name }}

                            </div>

                            <div class="text-sm text-gray-500">

                                {{ ucfirst($transaction->user->role) }}

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500">

                            Dikonfirmasi Oleh

                        </td>

                        <td>

                            @if($transaction->confirmedBy)

                                <div class="font-medium">

                                    {{ $transaction->confirmedBy->name }}

                                </div>

                                <div class="text-sm text-gray-500">

                                    {{ ucfirst($transaction->confirmedBy->role) }}

                                </div>

                            @else

                                <span class="text-gray-400">

                                    -

                                </span>

                            @endif

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500">

                            Tanggal Transaksi

                        </td>

                        <td>

                            {{ $transaction->transaction_date->format('d F Y H:i') }}

                        </td>

                    </tr>

                    <tr>

                        <td class="py-2 text-gray-500">

                            Tanggal Konfirmasi

                        </td>

                        <td>

                            {{ $transaction->confirmed_at?->format('d F Y H:i') ?? '-' }}

                        </td>

                    </tr>

                </table>

            </div>

        </div>



        {{-- Rejection Reason --}}
        @if($transaction->status == 'Rejected')

            <div class="border-t bg-red-50 px-8 py-6">

                <h3 class="mb-3 text-lg font-bold text-red-700">

                    ❌ Alasan Penolakan

                </h3>

                <div class="rounded-xl border border-red-200 bg-white p-5 leading-relaxed text-gray-700">

                    {{ $transaction->rejection_reason }}

                </div>

            </div>

        @endif



        {{-- Footer --}}
        <div class="flex justify-end border-t px-8 py-5">

            <a
                href="{{ route('stock_transactions.index') }}"
                class="rounded-lg bg-gray-600 px-5 py-2.5 text-white hover:bg-gray-700">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection