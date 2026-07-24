@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Category Management
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola seluruh kategori produk pada sistem Stockify.
            </p>

        </div>

        <a href="{{ route('categories.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium transition">

            + Tambah Kategori

        </a>

    </div>



    {{-- Total Category Card --}}
    <div class="mb-6">

        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 shadow-sm">

            <p class="text-sm font-medium text-blue-700">

                Total Category

            </p>

            <h2 class="text-4xl font-bold text-blue-700 mt-2">

                {{ $totalCategory }}

            </h2>

            <p class="text-sm text-gray-500 mt-2">

                Total seluruh kategori yang tersedia di Stockify.

            </p>

        </div>

    </div>



    {{-- Search --}}
    <div class="flex flex-col md:flex-row gap-3 mb-6">

        <form
            method="GET"
            class="flex flex-col md:flex-row gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari kategori..."
                class="border rounded-lg px-4 py-2 w-80">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Cari

            </button>

        </form>

        @if(request('search'))

            <a href="{{ route('categories.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-black px-5 py-2 rounded-lg">

                Reset

            </a>

        @endif

    </div>



    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        {{-- Alert --}}
        @if(session('success'))

        <div class="mx-5 mt-5 p-4 rounded-lg bg-green-100 text-green-700">

            {{ session('success') }}

        </div>

        @endif



        {{-- Table --}}
        <div class="overflow-x-auto p-5">
            <table class="w-full text-sm">

    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">

        <tr>

            <th class="px-6 py-4 text-left">
                No
            </th>

            <th class="px-6 py-4 text-left">
                Nama Kategori
            </th>

            <th class="px-6 py-4 text-left">
                Deskripsi
            </th>

            <th class="px-6 py-4 text-center">
                Total Produk
            </th>

            <th class="px-6 py-4 text-center">
                Total Atribut
            </th>

            <th class="px-6 py-4 text-center">
                Action
            </th>

        </tr>

    </thead>

    <tbody>

        @forelse($categories as $category)

        <tr class="border-t hover:bg-gray-50">

            <td class="px-6 py-4">

                {{ $categories->firstItem() + $loop->index }}

            </td>

            <td class="px-6 py-4">

                <div class="font-semibold text-gray-800">

                    {{ $category->name }}

                </div>

            </td>

            <td class="px-6 py-4 text-gray-600">

                {{ $category->description ?: '-' }}

            </td>

            <td class="px-6 py-4 text-center">

                <span class="inline-flex items-center justify-center min-w-[42px] px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">

                    {{ $category->products_count }}

                </span>

            </td>

            <td class="px-6 py-4 text-center">

                <span class="inline-flex items-center justify-center min-w-[42px] px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold">

                    {{ $category->category_attributes_count }}

                </span>

            </td>

            <td class="px-6 py-4">

                <div class="flex justify-center gap-2">

                    <a href="{{ route('categories.edit',$category->id) }}"
                        class="px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                        Edit

                    </a>

                    <a href="{{ route('category.attributes.index',$category->id) }}"
                        class="px-3 py-2 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">

                        Atribut

                    </a>

                    <form
                        action="{{ route('categories.destroy',$category->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="px-3 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">

                            Hapus

                        </button>

                    </form>

                </div>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="6"
                class="text-center py-10 text-gray-500">

                Belum ada kategori.

            </td>

        </tr>

        @endforelse

    </tbody>

</table>
        </div>

        {{-- Pagination --}}
        @if($categories->hasPages())

        <div class="px-6 py-4 border-t bg-gray-50">

            {{ $categories->withQueryString()->links() }}

        </div>

        @endif

    </div>

</div>

@endsection