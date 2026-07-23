@extends('layouts.dashboard')

@section('content')

<div class="space-y-6">

    {{-- ===================================================== --}}
    {{-- Header --}}
    {{-- ===================================================== --}}

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Dashboard
            </h1>

            <p class="text-gray-500 mt-1">

                Selamat datang,
                <span class="font-semibold">
                    {{ auth()->user()->name }}
                </span>

                sebagai

                <span class="font-semibold text-blue-600 capitalize">
                    {{ auth()->user()->role }}
                </span>

            </p>

        </div>

        <div class="text-right">

            <p class="text-sm text-gray-500">

                {{ now()->format('l') }}

            </p>

            <h3 class="text-xl font-bold">

                {{ now()->format('d F Y') }}

            </h3>

        </div>

    </div>



    {{-- ===================================================== --}}
    {{-- ADMIN CARD --}}
    {{-- ===================================================== --}}

    @if(auth()->user()->role == 'admin')

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        {{-- Product --}}
        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Total Product

            </p>

            <h2 class="text-4xl font-bold mt-2 text-blue-600">

                {{ $totalProducts }}

            </h2>

        </div>



        {{-- Category --}}
        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Categories

            </p>

            <h2 class="text-4xl font-bold mt-2 text-green-600">

                {{ $totalCategories }}

            </h2>

        </div>



        {{-- Supplier --}}
        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Suppliers

            </p>

            <h2 class="text-4xl font-bold mt-2 text-purple-600">

                {{ $totalSuppliers }}

            </h2>

        </div>



        {{-- Transaction --}}
        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Transactions

            </p>

            <h2 class="text-4xl font-bold mt-2 text-orange-600">

                {{ $totalTransactions }}

            </h2>

        </div>

    </div>

    @endif



    {{-- ===================================================== --}}
    {{-- MANAGER CARD --}}
    {{-- ===================================================== --}}

    @if(auth()->user()->role == 'manager')

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Total Product

            </p>

            <h2 class="text-4xl font-bold mt-2 text-blue-600">

                {{ $totalProducts }}

            </h2>

        </div>



        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Transactions

            </p>

            <h2 class="text-4xl font-bold mt-2 text-orange-600">

                {{ $totalTransactions }}

            </h2>

        </div>



        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Pending

            </p>

            <h2 class="text-4xl font-bold mt-2 text-yellow-600">

                {{ $pendingTransactions }}

            </h2>

        </div>



        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Completed

            </p>

            <h2 class="text-4xl font-bold mt-2 text-green-600">

                {{ $completedTransactions }}

            </h2>

        </div>

    </div>

    @endif



    {{-- ===================================================== --}}
    {{-- STAFF CARD --}}
    {{-- ===================================================== --}}

    @if(auth()->user()->role == 'staff')

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Total Product

            </p>

            <h2 class="text-4xl font-bold mt-2 text-blue-600">

                {{ $totalProducts }}

            </h2>

        </div>



        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Pending

            </p>

            <h2 class="text-4xl font-bold mt-2 text-yellow-600">

                {{ $pendingTransactions }}

            </h2>

        </div>



        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Rejected

            </p>

            <h2 class="text-4xl font-bold mt-2 text-red-600">

                {{ $rejectedTransactions }}

            </h2>

        </div>



        <div class="bg-white rounded-2xl shadow border p-6">

            <p class="text-gray-500 text-sm">

                Transactions

            </p>

            <h2 class="text-4xl font-bold mt-2 text-green-600">

                {{ $totalTransactions }}

            </h2>

        </div>

    </div>

    @endif

        {{-- ===================================================== --}}
    {{-- CHART + RECENT TRANSACTION --}}
    {{-- ===================================================== --}}

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Transaction Chart --}}
        <div class="xl:col-span-2">

            <div class="bg-white rounded-2xl shadow border p-6 h-full">

                <div class="flex items-center justify-between mb-5">

                    <h2 class="text-lg font-bold text-gray-800">

                        Transaction Activity (Last 7 Days)

                    </h2>

                    <span
                        class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">

                        Overview

                    </span>

                </div>

                @if($transactionChart->count())

                    <div class="space-y-3">

                        @foreach($transactionChart as $chart)

                            <div class="flex justify-between items-center">

                                <span class="text-gray-600 text-sm">

                                    {{ \Carbon\Carbon::parse($chart->date)->format('d M') }}

                                </span>

                                <div class="flex gap-5">

                                    <span
                                        class="text-green-600 font-semibold">

                                        +{{ $chart->total_in }}

                                    </span>

                                    <span
                                        class="text-red-600 font-semibold">

                                        -{{ $chart->total_out }}

                                    </span>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div
                        class="flex items-center justify-center h-60 text-gray-400">

                        Belum ada data transaksi.

                    </div>

                @endif

            </div>

        </div>



        {{-- Recent Transaction --}}
        <div>

            <div class="bg-white rounded-2xl shadow border p-6">

                <div class="flex items-center justify-between mb-5">

                    <h2 class="text-lg font-bold text-gray-800">

                        Recent Transaction

                    </h2>

                    <span
                        class="text-xs text-gray-400">

                        Last 5

                    </span>

                </div>

                @forelse($recentTransactions as $transaction)

                    <div
                        class="border-b last:border-0 py-3">

                        <div
                            class="flex justify-between">

                            <div>

                                <h3
                                    class="font-semibold">

                                    {{ $transaction->product->name }}

                                </h3>

                                <p
                                    class="text-sm text-gray-500">

                                    {{ $transaction->user->name }}

                                </p>

                            </div>

                            <div
                                class="text-right">

                                @if($transaction->type == 'IN')

                                    <span
                                        class="text-green-600 font-bold">

                                        +{{ $transaction->quantity }}

                                    </span>

                                @else

                                    <span
                                        class="text-red-600 font-bold">

                                        -{{ $transaction->quantity }}

                                    </span>

                                @endif

                                <p
                                    class="text-xs text-gray-400">

                                    {{ $transaction->transaction_date->format('d M') }}

                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <div
                        class="text-center py-12 text-gray-400">

                        Belum ada transaksi.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

        {{-- ===================================================== --}}
    {{-- LOW STOCK + LATEST PRODUCT --}}
    {{-- ===================================================== --}}

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        {{-- ================================================= --}}
        {{-- Low Stock --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow border p-6">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-lg font-bold">

                    Low Stock Alert

                </h2>

                <span
                    class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs">

                    Need Attention

                </span>

            </div>

            @forelse($lowStocks as $product)

                <div
                    class="flex justify-between items-center border-b last:border-0 py-4">

                    <div>

                        <h3 class="font-semibold">

                            {{ $product->name }}

                        </h3>

                        <p class="text-sm text-gray-500">

                            {{ $product->category->name }}

                        </p>

                    </div>

                    <div class="text-right">

                        @if($product->stock == 0)

                            <span
                                class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-sm font-bold">

                                Out of Stock

                            </span>

                        @else

                            <span
                                class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-bold">

                                {{ $product->stock }} pcs

                            </span>

                        @endif

                    </div>

                </div>

            @empty

                <div
                    class="py-12 text-center text-gray-400">

                    🎉 Semua stok masih aman.

                </div>

            @endforelse

        </div>



        {{-- ================================================= --}}
        {{-- Latest Product --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow border p-6">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-lg font-bold">

                    Latest Product

                </h2>

                <span
                    class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-xs">

                    Recently Added

                </span>

            </div>

            @forelse($latestProducts as $product)

                <div
                    class="flex justify-between items-center border-b last:border-0 py-4">

                    <div>

                        <h3 class="font-semibold">

                            {{ $product->name }}

                        </h3>

                        <p class="text-sm text-gray-500">

                            {{ $product->category->name }}

                        </p>

                    </div>

                    <div class="text-right">

                        <span
                            class="text-xs text-gray-500">

                            {{ $product->created_at->diffForHumans() }}

                        </span>

                    </div>

                </div>

            @empty

                <div
                    class="py-12 text-center text-gray-400">

                    Belum ada produk.

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection