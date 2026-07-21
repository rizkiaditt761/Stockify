@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Product Management
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola seluruh data produk, stok, kategori, dan supplier.
            </p>

        </div>


        <a href="{{ route('products.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium">

            + Tambah Produk

        </a>

    </div>



    {{-- Total Product Card --}}

    <div class="mb-6">

        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 shadow-sm">


            <p class="text-sm font-medium text-blue-700">

                @if($activeCategory)

                    Total Product
                    ({{ $activeCategory->name }})

                @else

                    Total Product

                @endif

            </p>


            <h2 class="text-4xl font-bold text-blue-700 mt-2">

                {{ $totalProduct }}

            </h2>


            <p class="text-sm text-gray-500 mt-2">

                @if($activeCategory)

                    Menampilkan produk kategori
                    <b>{{ $activeCategory->name }}</b>

                @else

                    Menampilkan seluruh produk

                @endif

            </p>


        </div>

    </div>



        {{-- Filter --}}

<div class="flex flex-col md:flex-row gap-3 mb-6">


    <form method="GET" class="flex flex-col md:flex-row gap-3">


        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari produk..."
            class="border rounded-lg px-4 py-2 w-72">


        <select
            name="category"
            onchange="this.form.submit()"
            class="border rounded-lg px-4 py-2 w-60">


            <option value="">
                Pilih Kategori
            </option>


            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>

                    {{ $category->name }}

                </option>

            @endforeach


        </select>



        <button
            type="submit"
            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">

            Cari

        </button>


    </form>



    @if(request('search') || request('category'))

        <a href="{{ route('products.index') }}"
            class="bg-gray-300 text-black px-5 py-2 rounded-lg hover:bg-gray-400">

            Reset

        </a>

    @endif


</div>




    {{-- Product Table --}}

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">


        <div class="overflow-x-auto">


            <table class="w-full text-sm">


                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">


                    <tr>


                        <th class="px-6 py-4 text-left">
                            No
                        </th>


                        <th class="px-6 py-4 text-left">
                            Produk
                        </th>


                        <th class="px-6 py-4 text-left">
                            Kategori
                        </th>


                        <th class="px-6 py-4 text-left">
                            Supplier
                        </th>


                        <th class="px-6 py-4 text-center">
                            Stock
                        </th>


                        <th class="px-6 py-4 text-center">
                            Harga
                        </th>


                        


                        <th class="px-6 py-4 text-center">
                            Action
                        </th>


                    </tr>


                </thead>



                <tbody>


                @forelse($products as $product)


                    <tr class="border-t hover:bg-gray-50">


                        <td class="px-6 py-4">

                            {{ $loop->iteration }}

                        </td>



                        <td class="px-6 py-4 font-medium">

                            {{ $product->name }}

                        </td>




                        <td class="px-6 py-4">

                            {{ $product->category->name }}

                        </td>




                        <td class="px-6 py-4">

                            {{ $product->supplier->name }}

                        </td>




                        <td class="px-6 py-4 text-center">


                            @if($product->stock == 0)

                                <span class="font-semibold text-red-600">
                                    {{ $product->stock }}
                                </span>


                            @elseif($product->stock <= $product->minimum_stock)

                                <span class="font-semibold text-yellow-600">
                                    {{ $product->stock }}
                                </span>


                            @else

                                <span class="font-semibold text-green-600">
                                    {{ $product->stock }}
                                </span>


                            @endif


                        </td>




                        <td class="px-6 py-4 text-center">


                            Rp {{ number_format($product->selling_price,0,',','.') }}


                        </td>

                        <td class="px-6 py-4 text-center">


                            <div class="flex justify-center gap-2">


                                <a href="{{ route('products.show',$product->id) }}"
                                    class="px-3 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">

                                    Detail

                                </a>



                                <a href="{{ route('products.edit',$product->id) }}"
                                    class="px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">

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
                                        class="px-3 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">


                                        Delete


                                    </button>


                                </form>


                            </div>


                        </td>



                    </tr>



                @empty


                    <tr>


                        <td colspan="8"
                            class="text-center py-10 text-gray-500">


                            Tidak ada data produk.


                        </td>


                    </tr>


                @endforelse



                </tbody>


            </table>


        </div>


    </div>


</div>


@endsection