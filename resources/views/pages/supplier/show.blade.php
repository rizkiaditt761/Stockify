@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">

                Detail Supplier

            </h1>

            <p class="mt-1 text-sm text-gray-500">

                Informasi lengkap supplier beserta seluruh produk yang disuplai.

            </p>

        </div>



        <div class="flex flex-wrap gap-3 mt-4 lg:mt-0">

            <a
                href="{{ route('suppliers.edit',$supplier->id) }}"
                class="inline-flex items-center px-5 py-2.5 rounded-lg bg-blue-700 text-white hover:bg-blue-800">

                Edit

            </a>

            <a
                href="{{ route('suppliers.index') }}"
                class="inline-flex items-center px-5 py-2.5 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">

                ← Kembali

            </a>

        </div>

    </div>



    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

        <div class="bg-white border rounded-xl shadow-sm p-5">

            <p class="text-sm text-gray-500">

                Total Produk

            </p>

            <h2 class="text-3xl font-bold text-blue-700 mt-2">

                {{ $supplier->products_count }}

            </h2>

        </div>



        <div class="bg-white border rounded-xl shadow-sm p-5">

            <p class="text-sm text-gray-500">

                Status Supplier

            </p>

            <div class="mt-3">

                @if($supplier->is_active)

                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                        Aktif

                    </span>

                @else

                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">

                        Nonaktif

                    </span>

                @endif

            </div>

        </div>



        <div class="bg-white border rounded-xl shadow-sm p-5">

            <p class="text-sm text-gray-500">

                Dibuat

            </p>

            <h2 class="mt-2 font-semibold text-gray-800">

                {{ $supplier->created_at->format('d M Y') }}

            </h2>

        </div>



        <div class="bg-white border rounded-xl shadow-sm p-5">

            <p class="text-sm text-gray-500">

                Terakhir Diubah

            </p>

            <h2 class="mt-2 font-semibold text-gray-800">

                {{ $supplier->updated_at->format('d M Y') }}

            </h2>

        </div>

    </div>



    {{-- Informasi Supplier --}}
    <div class="bg-white rounded-xl border shadow-sm p-6 mb-6">

        <h2 class="text-lg font-bold text-gray-800 mb-5">

            Informasi Supplier

        </h2>

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <p class="text-sm text-gray-500">

                    Nama Supplier

                </p>

                <h3 class="font-semibold text-gray-800 mt-1">

                    {{ $supplier->name }}

                </h3>

            </div>



            <div>

                <p class="text-sm text-gray-500">

                    Nomor HP

                </p>

                <h3 class="font-semibold text-gray-800 mt-1">

                    {{ $supplier->phone ?: '-' }}

                </h3>

            </div>



            <div>

                <p class="text-sm text-gray-500">

                    Email

                </p>

                <h3 class="font-semibold text-gray-800 mt-1">

                    {{ $supplier->email ?: '-' }}

                </h3>

            </div>



            <div>

                <p class="text-sm text-gray-500">

                    Alamat

                </p>

                <h3 class="font-semibold text-gray-800 mt-1">

                    {{ $supplier->address ?: '-' }}

                </h3>

            </div>

        </div>

    </div>
        {{-- Warning --}}
    @if(!$supplier->is_active)

        <div class="mb-6 p-4 rounded-xl border border-yellow-200 bg-yellow-50">

            <div class="flex items-start gap-3">

                <svg class="w-6 h-6 text-yellow-600 flex-shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>

                </svg>

                <div>

                    <h3 class="font-semibold text-yellow-800">

                        Supplier Dinonaktifkan

                    </h3>

                    <p class="mt-1 text-sm text-yellow-700">

                        Supplier ini sudah tidak aktif.
                        Produk yang masih menggunakan supplier ini
                        sebaiknya segera dipindahkan ke supplier lain
                        melalui menu <b>Edit Product</b>.

                    </p>

                </div>

            </div>

        </div>

    @endif



    {{-- Produk Supplier --}}
    <div class="bg-white rounded-xl border shadow-sm">

        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>

                <h2 class="text-lg font-bold text-gray-800">

                    Produk Supplier

                </h2>

                <p class="text-sm text-gray-500 mt-1">

                    Seluruh produk yang menggunakan supplier ini.

                </p>

            </div>

        </div>



        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-50 border-b text-gray-600 uppercase text-xs">

                    <tr>

                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Produk
                        </th>

                        <th class="px-6 py-4">
                            Kategori
                        </th>

                        <th class="px-6 py-4">
                            Stock
                        </th>

                        <th class="px-6 py-4 text-center">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($products as $product)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-6 py-4">

                            {{ $products->firstItem() + $loop->index }}

                        </td>

                        <td class="px-6 py-4 font-medium text-gray-800">

                            {{ $product->name }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $product->category->name }}

                        </td>

                        <td class="px-6 py-4">

                            {{ number_format($product->stock) }}

                        </td>

                        <td class="px-6 py-4 text-center">

                            @if($product->is_active)

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                                    Aktif

                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">

                                    Nonaktif

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="text-center py-12 text-gray-500">

                            Supplier ini belum memiliki produk.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>



        @if($products->hasPages())

            <div class="px-6 py-4 border-t">

                {{ $products->links() }}

            </div>

        @endif

    </div>

</div>

@endsection