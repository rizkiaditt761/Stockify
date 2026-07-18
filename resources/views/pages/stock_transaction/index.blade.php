@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-5">
        Stock Transaction
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('stock_transactions.create') }}"
        class="inline-block mb-5 bg-blue-700 text-white px-5 py-2 rounded-lg hover:bg-blue-800">
        Tambah Transaksi
    </a>

    <table class="w-full border">

        <thead class="bg-gray-100">

            <tr>

                <th class="border p-2">No</th>
                <th class="border p-2">Produk</th>
                <th class="border p-2">Jenis</th>
                <th class="border p-2">Qty</th>
                <th class="border p-2">Stock Awal</th>
                <th class="border p-2">Stock Akhir</th>
                <th class="border p-2">User</th>
                <th class="border p-2">Catatan</th>
                <th class="border p-2">Tanggal</th>

            </tr>

        </thead>

        <tbody>

            @forelse($transactions as $transaction)

                <tr>

                    <td class="border p-2">
                        {{ $loop->iteration }}
                    </td>

                    <td class="border p-2">
                        {{ $transaction->product->name }}
                    </td>

                    <td class="border p-2">

                        @if($transaction->type == 'IN')
                            <span class="px-2 py-1 rounded bg-green-100 text-green-700 font-semibold">
                                IN
                            </span>
                        @else
                            <span class="px-2 py-1 rounded bg-red-100 text-red-700 font-semibold">
                                OUT
                            </span>
                        @endif

                    </td>

                    <td class="border p-2">
                        {{ $transaction->quantity }}
                    </td>

                    <td class="border p-2">
                        {{ $transaction->stock_before }}
                    </td>

                    <td class="border p-2">
                        {{ $transaction->stock_after }}
                    </td>

                    <td class="border p-2">
                        {{ $transaction->user->name }}
                    </td>

                    <td class="border p-2">

                        @if($transaction->notes)

                            <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs">
                                {{ $transaction->notes }}
                            </span>

                        @else

                            -

                        @endif

                    </td>

                    <td class="border p-2">
                        {{ $transaction->transaction_date->format('d-m-Y H:i') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center p-4">
                        Belum ada transaksi.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection