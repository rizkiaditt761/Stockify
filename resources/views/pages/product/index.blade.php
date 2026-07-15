@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-5">
        Product Management
    </h1>


    <div class="bg-white rounded-lg shadow p-5">

        <a href="{{ route('products.create') }}"
        class="inline-flex items-center mb-4 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
            Tambah Produk
        </a>


        <table class="w-full text-sm text-left">

            <thead class="border-b">

                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">SKU</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Supplier</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>

            </thead>


            <tbody>

            @foreach($products as $product)

            <tr class="border-b">

                <td class="px-4 py-3">
                    {{ $loop->iteration }}
                </td>


                <td class="px-4 py-3">
                    {{ $product->name }}
                </td>


                <td class="px-4 py-3">
                    {{ $product->sku }}
                </td>


                <td class="px-4 py-3">
                    {{ $product->category->name }}
                </td>


                <td class="px-4 py-3">
                    {{ $product->supplier->name }}
                </td>


                <td class="px-4 py-3">
                    {{ $product->stock }}
                </td>


                

                    <td class="px-4 py-3 flex gap-2">

                        <a href="{{ route('products.show',$product->id) }}"
                            class="px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-800">
                            Detail
                        </a>

                        <a href="{{ route('products.edit',$product->id) }}"
                            class="px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                            Edit
                        </a>
                        <form
                            action="{{ route('products.destroy',$product->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                Delete
                            </button>

                        </form>


                </td>

            </tr>

            @endforeach


            </tbody>

        </table>

    </div>

</div>

@endsection