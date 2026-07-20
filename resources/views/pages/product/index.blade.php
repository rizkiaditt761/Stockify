@extends('layouts.dashboard')

@section('content')

<div class="p-4">


    <div class="flex justify-between items-center mb-5">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Manajemen Produk
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola data produk dan stok barang
            </p>
        </div>


        <a href="{{ route('products.create') }}"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 shadow">

            + Tambah Produk

        </a>


    </div>



    <div class="bg-white rounded-lg shadow">


        <div class="overflow-x-auto">


            <table class="w-full text-sm text-left">


                <thead class="text-xs uppercase bg-gray-50 border-b">

                    <tr>

                        <th class="px-6 py-4">
                            No
                        </th>


                        <th class="px-6 py-4">
                            Nama Produk
                        </th>


                        <th class="px-6 py-4">
                            SKU
                        </th>


                        <th class="px-6 py-4">
                            Kategori
                        </th>


                        <th class="px-6 py-4">
                            Supplier
                        </th>


                        <th class="px-6 py-4">
                            Stock
                        </th>


                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>


                    </tr>


                </thead>



                <tbody>


                @foreach($products as $product)


                <tr class="border-b hover:bg-gray-50 transition">


                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>


                    <td class="px-6 py-4 font-medium text-gray-800">

                        {{ $product->name }}

                    </td>


                    <td class="px-6 py-4">

                        {{ $product->sku }}

                    </td>



                    <td class="px-6 py-4">

                        {{ $product->category->name }}

                    </td>



                    <td class="px-6 py-4">

                        {{ $product->supplier->name }}

                    </td>



                    <td class="px-6 py-4">


                        @if($product->stock <= $product->minimum_stock)

                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">

                                {{ $product->stock }}

                            </span>

                        @else

                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">

                                {{ $product->stock }}

                            </span>

                        @endif


                    </td>



                    <td class="px-6 py-4">

                        <div class="flex justify-center gap-2">


                            <a href="{{ route('products.show',$product->id) }}"
                                class="px-3 py-2 text-xs font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">

                                Detail

                            </a>



                            <a href="{{ route('products.edit',$product->id) }}"
                                class="px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">

                                Edit

                            </a>




                            <form
                                action="{{ route('products.destroy',$product->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                @csrf
                                @method('DELETE')


                                <button
                                    type="submit"
                                    class="px-3 py-2 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">

                                    Hapus

                                </button>


                            </form>



                        </div>

                    </td>


                </tr>


                @endforeach



                </tbody>



            </table>



        </div>



    </div>


</div>


@endsection