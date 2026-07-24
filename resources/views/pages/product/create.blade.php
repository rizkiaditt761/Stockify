@extends('layouts.dashboard')

@section('content')

<div class="p-4">


    <div class="mb-5">

        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Produk
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Tambahkan produk baru ke dalam sistem
        </p>

    </div>



    <div class="bg-white rounded-lg shadow p-6">


        <form action="{{ route('products.store') }}" 
        method="POST"
        enctype="multipart/form-data">

            @csrf



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
                        value="{{ old('name') }}"
                        placeholder="Contoh: Lenovo ThinkPad X13"
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
                        value="{{ old('sku') }}"
                        placeholder="Contoh: LAP-001"
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:ring-blue-500 focus:border-blue-500">


                </div>





                {{-- Category --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Kategori
                    </label>


                    <select
                        id="category"
                        name="category_id"
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:ring-blue-500 focus:border-blue-500">


                        @foreach($categories as $category)

                        <option value="{{ $category->id }}">

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
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:ring-blue-500 focus:border-blue-500">


                        @foreach($suppliers as $supplier)

                        <option value="{{ $supplier->id }}">

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
                        value="{{ old('purchase_price') }}"
                        placeholder="Rp"
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
                        value="{{ old('selling_price') }}"
                        placeholder="Rp"
                        class="w-full rounded-lg border-gray-300 p-2.5">


                </div>






                {{-- Stock --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Stock Awal
                    </label>


                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock') }}"
                        placeholder="Jumlah stok"
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
                        value="{{ old('minimum_stock') }}"
                        placeholder="Batas minimum stok"
                        class="w-full rounded-lg border-gray-300 p-2.5">


                </div>


            </div>

        


                        

            {{-- Product Image --}}
            <div class="mt-6">

                <label class="block mb-2 text-sm font-medium text-gray-700">

                    Foto Produk

                </label>


                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    onchange="previewImage(event)"
                    class="w-full rounded-lg border-gray-300 p-2.5 bg-gray-50">


                <div class="mt-4">

                    <img
                        id="imagePreview"
                        class="hidden w-40 h-40 object-cover rounded-xl border shadow">

                </div>


                <p class="text-xs text-gray-500 mt-2">

                    Format: JPG, PNG, JPEG. Maksimal 2MB.

                </p>


            </div>
            
            




            {{-- Description --}}
            <div class="mt-5">


                <label class="block mb-2 text-sm font-medium text-gray-700">

                    Deskripsi

                </label>



                <textarea
                    name="description"
                    rows="4"
                    placeholder="Masukkan deskripsi produk"
                    class="w-full rounded-lg border-gray-300 p-2.5">{{ old('description') }}</textarea>


            </div>








            {{-- Dynamic Attribute --}}
            <div id="attributeContainer" class="mt-6">


            </div>









            <div class="flex justify-start gap-3 mt-6">

                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">

                    Simpan Produk

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

const category = document.getElementById('category');


category.addEventListener('change', function () {


    let id = this.value;


    fetch('/category-attributes/' + id)


    .then(response => response.json())


    .then(data => {


        let html = '';



        data.forEach(function(attribute){



            html += `

            <div class="mb-4">


                <label class="block mb-2 text-sm font-medium text-gray-700">

                    ${attribute.name}

                </label>



                <input

                    type="text"

                    name="attributes[${attribute.id}]"

                    class="w-full rounded-lg border-gray-300 p-2.5"

                >


            </div>


            `;


        });



        document.getElementById('attributeContainer').innerHTML = html;



    });


});



category.dispatchEvent(new Event('change'));

</script>

function previewImage(event)
{

    const image = document.getElementById('imagePreview');


    image.src = URL.createObjectURL(
        event.target.files[0]
    );


    image.classList.remove('hidden');

}
@endsection