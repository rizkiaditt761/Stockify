@extends('layouts.dashboard')

@section('content')


{{-- ===================================================== --}}
{{-- HEADER --}}
{{-- ===================================================== --}}

<div class="mb-8 rounded-3xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-8 text-white shadow-xl">

    <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">


        <div>

            <div class="flex items-center gap-3">

                <h1 class="text-3xl font-bold">
                    Dashboard
                </h1>


                <span class="rounded-full bg-white/20 px-4 py-1 text-sm font-semibold backdrop-blur">

                    {{ ucfirst(auth()->user()->role) }}

                </span>

            </div>


            <p class="mt-3 text-blue-100">

                Monitor warehouse activity, stock movement, and inventory performance.

            </p>


        </div>



        <div class="rounded-2xl bg-white/10 px-6 py-4 backdrop-blur">


            <p class="text-sm text-blue-100">
                Today
            </p>


            <h2 class="mt-1 text-xl font-bold">

                {{ now()->format('d F Y') }}

            </h2>


        </div>


    </div>


</div>





{{-- ===================================================== --}}
{{-- STATISTIC CARD --}}
{{-- ===================================================== --}}



<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">



@if(auth()->user()->role == 'admin')



    {{-- TOTAL PRODUCT --}}

    <div class="group rounded-3xl border border-blue-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">


        <div class="flex items-start justify-between">


            <div>

                <p class="text-sm text-gray-500">
                    Total Produk
                </p>


                <h2 class="mt-3 text-4xl font-bold text-gray-800">

                    {{ $totalProducts }}

                </h2>


                <p class="mt-2 text-sm font-medium text-blue-600">

                    Produk tersedia

                </p>


            </div>


            <div class="rounded-2xl bg-blue-100 p-4 text-3xl">

                📦

            </div>


        </div>


    </div>




    {{-- CATEGORY --}}

    <div class="group rounded-3xl border border-green-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">


        <div class="flex items-start justify-between">


            <div>

                <p class="text-sm text-gray-500">
                    Kategori
                </p>


                <h2 class="mt-3 text-4xl font-bold text-gray-800">

                    {{ $totalCategories }}

                </h2>


                <p class="mt-2 text-sm font-medium text-green-600">

                    Jenis produk

                </p>


            </div>


            <div class="rounded-2xl bg-green-100 p-4 text-3xl">

                🗂️

            </div>


        </div>


    </div>




    {{-- SUPPLIER --}}

    <div class="group rounded-3xl border border-yellow-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">


        <div class="flex items-start justify-between">


            <div>

                <p class="text-sm text-gray-500">
                    Supplier
                </p>


                <h2 class="mt-3 text-4xl font-bold text-gray-800">

                    {{ $totalSuppliers }}

                </h2>


                <p class="mt-2 text-sm font-medium text-yellow-600">

                    Supplier aktif

                </p>


            </div>


            <div class="rounded-2xl bg-yellow-100 p-4 text-3xl">

                🚚

            </div>


        </div>


    </div>




    {{-- TRANSACTION --}}

    <div class="group rounded-3xl border border-purple-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">


        <div class="flex items-start justify-between">


            <div>

                <p class="text-sm text-gray-500">
                    Transaksi
                </p>


                <h2 class="mt-3 text-4xl font-bold text-gray-800">

                    {{ $totalTransactions }}

                </h2>


                <p class="mt-2 text-sm font-medium text-purple-600">

                    Aktivitas gudang

                </p>


            </div>


            <div class="rounded-2xl bg-purple-100 p-4 text-3xl">

                📊

            </div>


        </div>


    </div>




@elseif(auth()->user()->role == 'manager')



    {{-- MANAGER CARD --}}


    <div class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">


        <p class="text-sm text-gray-500">
            Total Produk
        </p>


        <h2 class="mt-3 text-4xl font-bold text-blue-600">

            {{ $totalProducts }}

        </h2>


        <p class="mt-2 text-sm text-gray-500">
            Produk gudang
        </p>


    </div>




    <div class="rounded-3xl border border-yellow-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">


        <p class="text-sm text-gray-500">
            Pending
        </p>


        <h2 class="mt-3 text-4xl font-bold text-yellow-500">

            {{ $pendingTransactions }}

        </h2>


        <p class="mt-2 text-sm text-gray-500">
            Menunggu approval
        </p>


    </div>




    <div class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">


        <p class="text-sm text-gray-500">
            Stock Masuk Hari Ini
        </p>


        <h2 class="mt-3 text-4xl font-bold text-green-600">

            {{ $todayStockIn }}

        </h2>


        <p class="mt-2 text-sm text-gray-500">
            Quantity masuk
        </p>


    </div>




    <div class="rounded-3xl border border-red-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">


        <p class="text-sm text-gray-500">
            Stock Keluar Hari Ini
        </p>


        <h2 class="mt-3 text-4xl font-bold text-red-600">

            {{ $todayStockOut }}

        </h2>


        <p class="mt-2 text-sm text-gray-500">
            Quantity keluar
        </p>


    </div>




@else



    {{-- STAFF CARD --}}


    <div class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">


        <p class="text-sm text-gray-500">
            Total Produk
        </p>


        <h2 class="mt-3 text-4xl font-bold text-blue-600">

            {{ $totalProducts }}

        </h2>


    </div>



    <div class="rounded-3xl border border-yellow-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">


        <p class="text-sm text-gray-500">
            Pending
        </p>


        <h2 class="mt-3 text-4xl font-bold text-yellow-500">

            {{ $pendingTransactions }}

        </h2>


    </div>



    <div class="rounded-3xl border border-red-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">


        <p class="text-sm text-gray-500">
            Rejected
        </p>


        <h2 class="mt-3 text-4xl font-bold text-red-600">

            {{ $rejectedTransactions }}

        </h2>


    </div>



    <div class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">


        <p class="text-sm text-gray-500">
            Input Hari Ini
        </p>


        <h2 class="mt-3 text-4xl font-bold text-green-600">

            {{ $todayInput }}

        </h2>


    </div>



@endif



</div>
{{-- ===================================================== --}}
{{-- QUICK ACTION --}}
{{-- ===================================================== --}}

<div class="grid gap-6 lg:grid-cols-3 mt-8">


    {{-- =====================================================
        ADMIN
    ====================================================== --}}

    @if(auth()->user()->role == 'admin')


        {{-- Tambah Produk --}}
        <a href="{{ route('products.create') }}"
            class="group relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-700 p-7 text-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">


            <div class="flex items-center justify-between">


                <div>

                    <h3 class="text-xl font-bold">
                        Tambah Produk
                    </h3>


                    <p class="mt-2 text-sm text-blue-100">
                        Tambahkan produk baru ke gudang.
                    </p>


                </div>


                <div class="rounded-2xl bg-white/20 p-4 transition duration-300 group-hover:scale-110">


                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"/>

                    </svg>


                </div>


            </div>


            <div class="mt-6 text-sm font-semibold text-blue-100">
                Buat produk baru →
            </div>


        </a>




        {{-- Kelola User --}}
        <a href="{{ route('users.index') }}"
            class="group relative overflow-hidden rounded-3xl bg-gradient-to-r from-green-600 to-emerald-700 p-7 text-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">


            <div class="flex items-center justify-between">


                <div>

                    <h3 class="text-xl font-bold">
                        Kelola User
                    </h3>


                    <p class="mt-2 text-sm text-green-100">
                        Atur akun pengguna sistem.
                    </p>


                </div>


                <div class="rounded-2xl bg-white/20 p-4 transition duration-300 group-hover:scale-110">


                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/>

                    </svg>


                </div>


            </div>


            <div class="mt-6 text-sm font-semibold text-green-100">
                Manajemen user →
            </div>


        </a>





        {{-- Report --}}
        <a href="{{ route('reports.index') }}"
            class="group relative overflow-hidden rounded-3xl bg-gradient-to-r from-purple-600 to-violet-700 p-7 text-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">


            <div class="flex items-center justify-between">


                <div>

                    <h3 class="text-xl font-bold">
                        Laporan
                    </h3>


                    <p class="mt-2 text-sm text-purple-100">
                        Analisis aktivitas warehouse.
                    </p>


                </div>


                <div class="rounded-2xl bg-white/20 p-4 transition duration-300 group-hover:scale-110">


                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 3v18m4-12v12m4-8v8M7 8v13"/>

                    </svg>


                </div>


            </div>


            <div class="mt-6 text-sm font-semibold text-purple-100">
                Lihat laporan →
            </div>


        </a>





    {{-- =====================================================
        MANAGER
    ====================================================== --}}

    @elseif(auth()->user()->role == 'manager')



        {{-- Transaksi --}}
        <a href="{{ route('stock_transactions.create') }}"
            class="group rounded-3xl bg-gradient-to-r from-green-600 to-emerald-700 p-7 text-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">


            <div class="flex justify-between items-center">


                <div>

                    <h3 class="text-xl font-bold">
                        Transaksi Baru
                    </h3>


                    <p class="mt-2 text-sm text-green-100">
                        Catat transaksi stok.
                    </p>


                </div>


                <div class="rounded-2xl bg-white/20 p-4 transition group-hover:scale-110">


                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5h6m-6 4h6m-9 4h12m-12 4h12"/>

                    </svg>


                </div>


            </div>


            <div class="mt-6 text-sm font-semibold text-green-100">
                Input transaksi →
            </div>


        </a>



        {{-- Monitoring --}}
        <a href="{{ route('stock.monitoring.index') }}"
            class="group rounded-3xl bg-gradient-to-r from-blue-600 to-cyan-700 p-7 text-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">


            <h3 class="text-xl font-bold">
                Monitoring Stok
            </h3>


            <p class="mt-2 text-sm text-blue-100">
                Pantau kondisi stok gudang.
            </p>


            <div class="mt-6 text-sm font-semibold text-blue-100">
                Cek stok →
            </div>


        </a>




        {{-- Report --}}
        <a href="{{ route('reports.index') }}"
            class="group rounded-3xl bg-gradient-to-r from-purple-600 to-violet-700 p-7 text-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">


            <h3 class="text-xl font-bold">
                Laporan
            </h3>


            <p class="mt-2 text-sm text-purple-100">
                Analisis aktivitas gudang.
            </p>


            <div class="mt-6 text-sm font-semibold text-purple-100">
                Lihat laporan →
            </div>


        </a>





    {{-- =====================================================
        STAFF
    ====================================================== --}}

    @else



        {{-- Input Transaksi --}}
        <a href="{{ route('stock_transactions.create') }}"
            class="group rounded-3xl bg-gradient-to-r from-orange-500 to-red-500 p-7 text-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">


            <h3 class="text-xl font-bold">
                Input Transaksi
            </h3>


            <p class="mt-2 text-sm text-orange-100">
                Catat stok masuk dan keluar.
            </p>


            <div class="mt-6 text-sm font-semibold text-orange-100">
                Mulai input →
            </div>


        </a>



        {{-- Monitoring --}}
        <a href="{{ route('stock.monitoring.index') }}"
            class="group rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-700 p-7 text-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">


            <h3 class="text-xl font-bold">
                Monitoring Stok
            </h3>


            <p class="mt-2 text-sm text-blue-100">
                Cek kondisi stok.
            </p>


            <div class="mt-6 text-sm font-semibold text-blue-100">
                Monitoring →
            </div>


        </a>




        {{-- Stock Opname --}}
        <a href="{{ route('stock.opname.index') }}"
            class="group rounded-3xl bg-gradient-to-r from-purple-600 to-pink-700 p-7 text-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">


            <h3 class="text-xl font-bold">
                Stock Opname
            </h3>


            <p class="mt-2 text-sm text-purple-100">
                Cek stok fisik gudang.
            </p>


            <div class="mt-6 text-sm font-semibold text-purple-100">
                Mulai opname →
            </div>


        </a>



    @endif


</div>
{{-- ===================================================== --}}
{{-- STOCK MOVEMENT CHART --}}
{{-- ===================================================== --}}

<div class="mt-10 rounded-3xl border border-gray-100 bg-white shadow-sm">


    {{-- HEADER --}}

    <div class="flex flex-col gap-3 border-b px-6 py-5 md:flex-row md:items-center md:justify-between">


        <div>


            <div class="flex items-center gap-3">


                <h2 class="text-xl font-bold text-gray-800">

                    Stock Movement

                </h2>


                <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-600">

                    Last 7 Days

                </span>


            </div>


            <p class="mt-2 text-sm text-gray-500">

                Monitoring pergerakan stok masuk dan keluar gudang.

            </p>


        </div>



        <div class="flex items-center gap-2 text-sm text-gray-400">


            <span class="flex items-center gap-2">

                <span class="h-2.5 w-2.5 rounded-full bg-blue-600"></span>

                Stock In

            </span>



            <span class="flex items-center gap-2">


                <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>

                Stock Out


            </span>


        </div>


    </div>




    {{-- CHART AREA --}}


    <div class="p-6">


        <div class="relative h-[350px] w-full">


            <canvas id="transactionChart"></canvas>


        </div>


    </div>



</div>
{{-- ===================================================== --}}
{{-- LOW STOCK & LATEST PRODUCT --}}
{{-- ===================================================== --}}

<div class="mt-10 grid gap-6 lg:grid-cols-2">



{{-- ===================================================== --}}
{{-- LOW STOCK ALERT --}}
{{-- ===================================================== --}}

<div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">


    <div class="flex items-center justify-between border-b px-6 py-5">


        <div>

            <h2 class="text-xl font-bold text-gray-800">

                Low Stock Alert

            </h2>


            <p class="mt-1 text-sm text-gray-500">

                Produk yang membutuhkan perhatian.

            </p>


        </div>


        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-600">

            Warning

        </span>


    </div>



    <div class="divide-y">


        @forelse($lowStocks as $product)


            <div class="flex items-center justify-between px-6 py-5 transition hover:bg-gray-50">


                <div>


                    <h3 class="font-semibold text-gray-800">

                        {{ $product->name }}

                    </h3>


                    <p class="mt-1 text-sm text-gray-500">

                        {{ $product->category->name ?? 'No Category' }}

                    </p>


                </div>



                <div class="text-right">


                    <span class="inline-flex rounded-full bg-red-100 px-4 py-1 text-sm font-bold text-red-700">

                        {{ $product->stock }} pcs

                    </span>


                    <p class="mt-1 text-xs text-gray-400">

                        Remaining

                    </p>


                </div>


            </div>


        @empty


            <div class="px-6 py-14 text-center">


                <div class="text-5xl">

                    🎉

                </div>


                <p class="mt-3 font-semibold text-green-600">

                    Semua stok aman

                </p>


                <p class="mt-1 text-sm text-gray-400">

                    Tidak ada produk dengan stok rendah.

                </p>


            </div>


        @endforelse


    </div>


</div>





{{-- ===================================================== --}}
{{-- LATEST PRODUCT --}}
{{-- ===================================================== --}}

<div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">


    <div class="flex items-center justify-between border-b px-6 py-5">


        <div>


            <h2 class="text-xl font-bold text-gray-800">

                Produk Terbaru

            </h2>


            <p class="mt-1 text-sm text-gray-500">

                Produk terakhir ditambahkan.

            </p>


        </div>


        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-600">

            Latest

        </span>


    </div>





    <div class="overflow-x-auto">


        <table class="w-full">


            <thead class="bg-gray-50">


                <tr>


                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">

                        Produk

                    </th>


                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">

                        Kategori

                    </th>


                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">

                        Stok

                    </th>


                </tr>


            </thead>




            <tbody class="divide-y">


                @forelse($latestProducts as $product)


                    <tr class="transition hover:bg-gray-50">


                        <td class="px-6 py-4">


                            <div class="font-semibold text-gray-800">

                                {{ $product->name }}

                            </div>


                            <div class="text-xs text-gray-400">

                                {{ $product->sku }}

                            </div>


                        </td>




                        <td class="px-6 py-4 text-sm text-gray-500">


                            {{ $product->category->name ?? '-' }}


                        </td>





                        <td class="px-6 py-4">


                            @if($product->stock <= 5)


                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">

                                    {{ $product->stock }}

                                </span>


                            @else


                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">

                                    {{ $product->stock }}

                                </span>


                            @endif


                        </td>


                    </tr>


                @empty


                    <tr>


                        <td colspan="3"
                            class="px-6 py-10 text-center text-gray-400">


                            Belum ada produk.


                        </td>


                    </tr>


                @endforelse


            </tbody>


        </table>


    </div>


</div>



</div>
{{-- ===================================================== --}}
{{-- RECENT TRANSACTION --}}
{{-- ===================================================== --}}

<div class="mt-10 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">


    <div class="flex flex-col gap-3 border-b px-6 py-5 md:flex-row md:items-center md:justify-between">


        <div>


            <h2 class="text-xl font-bold text-gray-800">

                Recent Transaction

            </h2>


            <p class="mt-1 text-sm text-gray-500">

                Aktivitas transaksi gudang terbaru.

            </p>


        </div>



        <a href="{{ route('stock_transactions.index') }}"
            class="text-sm font-semibold text-blue-600 hover:underline">


            Lihat Semua →

        </a>


    </div>




    <div class="overflow-x-auto">


        <table class="w-full">


            <thead class="bg-gray-50">


                <tr>


                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">

                        Produk

                    </th>


                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">

                        Type

                    </th>


                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">

                        Qty

                    </th>


                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">

                        User

                    </th>


                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">

                        Status

                    </th>


                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">

                        Date

                    </th>


                </tr>


            </thead>




            <tbody class="divide-y">


                @forelse($recentTransactions as $transaction)


                    <tr class="transition hover:bg-gray-50">


                        <td class="px-6 py-4">


                            <div class="font-semibold text-gray-800">

                                {{ $transaction->product->name ?? '-' }}

                            </div>


                        </td>




                        <td class="px-6 py-4">


                            @if(strtoupper($transaction->type) == 'IN')


                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">

                                    Stock IN

                                </span>


                            @else


                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">

                                    Stock OUT

                                </span>


                            @endif


                        </td>





                        <td class="px-6 py-4 font-semibold text-gray-700">


                            {{ $transaction->quantity }}


                        </td>





                        <td class="px-6 py-4 text-sm text-gray-600">


                            {{ $transaction->user->name ?? '-' }}


                        </td>





                        <td class="px-6 py-4">


                            @if($transaction->status == 'Completed')


                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">

                                    Completed

                                </span>


                            @elseif($transaction->status == 'Pending')


                                <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold text-yellow-700">

                                    Pending

                                </span>


                            @else


                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">

                                    {{ $transaction->status }}

                                </span>


                            @endif


                        </td>





                        <td class="px-6 py-4 text-sm text-gray-500">


                            {{ $transaction->created_at->format('d M Y H:i') }}


                        </td>



                    </tr>


                @empty


                    <tr>


                        <td colspan="6"
                            class="px-6 py-12 text-center text-gray-400">


                            Belum ada transaksi.


                        </td>


                    </tr>


                @endforelse


            </tbody>


        </table>


    </div>


</div>





{{-- ===================================================== --}}
{{-- CHART SCRIPT --}}
{{-- ===================================================== --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


const chartData = @json($transactionChart);



const labels = chartData.map(item => {


    return new Date(item.date).toLocaleDateString('id-ID', {


        day: 'numeric',

        month: 'short'


    });


});



const stockIn = chartData.map(item => Number(item.total_in));


const stockOut = chartData.map(item => Number(item.total_out));





new Chart(document.getElementById('transactionChart'), {


    type: 'line',



    data: {


        labels: labels,



        datasets: [



            {


                label: 'Stock In',


                data: stockIn,


                borderColor: '#2563eb',


                backgroundColor: 'rgba(37,99,235,0.12)',


                fill: true,


                tension: 0.4,


                borderWidth: 3,


                pointRadius: 4


            },




            {


                label: 'Stock Out',


                data: stockOut,


                borderColor: '#ef4444',


                backgroundColor: 'rgba(239,68,68,0.12)',


                fill: true,


                tension: 0.4,


                borderWidth: 3,


                pointRadius: 4


            }



        ]


    },



    options: {


        responsive: true,


        maintainAspectRatio: false,



        interaction: {


            mode: 'index',


            intersect: false


        },



        plugins: {


            legend: {


                position: 'top',



                labels: {


                    usePointStyle: true,


                    padding: 20


                }


            }


        },



        scales: {


            y: {


                beginAtZero: true,


                ticks: {


                    precision: 0


                }


            },



            x: {


                grid: {


                    display: false


                }


            }



        }



    }



});



</script>



@endsection