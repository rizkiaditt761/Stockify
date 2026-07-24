@extends('layouts.dashboard')

@section('content')

@php

    $selectedReport = request('report','stock');

@endphp


<div class="p-4">


    {{-- ===================================== --}}
    {{-- HEADER --}}
    {{-- ===================================== --}}


    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">


        <div>


            <h1 class="text-3xl font-bold text-gray-800">

                Manajemen Laporan

            </h1>


            <p class="mt-2 text-sm text-gray-500">

                Kelola laporan stok barang, transaksi, dan aktivitas pengguna.

            </p>


        </div>



        <a
            href="{{ route('reports.export.pdf', request()->all()) }}"
            class="inline-flex items-center justify-center rounded-lg bg-red-600 px-6 py-3 font-medium text-white shadow hover:bg-red-700">


            Export PDF


        </a>


    </div>




    {{-- ===================================== --}}
    {{-- FILTER --}}
    {{-- ===================================== --}}


    <div class="mb-8 rounded-xl border border-gray-200 bg-white shadow-sm">



        <div class="border-b border-gray-100 px-6 py-4">


            <h2 class="text-lg font-semibold text-gray-800">


                Filter Data Laporan


            </h2>


            <p class="mt-1 text-sm text-gray-500">


                Gunakan filter untuk menampilkan data laporan tertentu.


            </p>


        </div>




        <form
            action="{{ route('reports.index') }}"
            method="GET"
            class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2 xl:grid-cols-6">



            {{-- Search --}}


            <div class="xl:col-span-2">


                <label
                    class="mb-2 block text-sm font-medium text-gray-700">


                    Pencarian


                </label>



                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari produk, user, aktivitas..."
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">


            </div>




            {{-- Jenis Report --}}


            <div>


                <label
                    class="mb-2 block text-sm font-medium text-gray-700">


                    Jenis Laporan


                </label>



                <select
                    name="report"
                    class="w-full rounded-lg border-gray-300">


                    <option
                        value="stock"
                        {{ $selectedReport == 'stock' ? 'selected' : '' }}>


                        Stok Produk


                    </option>



                    <option
                        value="transaction"
                        {{ $selectedReport == 'transaction' ? 'selected' : '' }}>


                        Transaksi


                    </option>



                    <option
                        value="activity"
                        {{ $selectedReport == 'activity' ? 'selected' : '' }}>


                        Aktivitas User


                    </option>



                    <option
                        value="all"
                        {{ $selectedReport == 'all' ? 'selected' : '' }}>


                        Semua Laporan


                    </option>


                </select>


            </div>
                        {{-- Jenis Transaksi --}}


            @if($selectedReport == 'transaction' || $selectedReport == 'all')


            <div>


                <label
                    class="mb-2 block text-sm font-medium text-gray-700">


                    Jenis Transaksi


                </label>



                <select
                    name="type"
                    class="w-full rounded-lg border-gray-300">


                    <option
                        value="all">


                        Semua


                    </option>



                    <option
                        value="IN"
                        {{ request('type') == 'IN' ? 'selected' : '' }}>


                        Barang Masuk


                    </option>



                    <option
                        value="OUT"
                        {{ request('type') == 'OUT' ? 'selected' : '' }}>


                        Barang Keluar


                    </option>



                </select>


            </div>


            @endif






            {{-- Kategori --}}


            <div>


                <label
                    class="mb-2 block text-sm font-medium text-gray-700">


                    Kategori


                </label>



                <select
                    name="category_id"
                    class="w-full rounded-lg border-gray-300">


                    <option
                        value="">


                        Semua Kategori


                    </option>



                    @foreach($categories as $category)


                        <option
                            value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>


                            {{ $category->name }}


                        </option>


                    @endforeach


                </select>


            </div>







            {{-- Tanggal Mulai --}}


            <div>


                <label
                    class="mb-2 block text-sm font-medium text-gray-700">


                    Tanggal Mulai


                </label>



                <input
                    type="date"
                    name="start_date"
                    value="{{ request('start_date') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">


            </div>







            {{-- Tanggal Selesai --}}


            <div>


                <label
                    class="mb-2 block text-sm font-medium text-gray-700">


                    Tanggal Selesai


                </label>



                <input
                    type="date"
                    name="end_date"
                    value="{{ request('end_date') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">


            </div>
                        {{-- BUTTON --}}


            <div class="flex flex-wrap items-end gap-3 xl:col-span-6">


                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-2.5 font-medium text-white shadow-sm hover:bg-blue-700">


                    Terapkan Filter


                </button>



                <a
                    href="{{ route('reports.index') }}"
                    class="rounded-lg bg-gray-500 px-6 py-2.5 font-medium text-white shadow-sm hover:bg-gray-600">


                    Reset


                </a>


            </div>



        </form>


    </div>





   {{-- ===================================== --}}
{{-- SUMMARY --}}
{{-- ===================================== --}}


<div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">


    {{-- ================================= --}}
    {{-- STOCK SUMMARY --}}
    {{-- ================================= --}}


    @if($selectedReport == 'stock')


        {{-- Total Product --}}

        <div class="rounded-xl border border-blue-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">


            <p class="text-sm font-medium text-gray-500">

                Total Produk

            </p>


            <h2 class="mt-3 text-4xl font-bold text-blue-600">


                {{ number_format($summary['total_products'] ?? 0) }}


            </h2>


        </div>



        {{-- Total Stock --}}

        <div class="rounded-xl border border-indigo-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">


            <p class="text-sm font-medium text-gray-500">

                Total Stok

            </p>


            <h2 class="mt-3 text-4xl font-bold text-indigo-600">


                {{ number_format($summary['total_stock'] ?? 0) }}


            </h2>


        </div>


    @endif





    {{-- ================================= --}}
    {{-- TRANSACTION SUMMARY --}}
    {{-- ================================= --}}



    @if($selectedReport == 'transaction')



        {{-- Total Transaction --}}


        <div class="rounded-xl border border-blue-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">


            <p class="text-sm font-medium text-gray-500">

                Total Transaksi

            </p>


            <h2 class="mt-3 text-4xl font-bold text-blue-600">


                {{ number_format($summary['total_transaction'] ?? 0) }}


            </h2>


        </div>





        {{-- Barang Masuk --}}


        <div class="rounded-xl border border-green-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">


            <p class="text-sm font-medium text-gray-500">

                Barang Masuk

            </p>


            <h2 class="mt-3 text-4xl font-bold text-green-600">


                {{ number_format($summary['stock_in'] ?? 0) }}


            </h2>


        </div>





        {{-- Barang Keluar --}}


        <div class="rounded-xl border border-red-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">


            <p class="text-sm font-medium text-gray-500">

                Barang Keluar

            </p>


            <h2 class="mt-3 text-4xl font-bold text-red-600">


                {{ number_format($summary['stock_out'] ?? 0) }}


            </h2>


        </div>



    @endif







    {{-- ================================= --}}
    {{-- ACTIVITY SUMMARY --}}
    {{-- ================================= --}}



    @if($selectedReport == 'activity')



        {{-- Total Activity --}}


        <div class="rounded-xl border border-purple-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">


            <p class="text-sm font-medium text-gray-500">

                Total Aktivitas

            </p>


            <h2 class="mt-3 text-4xl font-bold text-purple-600">


                {{ number_format($summary['total_activity'] ?? 0) }}


            </h2>


        </div>





        {{-- Active User --}}


        <div class="rounded-xl border border-yellow-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">


            <p class="text-sm font-medium text-gray-500">

                User Aktif

            </p>


            <h2 class="mt-3 text-4xl font-bold text-yellow-600">


                {{ number_format($summary['total_user'] ?? 0) }}


            </h2>


        </div>



    @endif







    {{-- ================================= --}}
    {{-- ALL REPORT SUMMARY --}}
    {{-- ================================= --}}



    @if($selectedReport == 'all')



        <div class="rounded-xl border border-blue-100 bg-white p-6 shadow-sm">


            <p class="text-sm font-medium text-gray-500">

                Total Produk

            </p>


            <h2 class="mt-3 text-4xl font-bold text-blue-600">

                {{ number_format($summary['total_products'] ?? 0) }}

            </h2>


        </div>




        <div class="rounded-xl border border-green-100 bg-white p-6 shadow-sm">


            <p class="text-sm font-medium text-gray-500">

                Total Transaksi

            </p>


            <h2 class="mt-3 text-4xl font-bold text-green-600">

                {{ number_format($summary['total_transaction'] ?? 0) }}

            </h2>


        </div>




        <div class="rounded-xl border border-purple-100 bg-white p-6 shadow-sm">


            <p class="text-sm font-medium text-gray-500">

                Total Aktivitas

            </p>


            <h2 class="mt-3 text-4xl font-bold text-purple-600">

                {{ number_format($summary['total_activity'] ?? 0) }}

            </h2>


        </div>



    @endif



</div>
    {{-- ===================================== --}}
{{-- LAPORAN STOK BARANG --}}
{{-- ===================================== --}}


@if($selectedReport == 'stock' || $selectedReport == 'all')


<div class="mb-8 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">


    <div class="border-b border-gray-100 px-6 py-5">


        <h2 class="text-xl font-bold text-gray-800">


            Laporan Stok Barang


        </h2>



        <p class="mt-1 text-sm text-gray-500">


            Menampilkan kondisi stok produk berdasarkan filter yang dipilih.


        </p>


    </div>





    <div class="overflow-x-auto">


        <table class="w-full text-sm">


            <thead class="bg-gray-50 text-xs uppercase text-gray-600">


                <tr>


                    <th class="px-6 py-4 text-left">

                        No

                    </th>


                    <th class="px-6 py-4 text-left">

                        Produk

                    </th>


                    <th class="px-6 py-4 text-left">

                        Kategori

                    </th>


                    <th class="px-6 py-4 text-left">

                        Supplier

                    </th>


                    <th class="px-6 py-4 text-center">

                        Stok

                    </th>


                    <th class="px-6 py-4 text-center">

                        Minimum Stok

                    </th>


                    <th class="px-6 py-4 text-center">

                        Status

                    </th>


                </tr>


            </thead>



            <tbody>


                @forelse($products as $product)


                    @php


                        if (!$product->is_active) {


                            $status = 'Tidak Aktif';

                            $statusClass = 'bg-gray-100 text-gray-600';


                        } elseif ($product->stock <= 0) {


                            $status = 'Stok Habis';

                            $statusClass = 'bg-red-100 text-red-700';


                        } elseif ($product->stock <= $product->minimum_stock) {


                            $status = 'Hampir Habis';

                            $statusClass = 'bg-yellow-100 text-yellow-700';


                        } else {


                            $status = 'Aman';

                            $statusClass = 'bg-green-100 text-green-700';


                        }


                    @endphp



                    <tr class="border-t border-gray-100 transition hover:bg-gray-50">


                        {{-- No --}}

                        <td class="px-6 py-4 text-gray-700">


                            {{ $loop->iteration }}


                        </td>




                        {{-- Produk --}}

                        <td class="px-6 py-4">


                            <div class="font-semibold text-gray-800">


                                {{ $product->name }}


                            </div>


                            <div class="mt-1 text-xs text-gray-500">


                                SKU: {{ $product->sku }}


                            </div>


                        </td>




                        {{-- Kategori --}}

                        <td class="px-6 py-4 text-gray-700">


                            {{ $product->category->name ?? '-' }}


                        </td>




                        {{-- Supplier --}}

                        <td class="px-6 py-4 text-gray-700">


                            {{ $product->supplier->name ?? '-' }}


                        </td>




                        {{-- Stok --}}

                        <td class="px-6 py-4 text-center">


                            <span class="font-bold text-gray-800">


                                {{ number_format($product->stock) }}


                            </span>


                        </td>




                        {{-- Minimum Stok --}}

                        <td class="px-6 py-4 text-center text-gray-700">


                            {{ number_format($product->minimum_stock) }}


                        </td>




                        {{-- Status --}}

                        <td class="px-6 py-4 text-center">


                            <span
                                class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">


                                {{ $status }}


                            </span>


                        </td>


                    </tr>



                @empty


                    <tr>


                        <td
                            colspan="7"
                            class="px-6 py-10 text-center text-gray-500">


                            Tidak ada data produk.


                        </td>


                    </tr>


                @endforelse


            </tbody>


        </table>


    </div>


</div>



@endif
{{-- ========================================================= --}}
{{-- LAPORAN BARANG MASUK / KELUAR --}}
{{-- ========================================================= --}}


@if($selectedReport == 'all' || $selectedReport == 'transaction')


<div class="mb-8 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">



    <div class="border-b border-gray-100 px-6 py-5">


        <h2 class="text-xl font-bold text-gray-800">


            Laporan Barang Masuk & Keluar


        </h2>



        <p class="mt-1 text-sm text-gray-500">


            Menampilkan riwayat transaksi stok berdasarkan filter yang dipilih.


        </p>


    </div>





    <div class="overflow-x-auto">


        <table class="w-full text-sm">


            <thead class="bg-gray-50 text-xs uppercase text-gray-600">


                <tr>


                    <th class="px-6 py-4 text-left">

                        No

                    </th>



                    <th class="px-6 py-4 text-left">

                        Produk

                    </th>



                    <th class="px-6 py-4 text-left">

                        User

                    </th>



                    <th class="px-6 py-4 text-center">

                        Tipe

                    </th>



                    <th class="px-6 py-4 text-center">

                        Jumlah

                    </th>



                    <th class="px-6 py-4 text-center">

                        Status

                    </th>



                    <th class="px-6 py-4 text-center">

                        Tanggal

                    </th>


                </tr>


            </thead>




            <tbody>



                @forelse($transactions as $transaction)



                    <tr class="border-t border-gray-100 transition hover:bg-gray-50">



                        {{-- No --}}


                        <td class="px-6 py-4">


                            {{ $loop->iteration }}


                        </td>





                        {{-- Produk --}}


                        <td class="px-6 py-4">


                            <div class="font-semibold text-gray-800">


                                {{ $transaction->product->name ?? '-' }}


                            </div>



                            <div class="text-xs text-gray-500">


                                SKU:
                                {{ $transaction->product->sku ?? '-' }}


                            </div>


                        </td>






                        {{-- User --}}


                        <td class="px-6 py-4 text-gray-700">


                            <div class="font-medium">


                                {{ $transaction->user->name ?? '-' }}


                            </div>



                            <div class="text-xs text-gray-500">


                                {{ ucfirst($transaction->user->role ?? '-') }}


                            </div>


                        </td>






                        {{-- Type --}}


                        <td class="px-6 py-4 text-center">



                            @if($transaction->type == 'IN')



                                <span
                                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">


                                    Masuk


                                </span>



                            @else



                                <span
                                    class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">


                                    Keluar


                                </span>



                            @endif



                        </td>







                        {{-- Quantity --}}


                        <td class="px-6 py-4 text-center font-semibold">


                            {{ number_format($transaction->quantity) }}


                        </td>







                        {{-- Status --}}


                        <td class="px-6 py-4 text-center">



                            @if($transaction->status == 'confirmed')



                                <span
                                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">


                                    Dikonfirmasi


                                </span>



                            @elseif($transaction->status == 'pending')



                                <span
                                    class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">


                                    Menunggu


                                </span>



                            @else



                                <span
                                    class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">


                                    Ditolak


                                </span>



                            @endif



                        </td>








                        {{-- Tanggal --}}


                        <td class="px-6 py-4 text-center text-gray-600">


                            {{ optional($transaction->transaction_date)->format('d M Y') }}


                        </td>




                    </tr>




                @empty



                    <tr>


                        <td
                            colspan="7"
                            class="px-6 py-10 text-center text-gray-500">


                            Belum ada transaksi.


                        </td>


                    </tr>



                @endforelse



            </tbody>



        </table>


    </div>


</div>



@endif
{{-- ========================================================= --}}
{{-- AKTIVITAS USER --}}
{{-- ========================================================= --}}


@if($selectedReport == 'all' || $selectedReport == 'activity')



<div class="mb-8 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">



    <div class="border-b border-gray-100 px-6 py-5">



        <h2 class="text-xl font-bold text-gray-800">


            Aktivitas Pengguna


        </h2>



        <p class="mt-1 text-sm text-gray-500">


            Menampilkan riwayat aktivitas pengguna dalam sistem.


        </p>



    </div>






    <div class="overflow-x-auto">



        <table class="w-full text-sm">



            <thead class="bg-gray-50 text-xs uppercase text-gray-600">



                <tr>



                    <th class="px-6 py-4 text-left">

                        No

                    </th>



                    <th class="px-6 py-4 text-left">

                        User

                    </th>



                    <th class="px-6 py-4 text-center">

                        Role

                    </th>



                    <th class="px-6 py-4 text-left">

                        Aktivitas

                    </th>



                    <th class="px-6 py-4 text-center">

                        Waktu

                    </th>



                </tr>



            </thead>






            <tbody>




                @forelse($activities as $activity)





                    <tr class="border-t border-gray-100 transition hover:bg-gray-50">






                        {{-- No --}}


                        <td class="px-6 py-4">


                            {{ $loop->iteration }}


                        </td>








                        {{-- User --}}


                        <td class="px-6 py-4">



                            <div class="font-semibold text-gray-800">


                                {{ $activity->user->name ?? '-' }}


                            </div>



                            <div class="text-xs text-gray-500">


                                {{ $activity->user->email ?? '-' }}


                            </div>



                        </td>








                        {{-- Role --}}



                        <td class="px-6 py-4 text-center">



                            @php


                                $roleClass = match($activity->user->role ?? '') {


                                    'admin' => 'bg-purple-100 text-purple-700',


                                    'manager' => 'bg-blue-100 text-blue-700',


                                    'staff' => 'bg-green-100 text-green-700',


                                    default => 'bg-gray-100 text-gray-600',


                                };


                            @endphp





                            <span
                                class="rounded-full px-3 py-1 text-xs font-semibold {{ $roleClass }}">



                                {{ ucfirst($activity->user->role ?? '-') }}



                            </span>



                        </td>









                        {{-- Activity --}}



                        <td class="px-6 py-4 text-gray-700">



                            <div class="font-medium">


                                {{ $activity->module ?? '-' }}


                            </div>



                            <div class="text-sm text-gray-500">


                                {{ $activity->description ?? '-' }}


                            </div>



                        </td>









                        {{-- Time --}}



                        <td class="px-6 py-4 text-center text-gray-600">



                            {{ optional($activity->created_at)->format('d M Y H:i') }}



                        </td>





                    </tr>





                @empty





                    <tr>



                        <td
                            colspan="5"
                            class="px-6 py-10 text-center text-gray-500">



                            Belum ada aktivitas pengguna.



                        </td>



                    </tr>





                @endforelse





            </tbody>




        </table>




    </div>



</div>




@endif
{{-- ========================================================= --}}
{{-- END REPORT CONTENT --}}
{{-- ========================================================= --}}


</div>


@endsection