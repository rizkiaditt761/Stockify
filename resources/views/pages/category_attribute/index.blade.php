@extends('layouts.dashboard')

@section('content')

<div class="p-4">


    {{-- Header --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Kelola Atribut Kategori
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Atur atribut khusus untuk kategori {{ $category->name }}
        </p>

    </div>




    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">



        {{-- Category Info --}}
        <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-100">


            <p class="text-sm text-gray-500">
                Kategori
            </p>


            <h2 class="text-lg font-semibold text-blue-700">
                {{ $category->name }}
            </h2>


        </div>





        {{-- Success Alert --}}
        @if(session('success'))

        <div class="mb-5 p-4 text-sm text-green-800 bg-green-100 rounded-lg">

            {{ session('success') }}

        </div>

        @endif





        <form action="{{ route('category.attributes.store', $category->id) }}"
              method="POST">


            @csrf



            <div id="attributes">



                @if($attributes->count())


                    @foreach($attributes as $attribute)


                    <div class="flex gap-3 mb-3">


                        <input
                            type="text"
                            name="attributes[]"
                            value="{{ $attribute->name }}"
                            class="w-full rounded-lg border-gray-300
                            focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: Processor, RAM, Warna">


                    </div>


                    @endforeach



                @else



                    <div class="flex gap-3 mb-3">


                        <input
                            type="text"
                            name="attributes[]"
                            class="w-full rounded-lg border-gray-300
                            focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nama atribut">


                    </div>



                @endif



            </div>





            {{-- Add Attribute --}}
            <button
                type="button"
                onclick="addAttribute()"
                class="mb-6 px-4 py-2 text-sm font-medium
                text-green-700 bg-green-100 rounded-lg
                hover:bg-green-200">


                + Tambah Atribut


            </button>






            {{-- Action --}}
            <div class="flex gap-3">


                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium
                    text-white bg-blue-700 rounded-lg
                    hover:bg-blue-800
                    focus:ring-4 focus:ring-blue-300">


                    Simpan Atribut


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




<script>

function addAttribute(){


    document.getElementById('attributes')
    .insertAdjacentHTML(
        'beforeend',

        `
        <div class="flex gap-3 mb-3">


            <input
                type="text"
                name="attributes[]"
                class="w-full rounded-lg border-gray-300
                focus:ring-blue-500 focus:border-blue-500"
                placeholder="Nama atribut">


        </div>
        `
    );


}

</script>


@endsection