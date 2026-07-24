@extends('layouts.dashboard')

@section('content')

<div class="p-4">


    <div class="mb-5">

        <h1 class="text-2xl font-bold text-gray-800">
            Edit Produk
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Perbarui informasi produk
        </p>

    </div>




    <div class="bg-white rounded-lg shadow p-6">



        <form action="{{ route('products.update', $product->id) }}" 
      method="POST"
      enctype="multipart/form-data">


            @csrf
            @method('PUT')




            @if ($errors->any())

            <div class="mb-5 p-4 text-sm text-red-700 bg-red-100 rounded-lg">

                <ul class="list-disc pl-5">

                    @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                    @endforeach

                </ul>

            </div>

            @endif






            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">





                {{-- Nama Produk --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nama Produk
                    </label>


                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:ring-blue-500 focus:border-blue-500">


                </div>






                {{-- SKU --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        SKU
                    </label>


                    <input
                        type="text"
                        name="sku"
                        value="{{ old('sku', $product->sku) }}"
                        class="w-full rounded-lg border-gray-300 p-2.5">


                </div>






                {{-- Category --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Kategori
                    </label>


                    <select
                        id="category"
                        name="category_id"
                        class="w-full rounded-lg border-gray-300 p-2.5">


                        @foreach($categories as $category)


                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>


                        @endforeach


                    </select>


                </div>






                {{-- Supplier --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Supplier
                    </label>



                    <select
                        name="supplier_id"
                        class="w-full rounded-lg border-gray-300 p-2.5">


                        @foreach($suppliers as $supplier)


                        <option
                            value="{{ $supplier->id }}"
                            {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>


                            {{ $supplier->name }}


                        </option>


                        @endforeach



                    </select>


                </div>








                {{-- Harga Beli --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Harga Beli
                    </label>


                    <input
                        type="number"
                        name="purchase_price"
                        value="{{ old('purchase_price', $product->purchase_price) }}"
                        class="w-full rounded-lg border-gray-300 p-2.5">


                </div>







                {{-- Harga Jual --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Harga Jual
                    </label>


                    <input
                        type="number"
                        name="selling_price"
                        value="{{ old('selling_price', $product->selling_price) }}"
                        class="w-full rounded-lg border-gray-300 p-2.5">


                </div>







                {{-- Stock --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Stock
                    </label>


                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock', $product->stock) }}"
                        class="w-full rounded-lg border-gray-300 p-2.5">


                </div>







                {{-- Minimum Stock --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Minimum Stock
                    </label>


                    <input
                        type="number"
                        name="minimum_stock"
                        value="{{ old('minimum_stock', $product->minimum_stock) }}"
                        class="w-full rounded-lg border-gray-300 p-2.5">


                </div>



            </div>








            {{-- Description --}}
            <div class="mt-5">


                <label class="block mb-2 text-sm font-medium text-gray-700">

                    Deskripsi

                </label>



                <textarea
                    name="description"
                    rows="4"
                    class="w-full rounded-lg border-gray-300 p-2.5">{{ old('description', $product->description) }}</textarea>



            </div>







            {{-- Attribute --}}
            <div id="attributeContainer" class="mt-6">


            </div>



            {{-- Product Image --}}

<div class="mt-6">


    <label class="block mb-2 text-sm font-medium text-gray-700">

        Foto Produk

    </label>




    {{-- Current Image --}}

    @if($product->image)

        <div class="mb-4">

            <p class="text-sm text-gray-500 mb-2">

                Foto Saat Ini

            </p>


            <img
                src="{{ asset('storage/'.$product->image) }}"
                class="w-40 h-40 object-cover rounded-xl border shadow">


        </div>

    @endif





    {{-- Upload New Image --}}

    <input
        type="file"
        name="image"
        accept="image/*"
        onchange="previewImage(event)"
        class="w-full rounded-lg border-gray-300 p-2.5 bg-gray-50">





    {{-- Preview New Image --}}

    <div class="mt-4">


        <p class="text-sm text-gray-500 mb-2">

            Preview Foto Baru

        </p>


        <img
            id="imagePreview"
            class="hidden w-40 h-40 object-cover rounded-xl border shadow">


    </div>




    <p class="text-xs text-gray-500 mt-2">

        Kosongkan jika tidak ingin mengganti foto.

    </p>


</div>



            <div class="flex justify-start gap-3 mt-6">

                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">

                    Simpan Perubahan

                </button>

                <a href="{{ route('products.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">

                    Batal

                </a>

            </div>



        </form>


    </div>


</div>







<script>


const productAttributes = @json(
    $product->attributes->pluck('value', 'name')
);



function loadAttributes(categoryId){



    fetch('/category-attributes/' + categoryId)


    .then(response => response.json())


    .then(data => {



        let html = '';



        data.forEach(function(attribute){



            let value = productAttributes[attribute.name] ?? '';



            html += `


            <div class="mb-4">


                <label class="block mb-2 text-sm font-medium text-gray-700">

                    ${attribute.name}

                </label>



                <input

                    type="text"

                    name="attributes[${attribute.id}]"

                    value="${value}"

                    class="w-full rounded-lg border-gray-300 p-2.5"

                >



            </div>



            `;



        });




        document.getElementById('attributeContainer').innerHTML = html;



    });



}




document
.getElementById('category')
.addEventListener('change', function(){


    loadAttributes(this.value);


});




loadAttributes(
    document.getElementById('category').value
);

function previewImage(event)
{

    const image = document.getElementById('imagePreview');


    image.src = URL.createObjectURL(
        event.target.files[0]
    );


    image.classList.remove('hidden');

}



</script>



@endsection