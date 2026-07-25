@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Manajemen Supplier
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola supplier yang bekerja sama dengan perusahaan.
            </p>

        </div>

        <a href="{{ route('suppliers.create') }}"
            class="inline-flex items-center gap-2 mt-4 md:mt-0 px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"/>

            </svg>

            Tambah Supplier

        </a>

    </div>



    {{-- Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

            <p class="text-sm text-gray-500">
                Total Supplier
            </p>

            <h2 class="text-3xl font-bold text-blue-700 mt-2">

                {{ $totalSupplier }}

            </h2>

        </div>



        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

            <p class="text-sm text-gray-500">
                Supplier Aktif
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">

                {{ $activeSupplier }}

            </h2>

        </div>



        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

            <p class="text-sm text-gray-500">
                Supplier Nonaktif
            </p>

            <h2 class="text-3xl font-bold text-red-600 mt-2">

                {{ $inactiveSupplier }}

            </h2>

        </div>

    </div>



    {{-- Success --}}
    @if(session('success'))

    <div class="mb-5 p-4 rounded-xl bg-green-100 text-green-700 border border-green-200">

        {{ session('success') }}

    </div>

    @endif



{{-- Warning --}}
@if(session('warning'))

<div class="mb-5 rounded-xl border border-yellow-300 bg-yellow-50 p-5">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h3 class="font-semibold text-yellow-800">

                ⚠ Supplier tidak dapat dinonaktifkan

            </h3>

            <p class="mt-2 text-sm text-yellow-700">

                {{ session('warning') }}

            </p>

        </div>

        @if(session('supplier_id'))

        <a
            href="{{ route('products.index', ['supplier' => session('supplier_id')]) }}"
            class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-yellow-600 text-white hover:bg-yellow-700">

            Kelola Produk →

        </a>

        @endif

    </div>

</div>

@endif



    {{-- Table Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

        {{-- Search --}}
        <div class="p-5 border-b">

            <form method="GET">

                <div class="flex flex-col md:flex-row gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama supplier, email atau nomor HP..."
                        class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                    <button
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">

                        Cari

                    </button>

                </div>

            </form>

        </div>



        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="text-xs uppercase bg-gray-50 border-b">

                    <tr>

                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Supplier
                        </th>

                        <th class="px-6 py-4">
                            Kontak
                        </th>

                        <th class="px-6 py-4">
                            Produk
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>
                    @forelse($suppliers as $supplier)

<tr class="border-b hover:bg-blue-50 transition">

    <td class="px-6 py-4">

        {{ ($suppliers->firstItem() ?? 0) + $loop->index }}

    </td>



    {{-- Supplier --}}
    <td class="px-6 py-4">

        <div>

            <p class="font-semibold text-gray-800">

                {{ $supplier->name }}

            </p>

            <p class="text-xs text-gray-500 mt-1">

                {{ $supplier->email ?: '-' }}

            </p>

        </div>

    </td>



    {{-- Kontak --}}
    <td class="px-6 py-4">

        <div>

            <p class="text-gray-700">

                {{ $supplier->phone ?: '-' }}

            </p>

            <p class="text-xs text-gray-500 mt-1">

                {{ Str::limit($supplier->address,40) }}

            </p>

        </div>

    </td>



    {{-- Total Product --}}
    <td class="px-6 py-4">

        <span
            class="inline-flex items-center
            px-3 py-1 rounded-full
            bg-blue-100 text-blue-700
            font-semibold">

            {{ $supplier->products_count }}

            Produk

        </span>

    </td>



    {{-- Status --}}
    <td class="px-6 py-4">

        @if($supplier->is_active)

            <span
                class="inline-flex items-center
                px-3 py-1 rounded-full
                bg-green-100 text-green-700
                font-semibold">

                Active

            </span>

        @else

            <span
                class="inline-flex items-center
                px-3 py-1 rounded-full
                bg-red-100 text-red-700
                font-semibold">

                Inactive

            </span>

        @endif

    </td>



    {{-- Action --}}
    <td class="px-6 py-4">

        <div class="flex justify-center gap-2 flex-wrap">

            
            <a
                href="{{ route('suppliers.show',$supplier->id) }}"
                class="px-3 py-2 text-xs font-medium
                rounded-lg
                bg-yellow-500 text-white
                hover:bg-yellow-600">

                Detail

            </a>


            <a
                href="{{ route('suppliers.edit',$supplier->id) }}"
                class="px-3 py-2 text-xs font-medium
                rounded-lg
                bg-yellow-500 text-white
                hover:bg-yellow-600">

                Edit

            </a>



            @if($supplier->is_active)

                <form
                    action="{{ route('suppliers.deactivate',$supplier->id) }}"
                    method="POST"
                    onsubmit="return confirm('Nonaktifkan supplier ini?')">

                    @csrf
                    @method('PATCH')

                    <button
                        class="px-3 py-2 text-xs font-medium
                        rounded-lg
                        bg-red-600 text-white
                        hover:bg-red-700">

                        Deactivate

                    </button>

                </form>

            @else

                <form
                    action="{{ route('suppliers.activate',$supplier->id) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                    <button
                        class="px-3 py-2 text-xs font-medium
                        rounded-lg
                        bg-green-600 text-white
                        hover:bg-green-700">

                        Activate

                    </button>

                </form>

            @endif

        </div>

    </td>

</tr>

@empty

<tr>

    <td
        colspan="6"
        class="py-10 text-center text-gray-500">

        Belum ada supplier.

    </td>

</tr>

@endforelse
</tbody>

</table>

</div>

@if($suppliers->hasPages())

<div class="px-6 py-4 border-t border-gray-200">

    {{ $suppliers->links() }}

</div>

@endif

</div>

</div>

@endsection