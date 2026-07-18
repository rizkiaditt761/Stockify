@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-5">
        Stock Monitoring
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-blue-100 rounded-lg p-4 shadow">
        <p class="text-balck-500">Total Produk</p>
        <h2 class="text-3xl font-bold text-blue-700">
            {{ $totalProduct }}
        </h2>
    </div>

    <div class="bg-green-100 rounded-lg p-4 shadow">
        <p class="text-black-500">Stock Aman</p>
        <h2 class="text-3xl font-bold text-green-700">
            {{ $stockSafe }}
        </h2>
    </div>

    <div class="bg-yellow-100 rounded-lg p-4 shadow">
        <p class="text-black-500">Hampir Habis</p>
        <h2 class="text-3xl font-bold text-yellow-700">
            {{ $stockLow }}
        </h2>
    </div>

    <div class="bg-red-100 rounded-lg p-4 shadow">
        <p class="text-black-500">Stock Habis</p>
        <h2 class="text-3xl font-bold text-red-700">
            {{ $stockEmpty }}
        </h2>
    </div>

</div>

    <form method="GET" class="mb-5">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari produk..."
            class="border rounded-lg px-4 py-2 w-72">

        <button
            class="bg-blue-700 text-white px-4 py-2 rounded-lg">
            Cari
        </button>

    </form>

    <table class="w-full border">

        <thead class="bg-gray-100">

            
                <th class="border p-2">No</th>
                <th class="border p-2">Produk</th>
                <th class="border p-2">Kategori</th>
                <th class="border p-2">Stock</th>
                <th class="border p-2">Minimum</th>
                <th class="border p-2">Progress</th>
                <th class="border p-2">Status</th>
            </tr>

        </thead>

        <tbody>

        @forelse($products as $product)

            <tr class="
                @if($product->stock == 0)
                    bg-red-50
                @elseif($product->stock <= $product->minimum_stock)
                    bg-yellow-50
                @endif
                ">

                <td class="border p-2">
                    {{ $loop->iteration }}
                </td>

                <td class="border p-2">
                    {{ $product->name }}
                </td>

                <td class="border p-2">
                    {{ $product->category->name }}
                </td>

                <td class="border p-2 text-center">
                    {{ $product->stock }}
                </td>

                <td class="border p-2 text-center">
                    {{ $product->minimum_stock }}
                </td>

                <td class="border p-2">

    @php
        $percent = $product->minimum_stock > 0
            ? min(($product->stock / ($product->minimum_stock * 2)) * 100, 100)
            : 100;
    @endphp

    <div class="w-full bg-gray-200 rounded-full h-3">

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

                <td class="border p-2 text-center">

                    @if($product->stock == 0)

                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full">
                            Habis
                        </span>

                    @elseif($product->stock <= $product->minimum_stock)

                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full">
                            Hampir Habis
                        </span>

                    @else

                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full">
                            Aman
                        </span>

                    @endif

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6" class="text-center p-5">
                    Tidak ada data.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection