@extends('layouts.dashboard')

@section('content')

<div class="p-4">


    <div class="flex justify-between items-center mb-5">


        <div>

            <h1 class="text-2xl font-bold text-gray-800">
                Detail Produk
            </h1>


            <p class="text-sm text-gray-500 mt-1">
                Informasi lengkap produk
            </p>

        </div>



        <div class="flex gap-3">


            <a href="{{ route('products.edit',$product->id) }}"
                class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">

                Edit

            </a>



            <a href="{{ route('products.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">

                Kembali

            </a>


        </div>


    </div>






    <div class="bg-white rounded-lg shadow p-6">



        {{-- Header Produk --}}

        <div class="flex justify-between items-start mb-6">


            <div>


                <h2 class="text-xl font-bold text-gray-800">

                    {{ $product->name }}

                </h2>


                <p class="text-sm text-gray-500 mt-1">

                    SKU : {{ $product->sku }}

                </p>


            </div>




            @if($product->stock <= $product->minimum_stock)


                <span class="px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-700">

                    Stok Rendah

                </span>


            @else


                <span class="px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-700">

                    Stok Aman

                </span>


            @endif



        </div>







        {{-- Informasi Produk --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">



            <div class="border rounded-lg p-4">


                <p class="text-sm text-gray-500">
                    Kategori
                </p>


                <p class="font-medium mt-1">

                    {{ $product->category->name }}

                </p>


            </div>






            <div class="border rounded-lg p-4">


                <p class="text-sm text-gray-500">
                    Supplier
                </p>


                <p class="font-medium mt-1">

                    {{ $product->supplier->name }}

                </p>


            </div>






            <div class="border rounded-lg p-4">


                <p class="text-sm text-gray-500">
                    Harga Beli
                </p>


                <p class="font-medium mt-1">

                    Rp {{ number_format($product->purchase_price,0,',','.') }}

                </p>


            </div>






            <div class="border rounded-lg p-4">


                <p class="text-sm text-gray-500">
                    Harga Jual
                </p>


                <p class="font-medium mt-1">

                    Rp {{ number_format($product->selling_price,0,',','.') }}

                </p>


            </div>






            <div class="border rounded-lg p-4">


                <p class="text-sm text-gray-500">
                    Stock Saat Ini
                </p>


                <p class="font-medium mt-1">

                    {{ $product->stock }}

                </p>


            </div>






            <div class="border rounded-lg p-4">


                <p class="text-sm text-gray-500">
                    Minimum Stock
                </p>


                <p class="font-medium mt-1">

                    {{ $product->minimum_stock }}

                </p>


            </div>



        </div>







        {{-- Deskripsi --}}

        <div class="mt-6">


            <h3 class="font-semibold text-gray-800 mb-2">

                Deskripsi

            </h3>



            <div class="bg-gray-50 rounded-lg p-4 text-gray-700">


                {{ $product->description ?? 'Tidak ada deskripsi produk.' }}


            </div>



        </div>








        {{-- Attribute --}}

        <div class="mt-6">


            <h3 class="font-semibold text-gray-800 mb-3">

                Atribut Produk

            </h3>




            @if($product->attributes->count())


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">



                @foreach($product->attributes as $attribute)


                <div class="border rounded-lg p-4">


                    <p class="text-sm text-gray-500">

                        {{ $attribute->name }}

                    </p>



                    <p class="font-medium mt-1">

                        {{ $attribute->value }}

                    </p>


                </div>



                @endforeach



            </div>




            @else


                <div class="bg-gray-50 rounded-lg p-4 text-gray-500">

                    Belum ada atribut produk.

                </div>


            @endif




        </div>





    </div>


</div>


@endsection