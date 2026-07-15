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
                        {{ $transaction->type }}
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
                        {{ $transaction->transaction_date }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center p-4">
                        Belum ada transaksi.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection