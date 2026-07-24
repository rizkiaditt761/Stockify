@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Product Management
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola seluruh data produk, stok, kategori, dan supplier.
            </p>

        </div>

        @if(in_array(auth()->user()->role, ['admin', 'manager', 'staff']))

            <a href="{{ route('products.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium">

                + Tambah Produk

            </a>

        @endif

    </div>

    {{-- Total Product Card --}}

    <div class="mb-6">

        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 shadow-sm">

            <p class="text-sm font-medium text-blue-700">

                @if($activeCategory)

                    Total Product
                    ({{ $activeCategory->name }})

                @else

                    Total Product

                @endif

            </p>

            <h2 class="text-4xl font-bold text-blue-700 mt-2">

                {{ $totalProduct }}

            </h2>

            <p class="text-sm text-gray-500 mt-2">

                @if($activeCategory)

                    Menampilkan produk kategori
                    <b>{{ $activeCategory->name }}</b>

                @else

                    Menampilkan seluruh produk

                @endif

            </p>

        </div>

    </div>

    {{-- Filter --}}

    <div class="flex flex-col md:flex-row gap-3 mb-6">

       <form method="GET" class="flex flex-col md:flex-row gap-3">

    {{-- Search --}}
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari produk..."
        class="border rounded-lg px-4 py-2 w-72">

    {{-- Filter Kategori --}}
    <select
        name="category"
        onchange="this.form.submit()"
        class="border rounded-lg px-4 py-2 w-60">

        <option value="">
            Pilih Kategori
        </option>

        @foreach($categories as $category)

            <option
                value="{{ $category->id }}"
                {{ request('category') == $category->id ? 'selected' : '' }}>

                {{ $category->name }}

            </option>

        @endforeach

    </select>

    {{-- Filter Status (Admin, Manager Only) --}}
{{-- Filter Status Semua Role --}}
<select
    name="status"
    onchange="this.form.submit()"
    class="border rounded-lg px-4 py-2 w-60">

    <option value="all"
    {{ request('status', 'all') == 'all' ? 'selected' : '' }}>
        Semua
    </option>

    <option value="active"
    {{ request('status') == 'active' ? 'selected' : '' }}>
        Active
    </option>

    <option value="inactive"
    {{ request('status') == 'inactive' ? 'selected' : '' }}>
        Inactive
    </option>

</select>

    {{-- Button --}}
    <button
        type="submit"
        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">

        Cari

    </button>

</form>

        @if(request('search') || request('category'))

            <a href="{{ route('products.index') }}"
                class="bg-gray-300 text-black px-5 py-2 rounded-lg hover:bg-gray-400">

                Reset

            </a>

        @endif

    </div>

    {{-- Product Table --}}

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">

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
                            Stock
                        </th>

                        <th class="px-6 py-4 text-center">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($products as $product)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="px-6 py-4">

                            {{ $products->firstItem() + $loop->index }}

                        </td>

                        <td class="px-6 py-4">

    <div class="flex items-center gap-4">

        @if($product->image)

            <img
                src="{{ asset('storage/'.$product->image) }}"
                class="w-14 h-14 rounded-xl object-cover border">

        @else

            <div class="w-14 h-14 rounded-xl bg-gray-100 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-7 h-7 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M4 16l4-4a3 3 0 014 0l4 4m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                </svg>

            </div>

        @endif

        <div>

            <div class="font-semibold text-gray-800">

                {{ $product->name }}

            </div>

            <div class="text-xs text-gray-500 mt-1">

                SKU :
                {{ $product->sku }}

            </div>

        </div>

    </div>

</td>

<td class="px-6 py-4">

    {{ $product->category->name }}

</td>

  

                        <td class="px-6 py-4 text-center">

                            @if($product->stock == 0)

                                <span class="font-semibold text-red-600">
                                    {{ $product->stock }}
                                </span>

                            @elseif($product->stock <= $product->minimum_stock)

                                <span class="font-semibold text-yellow-600">
                                    {{ $product->stock }}
                                </span>

                            @else

                                <span class="font-semibold text-green-600">
                                    {{ $product->stock }}
                                </span>

                            @endif

                        </td>



                        <td class="px-6 py-4 text-center">

                        @if($product->is_active)

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                Active

                            </span>

                        @else

                            <span class="rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">

                                Inactive

                            </span>

                        @endif

                    </td>

                        <td class="px-6 py-4 text-center">

                           <div class="flex justify-start gap-2">

                                {{-- Detail --}}
                                <a href="{{ route('products.show',$product->id) }}"
                                    class="px-3 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">

                                    Detail

                                </a>

                                {{-- Edit --}}
                                @if(in_array(auth()->user()->role, ['admin','manager','staff']))

                                    <a href="{{ route('products.edit',$product->id) }}"
                                        class="px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                                        Edit

                                    </a>

                                @endif

                             @if(in_array(auth()->user()->role, ['admin','manager']))

                                    @if($product->is_active)

                                        <form
                                            action="{{ route('products.deactivate', $product->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Nonaktifkan produk ini?')">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="px-3 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">

                                                Nonaktifkan

                                            </button>

                                        </form>

                                    @else

        <form
            action="{{ route('products.activate', $product->id) }}"
            method="POST"
            onsubmit="return confirm('Aktifkan kembali produk ini?')">

            @csrf
            @method('PATCH')

            <button
                type="submit"
                class="px-3 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-emerald-700">

                Aktifkan

            </button>

        </form>

    @endif

@endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8"
                            class="text-center py-10 text-gray-500">

                            Tidak ada data produk.

                        </td>

                    </tr>

                @endforelse

                </tbody>

           </table>

</div>

{{-- Pagination --}}
@if($products->hasPages())

<div class="border-t bg-white px-6 py-4">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div class="text-sm text-gray-600">

            Menampilkan

            <span class="font-semibold text-blue-600">
                {{ $products->firstItem() }}
            </span>

            -

            <span class="font-semibold text-blue-600">
                {{ $products->lastItem() }}
            </span>

            dari

            <span class="font-semibold text-blue-600">
                {{ $products->total() }}
            </span>

            produk

        </div>

        {{ $products->links() }}

    </div>

</div>

@endif

</div>

</div>

@endsection