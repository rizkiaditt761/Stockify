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



    {{-- Total Supplier Card --}}
<div class="mb-6">

    <div class="rounded-xl border border-blue-200 bg-blue-50 p-5 shadow-sm">

        <p class="text-sm font-medium text-blue-700">

            @if(request('status') == 'active')

                Total Supplier (Active)

            @elseif(request('status') == 'inactive')

                Total Supplier (Inactive)

            @else

                Total Supplier

            @endif

        </p>

        <h2 class="mt-2 text-4xl font-bold text-blue-700">

            {{ $totalSupplier }}

        </h2>

        <p class="mt-2 text-sm text-gray-500">

            @if(request('status') == 'active')

                Menampilkan supplier yang masih aktif.

            @elseif(request('status') == 'inactive')

                Menampilkan supplier yang sudah dinonaktifkan.

            @else

                Menampilkan seluruh supplier.

            @endif

        </p>

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



    {{-- Filter --}}
<div class="flex flex-col gap-3 mb-6 md:flex-row">

    <form
        method="GET"
        class="flex flex-col gap-3 md:flex-row">

        {{-- Search --}}
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari supplier..."
            class="w-72 rounded-lg border px-4 py-2">

        {{-- Status --}}
        <select
            name="status"
            onchange="this.form.submit()"
            class="w-60 rounded-lg border px-4 py-2">

            <option value="all"
                {{ request('status','all') == 'all' ? 'selected' : '' }}>
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

        <button
            type="submit"
            class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

            Cari

        </button>

    </form>

    @if(request('search') || request('status') != 'all')

        <a
            href="{{ route('suppliers.index') }}"
            class="rounded-lg bg-gray-300 px-5 py-2 text-black hover:bg-gray-400">

            Reset

        </a>

    @endif

</div>

{{-- Table --}}
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">



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
    <td class="px-6 py-4 text-center">

    @if($supplier->is_active)

        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

            Active

        </span>

    @else

        <span class="rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">

            Inactive

        </span>

    @endif

</td>



    {{-- Action --}}
    <td class="px-6 py-4 text-center">

    <div class="flex justify-start gap-2">

        {{-- Detail --}}
        <a
            href="{{ route('suppliers.show',$supplier->id) }}"
            class="px-3 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">

            Detail

        </a>

        {{-- Edit --}}
        <a
            href="{{ route('suppliers.edit',$supplier->id) }}"
            class="px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">

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
                    class="px-3 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">

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
                    class="px-3 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">

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

<div class="border-t bg-white px-6 py-4">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div class="text-sm text-gray-600">

            Menampilkan

            <span class="font-semibold text-blue-600">
                {{ $suppliers->firstItem() }}
            </span>

            -

            <span class="font-semibold text-blue-600">
                {{ $suppliers->lastItem() }}
            </span>

            dari

            <span class="font-semibold text-blue-600">
                {{ $suppliers->total() }}
            </span>

            supplier

        </div>

        {{ $suppliers->links() }}

    </div>

</div>

@endif

</div>

</div>

@endsection