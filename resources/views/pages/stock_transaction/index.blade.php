@extends('layouts.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
<div class="mb-8 flex flex-col gap-5 md:flex-row md:items-center md:justify-between">


    <div>


        <h1 class="text-3xl font-bold text-gray-800">

            Stock Transaction

        </h1>



        <p class="mt-2 text-sm text-gray-500">

            Monitoring seluruh transaksi stok barang.

        </p>



        <p class="mt-4 text-xl font-bold text-gray-500">

            Total Transaksi :

            <span class="font-bold text-xl text-blue-600">

                {{ $totalTransaction }}

            </span>


        </p>



    </div>





    <div class="flex flex-col gap-3 md:items-end">



        {{-- Search --}}

        <form
            method="GET"
            class="flex items-center gap-2">


            @if(request('status'))

                <input
                    type="hidden"
                    name="status"
                    value="{{ request('status') }}">

            @endif



            @if(request('type'))

                <input
                    type="hidden"
                    name="type"
                    value="{{ request('type') }}">

            @endif



            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari produk atau user..."
                class="w-80 rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">



            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-700">


                Cari


            </button>


        </form>





        {{-- Tambah Manager --}}

        @if(auth()->user()->role == 'manager')


            <a href="{{ route('stock_transactions.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">


                + Tambah Transaksi


            </a>


        @endif



    </div>



</div>



    {{-- Alert --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif




        {{-- Status Filter Cards --}}
<div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-4">



    {{-- Pending --}}
    <a
        href="{{ request('status') == 'Pending'
            ? route('stock_transactions.index', request()->except('status'))
            : route('stock_transactions.index', array_merge(request()->all(), ['status'=>'Pending']))
        }}"

        class="rounded-xl border p-6 transition-all

        {{ request('status') == 'Pending'
            ? 'border-yellow-500 bg-yellow-50 shadow-lg'
            : 'border-gray-200 bg-white hover:-translate-y-1 hover:shadow-lg'
        }}">


        <div class="flex justify-between">


            <div>

                <p class="text-sm text-gray-500">

                    Pending

                </p>


                <h2 class="mt-2 text-4xl font-bold text-yellow-500">

                    {{ $totalPending }}

                </h2>


            </div>


            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-yellow-100 text-2xl">

                ⏳

            </div>


        </div>


    </a>





    {{-- Completed --}}
    <a
        href="{{ request('status') == 'Completed'
            ? route('stock_transactions.index', request()->except('status'))
            : route('stock_transactions.index', array_merge(request()->all(), ['status'=>'Completed']))
        }}"

        class="rounded-xl border p-6 transition-all

        {{ request('status') == 'Completed'
            ? 'border-green-500 bg-green-50 shadow-lg'
            : 'border-gray-200 bg-white hover:-translate-y-1 hover:shadow-lg'
        }}">


        <div class="flex justify-between">


            <div>

                <p class="text-sm text-gray-500">

                    Completed

                </p>


                <h2 class="mt-2 text-4xl font-bold text-green-600">

                    {{ $totalCompleted }}

                </h2>


            </div>


            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-green-100 text-2xl">

                ✅

            </div>


        </div>


    </a>







    {{-- Rejected --}}
    <a
        href="{{ request('status') == 'Rejected'
            ? route('stock_transactions.index', request()->except('status'))
            : route('stock_transactions.index', array_merge(request()->all(), ['status'=>'Rejected']))
        }}"

        class="rounded-xl border p-6 transition-all

        {{ request('status') == 'Rejected'
            ? 'border-red-500 bg-red-50 shadow-lg'
            : 'border-gray-200 bg-white hover:-translate-y-1 hover:shadow-lg'
        }}">


        <div class="flex justify-between">


            <div>

                <p class="text-sm text-gray-500">

                    Rejected

                </p>


                <h2 class="mt-2 text-4xl font-bold text-red-600">

                    {{ $totalRejected }}

                </h2>


            </div>


            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100 text-2xl">

                ❌

            </div>


        </div>


    </a>







    {{-- Cancelled --}}
    <a
        href="{{ request('status') == 'Cancelled'
            ? route('stock_transactions.index', request()->except('status'))
            : route('stock_transactions.index', array_merge(request()->all(), ['status'=>'Cancelled']))
        }}"

        class="rounded-xl border p-6 transition-all

        {{ request('status') == 'Cancelled'
            ? 'border-gray-500 bg-gray-100 shadow-lg'
            : 'border-gray-200 bg-white hover:-translate-y-1 hover:shadow-lg'
        }}">


        <div class="flex justify-between">


            <div>

                <p class="text-sm text-gray-500">

                    Cancelled

                </p>


                <h2 class="mt-2 text-4xl font-bold text-gray-600">

                    {{ $totalCancelled }}

                </h2>


            </div>


            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-2xl">

                🚫

            </div>


        </div>


    </a>



</div>





    {{-- Additional Filter --}}
<form
    method="GET"
    class="mb-6 rounded-xl border border-gray-200 bg-white p-5 shadow-sm">


    {{-- Preserve Search --}}
    @if(request('search'))

        <input
            type="hidden"
            name="search"
            value="{{ request('search') }}">

    @endif



    {{-- Preserve Status --}}
    @if(request('status'))

        <input
            type="hidden"
            name="status"
            value="{{ request('status') }}">

    @endif




    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">



        {{-- Type --}}
        <div>


            <label class="mb-2 block text-sm font-medium text-gray-700">

                Jenis Transaksi

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

                Tanggal Mulai

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


            Terapkan Filter


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

    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
        Rejected
    </span>





                            @elseif($transaction->status == 'Cancelled')


                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">

                                    Cancelled

                                </span>


                            @endif


                        </td>






                        {{-- Confirmed By --}}

                        







                        {{-- Date --}}

                        <td class="px-6 py-4 text-center whitespace-nowrap">


                            {{ $transaction->transaction_date->format('d M Y') }}


                            <br>


                            <span class="text-xs text-gray-500">

                                {{ $transaction->transaction_date->format('H:i') }}

                            </span>


                        </td>







                        {{-- Action --}}

    <td class="px-6 py-4">

    <div class="flex items-center justify-start gap-2">

        {{-- Detail --}}
        <a
            href="{{ route('stock_transactions.show',$transaction->id) }}"
            class="w-20 rounded-lg bg-blue-600 px-3 py-2 text-center text-xs font-medium text-white hover:bg-blue-700">

            Detail

        </a>

        {{-- Manager --}}
        @if(
            auth()->user()->role == 'manager'
            &&
            $transaction->status == 'Pending'
            &&
            $transaction->user_id == auth()->id()
        )

            <form
                action="{{ route('stock_transactions.cancel',$transaction->id) }}"
                method="POST">

                @csrf
                @method('PATCH')

                <button
                    onclick="return confirm('Batalkan transaksi ini?')"
                    class="w-20 rounded-lg bg-red-600 px-3 py-2 text-xs font-medium text-white hover:bg-red-700">

                    Cancel

                </button>

            </form>

        {{-- Staff --}}
        @elseif(
            auth()->user()->role == 'staff'
            &&
            $transaction->status == 'Pending'
        )

            <form
                action="{{ route('stock_transactions.confirm',$transaction->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <button
                    onclick="return confirm('Konfirmasi transaksi ini?')"
                    class="w-20 rounded-lg bg-green-600 px-3 py-2 text-xs font-medium text-white hover:bg-green-700">

                    Confirm

                </button>

            </form>

            <button
                type="button"
                onclick="openRejectModal({{ $transaction->id }})"
                class="w-20 rounded-lg bg-red-600 px-3 py-2 text-xs font-medium text-white hover:bg-red-700">

                Reject

            </button>

        @endif

    </div>

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

        @if($transactions->hasPages())

<div class="border-t border-gray-200 px-6 py-4">

    {{ $transactions->links() }}

</div>

@endif


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