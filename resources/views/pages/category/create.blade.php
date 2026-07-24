@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-6">

        <h1 class="text-3xl font-bold text-gray-800">
            Tambah Kategori
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Tambahkan kategori baru untuk mengelompokkan produk di Stockify.
        </p>

    </div>



    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <form action="{{ route('categories.store') }}" method="POST">

            @csrf

            {{-- Error --}}
            @if($errors->any())

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                    <h3 class="font-semibold text-red-700 mb-2">

                        Terjadi kesalahan

                    </h3>

                    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif



            <div class="grid grid-cols-1 gap-6">

                {{-- Nama --}}
                <div>

                    <label class="block mb-2 text-sm font-semibold text-gray-700">

                        Nama Kategori
                        <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Contoh : Laptop"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>



                {{-- Deskripsi --}}
                <div>

                    <label class="block mb-2 text-sm font-semibold text-gray-700">

                        Deskripsi

                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Masukkan deskripsi kategori..."
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>

                </div>

            </div>



            {{-- Info --}}
            <div class="mt-6 rounded-xl bg-blue-50 border border-blue-200 p-4">

                <h4 class="font-semibold text-blue-700">

                    Informasi

                </h4>

                <p class="text-sm text-blue-600 mt-1">

                    Setelah kategori dibuat, kamu dapat menambahkan atribut kategori seperti
                    <b>RAM</b>, <b>Processor</b>, <b>Ukuran Layar</b>, dan lainnya.

                </p>

            </div>



            {{-- Button --}}
            <div class="flex gap-3 mt-8">
                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">

                    Simpan Kategori

                </button>

                <a href="{{ route('categories.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection