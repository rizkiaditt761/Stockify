@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Kelola Atribut Kategori
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Atur atribut untuk kategori
                <span class="font-semibold text-blue-700">
                    {{ $category->name }}
                </span>
            </p>
        </div>

        <a href="{{ route('categories.index') }}"
            class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
            ← Kembali
        </a>

    </div>



    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-100 border border-green-200 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif



        {{-- Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">

            <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

                <p class="text-sm text-gray-500">
                    Nama Kategori
                </p>

                <h2 class="mt-2 text-xl font-bold text-blue-700">
                    {{ $category->name }}
                </h2>

            </div>

            <div class="rounded-xl border border-indigo-200 bg-indigo-50 p-5">

                <p class="text-sm text-gray-500">
                    Total Atribut
                </p>

                <h2 class="mt-2 text-xl font-bold text-indigo-700">
                    {{ $attributes->count() }}
                </h2>

            </div>

        </div>



        <form action="{{ route('category.attributes.store',$category->id) }}"
            method="POST">

            @csrf



            <div id="attributes" class="space-y-4">

                @if($attributes->count())

                    @foreach($attributes as $attribute)

                        <div class="attribute-item flex gap-3">

                            <input
                                type="text"
                                name="attributes[]"
                                value="{{ $attribute->name }}"
                                placeholder="Nama atribut"
                                class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <button
                                type="button"
                                class="remove-btn px-4 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">

                                Hapus

                            </button>

                        </div>

                    @endforeach

                @else

                    <div class="attribute-item flex gap-3">

                        <input
                            type="text"
                            name="attributes[]"
                            placeholder="Contoh : Processor"
                            class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        <button
                            type="button"
                            class="remove-btn px-4 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">

                            Hapus

                        </button>

                    </div>

                @endif

            </div>



            <div class="flex flex-wrap gap-3 mt-8">

                <button
                    id="add-attribute"
                    type="button"
                    class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700">

                    + Tambah Atribut

                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-blue-700 text-white rounded-lg hover:bg-blue-800">

                    Simpan Atribut

                </button>

            </div>

        </form>

    </div>

</div>



<script>

document.addEventListener('DOMContentLoaded', function () {

    const container = document.getElementById('attributes');

    document.getElementById('add-attribute').addEventListener('click', function () {

        container.insertAdjacentHTML('beforeend', `
            <div class="attribute-item flex gap-3">

                <input
                    type="text"
                    name="attributes[]"
                    placeholder="Nama atribut"
                    class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                <button
                    type="button"
                    class="remove-btn px-4 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">

                    Hapus

                </button>

            </div>
        `);

    });



    container.addEventListener('click', function(e){

        if(!e.target.classList.contains('remove-btn')) return;

        const items = container.querySelectorAll('.attribute-item');

        const row = e.target.closest('.attribute-item');

        if(items.length > 1){

            row.remove();

        }else{

            row.querySelector('input').value = '';

        }

    });

});

</script>

@endsection