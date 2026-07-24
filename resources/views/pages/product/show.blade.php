@extends('layouts.dashboard')

@section('content')

<div class="p-4">


    {{-- HEADER --}}

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">


        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Detail Produk
            </h1>


            <p class="text-sm text-gray-500 mt-1">
                Informasi lengkap produk
            </p>

        </div>



        <div class="flex gap-3 mt-4 md:mt-0">


            @if(in_array(auth()->user()->role,['admin','manager','staff']))

            <a href="{{ route('products.edit',$product->id) }}"
                class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                Edit

            </a>

            @endif



            <a href="{{ route('products.index') }}"
                class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">

                Kembali

            </a>


        </div>


    </div>







    {{-- MAIN CARD --}}

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">



        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">



            {{-- FOTO PRODUK --}}


            <div class="flex justify-center">



                @if($product->image)


                    <img src="{{ asset('storage/'.$product->image) }}"
                        class="w-72 h-72 object-cover rounded-2xl border shadow">



                @else



                    <div class="w-72 h-72 bg-gray-100 rounded-2xl flex items-center justify-center">


                        <div class="text-center text-gray-400">


                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-16 h-16 mx-auto mb-3"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">


                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M4 16l4-4a3 3 0 014 0l4 4m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>


                            </svg>


                            <p>
                                Tidak ada foto
                            </p>


                        </div>


                    </div>



                @endif



            </div>








            {{-- INFORMASI UTAMA --}}


            <div class="lg:col-span-2">



                <div class="flex justify-between items-start">



                    <div>


                        <h2 class="text-2xl font-bold text-gray-800">

                            {{ $product->name }}

                        </h2>


                        <p class="text-gray-500 mt-1">

                            SKU : {{ $product->sku }}

                        </p>


                    </div>




                    @if($product->is_active)


                    <span class="px-4 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">

                        Active

                    </span>


                    @else


                    <span class="px-4 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-700">

                        Inactive

                    </span>


                    @endif



                
                                </div>



                {{-- SUMMARY CARD --}}


                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">



                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">


                        <p class="text-sm text-blue-600 font-medium">
                            Stock Saat Ini
                        </p>


                        <p class="text-2xl font-bold text-blue-700 mt-2">

                            {{ $product->stock }}

                        </p>


                    </div>






                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">


                        <p class="text-sm text-yellow-600 font-medium">
                            Minimum Stock
                        </p>


                        <p class="text-2xl font-bold text-yellow-700 mt-2">

                            {{ $product->minimum_stock }}

                        </p>


                    </div>







                    <div class="bg-green-50 border border-green-200 rounded-xl p-4">


                        <p class="text-sm text-green-600 font-medium">
                            Harga Jual
                        </p>


                        <p class="text-lg font-bold text-green-700 mt-2">

                            Rp {{ number_format($product->selling_price,0,',','.') }}

                        </p>


                    </div>




                </div>



            </div>



        </div>







        {{-- DETAIL PRODUK --}}


        <div class="border-t mt-8 pt-8">



            <h3 class="text-xl font-bold text-gray-800 mb-5">

                Informasi Produk

            </h3>





            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">



                <div class="border rounded-xl p-5">


                    <p class="text-sm text-gray-500">
                        Kategori
                    </p>


                    <p class="font-semibold mt-1">

                        {{ $product->category->name }}

                    </p>


                </div>






                <div class="border rounded-xl p-5">


                    <p class="text-sm text-gray-500">
                        Supplier
                    </p>


                    <p class="font-semibold mt-1">

                        {{ $product->supplier->name }}

                    </p>


                </div>






                <div class="border rounded-xl p-5">


                    <p class="text-sm text-gray-500">
                        Harga Beli
                    </p>


                    <p class="font-semibold mt-1">

                        Rp {{ number_format($product->purchase_price,0,',','.') }}

                    </p>


                </div>






                <div class="border rounded-xl p-5">


                    <p class="text-sm text-gray-500">
                        Status Produk
                    </p>


                    @if($product->is_active)


                        <p class="font-semibold text-green-600 mt-1">
                            Active
                        </p>


                    @else


                        <p class="font-semibold text-gray-600 mt-1">
                            Inactive
                        </p>


                    @endif


                </div>



            </div>



        </div>
    







        {{-- DESKRIPSI --}}



        <div class="border-t mt-8 pt-8">



            <h3 class="text-xl font-bold text-gray-800 mb-4">

                Deskripsi Produk

            </h3>





            <div class="bg-gray-50 rounded-xl p-5 text-gray-700 leading-relaxed">


                {{ $product->description ?? 'Tidak ada deskripsi produk.' }}


            </div>



        </div>









        {{-- ATTRIBUTE --}}



        <div class="border-t mt-8 pt-8">



            <h3 class="text-xl font-bold text-gray-800 mb-5">

                Atribut Produk

            </h3>





            @if($product->attributes->count())



                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">



                    @foreach($product->attributes as $attribute)



                        <div class="border rounded-xl p-5">


                            <p class="text-sm text-gray-500">

                                {{ $attribute->name }}

                            </p>


                            <p class="font-semibold mt-2">

                                {{ $attribute->value }}

                            </p>


                        </div>



                    @endforeach



                </div>



            @else



                <div class="bg-gray-50 rounded-xl p-5 text-gray-500">

                    Belum ada atribut produk.

                </div>



            @endif




        </div>






    </div>



</div>



@endsection