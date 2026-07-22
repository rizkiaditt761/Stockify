@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <div class="mb-5">

        <h1 class="text-2xl font-bold text-gray-800">
            Pending Transaction
        </h1>

        <p class="text-gray-500">
            Daftar transaksi yang menunggu konfirmasi Staff Gudang.
        </p>

    </div>


    @if(session('success'))

        <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50">
            {{ session('error') }}
        </div>

    @endif



    <div class="bg-white rounded-lg shadow">

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left text-gray-500">

                <thead class="text-xs text-gray-700 uppercase bg-gray-100">

                    <tr>

                        <th class="px-6 py-3">
                            Produk
                        </th>


                        <th class="px-6 py-3">
                            Tipe
                        </th>


                        <th class="px-6 py-3">
                            Quantity
                        </th>


                        <th class="px-6 py-3">
                            Dibuat Oleh
                        </th>


                        <th class="px-6 py-3">
                            Tanggal
                        </th>


                        <th class="px-6 py-3">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>


                @forelse($transactions as $transaction)


                    <tr class="border-b">


                        <td class="px-6 py-4 font-medium text-gray-900">

                            {{ $transaction->product->name }}

                        </td>



                        <td class="px-6 py-4">


                            @if($transaction->type == 'IN')

                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">

                                    IN

                                </span>


                            @else

                                <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">

                                    OUT

                                </span>


                            @endif


                        </td>



                        <td class="px-6 py-4">

                            {{ $transaction->quantity }}

                        </td>



                        <td class="px-6 py-4">

                            {{ $transaction->user->name }}

                        </td>



                        <td class="px-6 py-4">

                            {{ $transaction->transaction_date->format('d M Y') }}

                        </td>



                        <td class="px-6 py-4 flex gap-2">


                            <form action="{{ route('stock_transactions.confirm',$transaction->id) }}"
                                  method="POST">

                                @csrf

                                @method('PUT')


                                <button
                                    type="submit"
                                    class="px-3 py-2 text-xs font-medium text-white bg-green-600 rounded-lg">

                                    Confirm

                                </button>


                            </form>



                            <form action="{{ route('stock_transactions.reject',$transaction->id) }}"
                                  method="POST">

                                @csrf

                                @method('PUT')


                                <button
                                    type="submit"
                                    class="px-3 py-2 text-xs font-medium text-white bg-red-600 rounded-lg">

                                    Reject

                                </button>


                            </form>


                        </td>


                    </tr>


                @empty


                    <tr>

                        <td colspan="6"
                            class="px-6 py-4 text-center">

                            Tidak ada transaksi Pending.

                        </td>


                    </tr>


                @endforelse


                </tbody>


            </table>

        </div>

    </div>


</div>


@endsection