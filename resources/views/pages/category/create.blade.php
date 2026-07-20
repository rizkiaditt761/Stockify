@extends('layouts.dashboard')

@section('content')

<div class="p-4">


    {{-- Header --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Kategori
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Tambahkan kategori barang baru ke sistem Stockify
        </p>

    </div>




    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">


        <form action="{{ route('categories.store') }}" method="POST">

            @csrf



            {{-- Nama Kategori --}}
            <div class="mb-5">


                <label class="block mb-2 text-sm font-medium text-gray-700">

                    Nama Kategori

                </label>



                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full rounded-lg border-gray-300 
                    focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Contoh: Laptop, Smartphone, Printer">



                @error('name')

                <p class="mt-2 text-sm text-red-600">

                    {{ $message }}

                </p>

                @enderror


            </div>





            {{-- Deskripsi --}}
            <div class="mb-6">


                <label class="block mb-2 text-sm font-medium text-gray-700">

                    Deskripsi

                </label>



                <textarea
                    name="description"
                    rows="4"
                    class="w-full rounded-lg border-gray-300
                    focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan deskripsi kategori">{{ old('description') }}</textarea>



                @error('description')

                <p class="mt-2 text-sm text-red-600">

                    {{ $message }}

                </p>

                @enderror


            </div>





            {{-- Button --}}
            <div class="flex gap-3">


                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium 
                    text-white bg-blue-700 rounded-lg
                    hover:bg-blue-800
                    focus:ring-4 focus:ring-blue-300">


                    Simpan


                </button>




                <a href="{{ route('categories.index') }}"
                    class="px-5 py-2.5 text-sm font-medium
                    text-gray-700 bg-gray-200 rounded-lg
                    hover:bg-gray-300">


                    Kembali


                </a>


            </div>



        </form>


    </div>



</div>


@endsection