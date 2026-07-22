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
                Monitoring seluruh transaksi stok barang.
            </p>

        </div>


        {{-- Tambah hanya Manager --}}
        @if(auth()->user()->role == 'manager')

            <a href="{{ route('stock_transactions.create') }}"
                class="inline-flex items-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">

                + Tambah Transaksi

            </a>

        @endif


    </div>



    {{-- Alert --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif




    {{-- Summary Cards --}}
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-5">


        {{-- Total --}}
        <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

            <p class="text-sm font-medium text-blue-700">
                Total Transaksi
            </p>

            <h2 class="mt-2 text-4xl font-bold text-blue-700">

                {{ $totalTransaction }}

            </h2>

        </div>




        {{-- Pending --}}
        <div class="rounded-xl border border-yellow-200 bg-yellow-50 p-5">

            <p class="text-sm font-medium text-yellow-700">
                Pending
            </p>

            <h2 class="mt-2 text-4xl font-bold text-yellow-700">

                {{ $totalPending }}

            </h2>

        </div>




        {{-- Confirmed --}}
        <div class="rounded-xl border border-green-200 bg-green-50 p-5">

            <p class="text-sm font-medium text-green-700">
                Completed
            </p>

            <h2 class="mt-2 text-4xl font-bold text-green-700">

                {{ $totalCompleted }}

            </h2>

        </div>




        {{-- Rejected --}}
        <div class="rounded-xl border border-red-200 bg-red-50 p-5">

            <p class="text-sm font-medium text-red-700">
                Rejected
            </p>

            <h2 class="mt-2 text-4xl font-bold text-red-700">

                {{ $totalRejected }}

            </h2>

        </div>




        {{-- Cancelled --}}
        <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">

            <p class="text-sm font-medium text-gray-700">
                Cancelled
            </p>

            <h2 class="mt-2 text-4xl font-bold text-gray-700">

                {{ $totalCancelled }}

            </h2>

        </div>


    </div>






    {{-- Search & Filter --}}
    <form
        method="GET"
        class="mb-6 rounded-xl border border-gray-200 bg-white p-5 shadow-sm">


        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">



            {{-- Search --}}
            <div class="md:col-span-2">

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Search

                </label>


                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari produk, user atau catatan..."
                    class="w-full rounded-lg border border-gray-300 p-2.5">

            </div>




            {{-- Status --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Status

                </label>


                <select
                    name="status"
                    class="w-full rounded-lg border border-gray-300 p-2.5">


                    <option value="">
                        Semua Status
                    </option>


                    <option value="Pending"
                        {{ request('status') == 'Pending' ? 'selected' : '' }}>

                        Pending

                    </option>


                    <option value="Completed"
                        {{ request('status') == 'Completed' ? 'selected' : '' }}>

                        Completed

                    </option>


                    <option value="Rejected"
                        {{ request('status') == 'Rejected' ? 'selected' : '' }}>

                        Rejected

                    </option>


                    <option value="Cancelled"
                        {{ request('status') == 'Cancelled' ? 'selected' : '' }}>

                        Cancelled

                    </option>


                </select>


            </div>





            {{-- Type --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Jenis

                </label>


                <select
                    name="type"
                    class="w-full rounded-lg border border-gray-300 p-2.5">


                    <option value="">
                        Semua Jenis
                    </option>


                    <option value="IN"
                        {{ request('type') == 'IN' ? 'selected' : '' }}>

                        Stock In

                    </option>


                    <option value="OUT"
                        {{ request('type') == 'OUT' ? 'selected' : '' }}>

                        Stock Out

                    </option>


                </select>


            </div>




            {{-- Start Date --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Tanggal Awal

                </label>


                <input
                    type="date"
                    name="start_date"
                    value="{{ request('start_date') }}"
                    class="w-full rounded-lg border border-gray-300 p-2.5">


            </div>




            {{-- End Date --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Tanggal Akhir

                </label>


                <input
                    type="date"
                    name="end_date"
                    value="{{ request('end_date') }}"
                    class="w-full rounded-lg border border-gray-300 p-2.5">


            </div>



        </div>




        <div class="mt-5 flex justify-end gap-3">


            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">

                Filter

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


                <thead class="bg-gray-50 text-xs uppercase text-gray-600">


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


                        <th class="px-6 py-4 text-left">
                            Dibuat Oleh
                        </th>


                        <th class="px-6 py-4 text-center">
                            Status
                        </th>


                        <th class="px-6 py-4 text-left">
                            Dikonfirmasi Oleh
                        </th>


                        <th class="px-6 py-4 text-center">
                            Tanggal
                        </th>


                        <th class="px-6 py-4 text-center">
                            Action
                        </th>


                    </tr>


                </thead>




                <tbody>


                @forelse($transactions as $transaction)


                    <tr class="border-t hover:bg-gray-50">



                        <td class="px-6 py-4 text-center">

                            {{ $loop->iteration }}

                        </td>




                        <td class="px-6 py-4 font-medium">

                            {{ $transaction->product->name }}

                        </td>




                        <td class="px-6 py-4 text-center">


                            @if($transaction->type == 'IN')


                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                    IN

                                </span>


                            @else


                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                                    OUT

                                </span>


                            @endif


                        </td>




                        <td class="px-6 py-4 text-center font-semibold">

                            {{ $transaction->quantity }}

                        </td>




                        <td class="px-6 py-4">

                            {{ $transaction->user->name }}

                        </td>






                        {{-- Status --}}

                        <td class="px-6 py-4 text-center">


                            @if($transaction->status == 'Pending')


                                <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">

                                    Pending

                                </span>




                            @elseif($transaction->status == 'Completed')


                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                    Confirmed

                                </span>




                            @elseif($transaction->status == 'Rejected')


                                <div class="flex flex-col items-center gap-2">


                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                                        Rejected

                                    </span>



                                    @if($transaction->rejection_reason)

                                        <p class="text-xs text-gray-600">

                                            {{ $transaction->rejection_reason }}

                                        </p>

                                    @endif


                                </div>





                            @elseif($transaction->status == 'Cancelled')


                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">

                                    Cancelled

                                </span>


                            @endif


                        </td>






                        {{-- Confirmed By --}}

                        <td class="px-6 py-4">


                            @if($transaction->confirmedBy)


                                {{ $transaction->confirmedBy->name }}


                                <br>


                                <span class="text-xs text-gray-500">

                                    {{ $transaction->confirmed_at?->format('d M Y H:i') }}

                                </span>



                            @else


                                <span class="text-gray-400">

                                    Belum dikonfirmasi

                                </span>



                            @endif


                        </td>







                        {{-- Date --}}

                        <td class="px-6 py-4 text-center whitespace-nowrap">


                            {{ $transaction->transaction_date->format('d M Y') }}


                            <br>


                            <span class="text-xs text-gray-500">

                                {{ $transaction->transaction_date->format('H:i') }}

                            </span>


                        </td>







                        {{-- Action --}}

                        <td class="px-6 py-4 text-center">



                            {{-- Manager Cancel milik sendiri --}}

                            @if(
                                auth()->user()->role == 'manager'
                                &&
                                $transaction->status == 'Pending'
                                &&
                                $transaction->user_id == auth()->id()
                            )


                                <form
                                    action="{{ route('stock_transactions.cancel', $transaction->id) }}"
                                    method="POST">


                                    @csrf
                                    @method('PATCH')


                                    <button
                                        onclick="return confirm('Batalkan transaksi ini?')"
                                        class="rounded-lg bg-red-600 px-3 py-2 text-xs font-medium text-white hover:bg-red-700">


                                        Cancel


                                    </button>


                                </form>





                            {{-- Staff Confirm / Reject --}}

                            @elseif(
                                auth()->user()->role == 'staff'
                                &&
                                $transaction->status == 'Pending'
                            )


                                <div class="flex justify-center gap-2">





                                    {{-- Confirm --}}

                                    <form
                                        action="{{ route('stock_transactions.confirm', $transaction->id) }}"
                                        method="POST">


                                        @csrf
                                        @method('PUT')


                                        <button
                                            onclick="return confirm('Konfirmasi transaksi ini?')"
                                            class="rounded-lg bg-green-600 px-3 py-2 text-xs font-medium text-white hover:bg-green-700">


                                            Confirm


                                        </button>


                                    </form>






                                    {{-- Reject --}}

                                    <button
                                        type="button"
                                        onclick="openRejectModal({{ $transaction->id }})"
                                        class="rounded-lg bg-red-600 px-3 py-2 text-xs font-medium text-white hover:bg-red-700">


                                        Reject


                                    </button>



                                </div>





                            @else



                                <span class="text-gray-400">

                                    -

                                </span>



                            @endif



                        </td>



                    </tr>



                @empty



                    <tr>


                        <td colspan="9"
                            class="py-12 text-center">


                            <div class="flex flex-col items-center">


                                <h3 class="text-lg font-semibold text-gray-700">

                                    Tidak ada transaksi

                                </h3>


                                <p class="mt-1 text-sm text-gray-500">

                                    Belum ada data transaksi.

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





{{-- Reject Modal --}}

<div
    id="rejectModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">


    <div class="w-full max-w-md rounded-xl bg-white p-6">


        <h2 class="mb-4 text-xl font-bold">

            Reject Transaction

        </h2>




        <form
            id="rejectForm"
            method="POST">


            @csrf
            @method('PUT')



            <label class="mb-2 block text-sm font-medium">

                Alasan Penolakan

            </label>



            <textarea
                name="rejection_reason"
                rows="4"
                required
                class="w-full rounded-lg border border-gray-300 p-3"
                placeholder="Masukkan alasan penolakan..."></textarea>




            <div class="mt-5 flex justify-end gap-3">


                <button
                    type="button"
                    onclick="closeRejectModal()"
                    class="rounded-lg bg-gray-500 px-4 py-2 text-white">


                    Batal


                </button>




                <button
                    class="rounded-lg bg-red-600 px-4 py-2 text-white">


                    Reject


                </button>



            </div>



        </form>


    </div>


</div>






<script>


function openRejectModal(id)
{

    document
        .getElementById('rejectModal')
        .classList
        .remove('hidden');


    document
        .getElementById('rejectModal')
        .classList
        .add('flex');



    document
        .getElementById('rejectForm')
        .action =
        '/stock_transactions/' + id + '/reject';

}




function closeRejectModal()
{

    document
        .getElementById('rejectModal')
        .classList
        .add('hidden');


    document
        .getElementById('rejectModal')
        .classList
        .remove('flex');

}


</script>


@endsection