@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Manajemen Kategori
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Kelola kategori barang pada sistem Stockify
        </p>

    </div>



    <div class="bg-white rounded-xl shadow-sm border border-gray-200">


        {{-- Top Action --}}
        <div class="flex items-center justify-between p-5 border-b">


            <h2 class="text-lg font-semibold text-gray-700">
                Daftar Kategori
            </h2>


            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 
                text-sm font-medium text-white 
                bg-blue-700 rounded-lg 
                hover:bg-blue-800 
                focus:ring-4 focus:ring-blue-300">


                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4v16m8-8H4"/>

                </svg>


                Tambah Kategori

            </a>


        </div>



        {{-- Alert --}}
        @if(session('success'))

        <div class="mx-5 mt-5 p-4 text-sm text-green-800 
                    bg-green-100 rounded-lg">

            {{ session('success') }}

        </div>

        @endif




        {{-- Table --}}

        <div class="overflow-x-auto p-5">

        <table class="w-full text-sm text-left text-gray-600">


            <thead class="text-xs uppercase bg-gray-100 text-gray-700">


                <tr>

                    <th class="px-6 py-3">
                        No
                    </th>


                    <th class="px-6 py-3">
                        Nama Kategori
                    </th>


                    <th class="px-6 py-3">
                        Deskripsi
                    </th>


                    <th class="px-6 py-3 text-center">
                        Aksi
                    </th>


                </tr>


            </thead>



            <tbody>


            @forelse($categories as $category)


                <tr class="border-b hover:bg-gray-50 transition">


                    <td class="px-6 py-4">

                        {{ $loop->iteration }}

                    </td>



                    <td class="px-6 py-4 font-medium text-gray-900">

                        {{ $category->name }}

                    </td>



                    <td class="px-6 py-4">

                        {{ $category->description ?? '-' }}

                    </td>




                    <td class="px-6 py-4">


                        <div class="flex justify-center gap-2">



                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="px-3 py-2 text-xs font-medium 
                                text-white bg-yellow-500 
                                rounded-lg hover:bg-yellow-600">

                                Edit

                            </a>




                            <a href="{{ route('category.attributes.index', $category->id) }}"
                                class="px-3 py-2 text-xs font-medium 
                                text-white bg-indigo-600 
                                rounded-lg hover:bg-indigo-700">

                                Atribut

                            </a>




                            <form
                                action="{{ route('categories.destroy', $category->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">


                                @csrf
                                @method('DELETE')


                                <button
                                    type="submit"
                                    class="px-3 py-2 text-xs font-medium 
                                    text-white bg-red-600 
                                    rounded-lg hover:bg-red-700">


                                    Hapus


                                </button>


                            </form>


                        </div>


                    </td>



                </tr>



            @empty


                <tr>

                    <td colspan="4"
                        class="text-center py-6 text-gray-500">


                        Belum ada kategori.


                    </td>

                </tr>


            @endforelse


            </tbody>


        </table>


        </div>


    </div>


</div>


@endsection