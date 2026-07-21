@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Monitoring Stok
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Pantau kondisi stok seluruh produk secara real-time.
            </p>

            <p class="mt-4 text-sm font-medium text-gray-600">

                Total Produk :

                <span class="font-bold text-blue-600">
                    {{ $totalProduct }}
                </span>

            </p>

        </div>

        {{-- Search --}}
        <form
            action="{{ route('stock.monitoring.index') }}"
            method="GET"
            class="flex items-center gap-2">

            {{-- mempertahankan filter ketika search --}}
            @if(request('status'))

                <input
                    type="hidden"
                    name="status"
                    value="{{ request('status') }}">

            @endif

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari produk..."
                class="w-72 rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">

            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white transition hover:bg-blue-700">

                Cari

            </button>

        </form>

    </div>



    {{-- Statistik --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-3 mb-8">

        {{-- Stock Aman --}}
        <a
            href="{{ request('status') == 'safe'
                    ? route('stock.monitoring.index', ['search' => request('search')])
                    : route('stock.monitoring.index', [
                        'status' => 'safe',
                        'search' => request('search')
                    ]) }}"

            class="group rounded-xl border p-6 transition-all duration-200

            {{ request('status') == 'safe'
                ? 'border-green-500 bg-green-50 shadow-lg scale-[1.02]'
                : 'border-gray-200 bg-white hover:-translate-y-1 hover:shadow-lg'
            }}">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">

                        Stock Aman

                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-green-600">

                        {{ $stockSafe }}

                    </h2>

                </div>

                <div class="rounded-full bg-green-100 p-4">

                    ✅

                </div>

            </div>

        </a>



        {{-- Hampir Habis --}}
        <a
            href="{{ request('status') == 'low'
                    ? route('stock.monitoring.index', ['search' => request('search')])
                    : route('stock.monitoring.index', [
                        'status' => 'low',
                        'search' => request('search')
                    ]) }}"

            class="group rounded-xl border p-6 transition-all duration-200

            {{ request('status') == 'low'
                ? 'border-yellow-500 bg-yellow-50 shadow-lg scale-[1.02]'
                : 'border-gray-200 bg-white hover:-translate-y-1 hover:shadow-lg'
            }}">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">

                        Hampir Habis

                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-yellow-500">

                        {{ $stockLow }}

                    </h2>

                </div>

                <div class="rounded-full bg-yellow-100 p-4">

                    ⚠️

                </div>

            </div>

        </a>



        {{-- Stock Habis --}}
        <a
            href="{{ request('status') == 'empty'
                    ? route('stock.monitoring.index', ['search' => request('search')])
                    : route('stock.monitoring.index', [
                        'status' => 'empty',
                        'search' => request('search')
                    ]) }}"

            class="group rounded-xl border p-6 transition-all duration-200

            {{ request('status') == 'empty'
                ? 'border-red-500 bg-red-50 shadow-lg scale-[1.02]'
                : 'border-gray-200 bg-white hover:-translate-y-1 hover:shadow-lg'
            }}">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">

                        Stock Habis

                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-red-600">

                        {{ $stockEmpty }}

                    </h2>

                </div>

                <div class="rounded-full bg-red-100 p-4">

                    ❌

                </div>

            </div>

        </a>

    </div>



    {{-- Table --}}
        {{-- Tabel Produk --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

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

                        <th class="px-6 py-4 text-center">
                            Stok
                        </th>

                        <th class="px-6 py-4 text-center">
                            Minimum
                        </th>

                        <th class="px-6 py-4">
                            Progress
                        </th>

                        <th class="px-6 py-4 text-center">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $product->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $product->category->name }}
                            </td>

                            <td class="px-6 py-4 text-center font-semibold">

                                {{ $product->stock }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ $product->minimum_stock }}

                            </td>

                            <td class="px-6 py-4">

                                @php
                                    $percent = $product->minimum_stock > 0
                                        ? min(($product->stock / ($product->minimum_stock * 2)) * 100, 100)
                                        : 100;
                                @endphp

                                <div class="w-full rounded-full bg-gray-200 h-3">

                                    <div
                                        class="h-3 rounded-full
                                        @if($product->stock == 0)
                                            bg-red-500
                                        @elseif($product->stock <= $product->minimum_stock)
                                            bg-yellow-500
                                        @else
                                            bg-green-500
                                        @endif"
                                        style="width: {{ $percent }}%">
                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($product->stock == 0)

                                    <span class="inline-flex whitespace-nowrap rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                                        Habis

                                    </span>

                                @elseif($product->stock <= $product->minimum_stock)

                                    <span class="inline-flex whitespace-nowrap rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">

                                        Hampir Habis

                                    </span>

                                @else

                                    <span class="inline-flex whitespace-nowrap rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                        Aman

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="py-12 text-center text-gray-500">

                                Tidak ada produk yang ditemukan.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection