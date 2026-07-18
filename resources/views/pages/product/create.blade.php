@extends('layouts.dashboard')

@section('content')

<div class="p-4">

<h1 class="text-2xl font-bold mb-5">
Tambah Produk
</h1>


<form action="{{ route('products.store') }}" method="POST">

@csrf

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="flex justify-end mb-4">
        <a href="{{ route('products.index') }}"
            class="px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
            Batal
        </a>
    </div>


<div class="mb-4">

<label>Nama Produk</label>

<input 
name="name"
class="border rounded-lg p-2 w-full">

</div>


<div class="mb-4">

<label>SKU</label>

<input 
name="sku"
class="border rounded-lg p-2 w-full">

</div>


<div class="mb-4">

<label>Kategori</label>

<select
    id="category"
    name="category_id"
    class="border rounded-lg p-2 w-full">
@foreach($categories as $category)

<option value="{{ $category->id }}">
{{ $category->name }}
</option>

@endforeach

</select>

</div>


<div class="mb-4">

<label>Supplier</label>

<select name="supplier_id"
class="border rounded-lg p-2 w-full">

@foreach($suppliers as $supplier)

<option value="{{ $supplier->id }}">
{{ $supplier->name }}
</option>

@endforeach

</select>

</div>


<div class="mb-4">

<label>Harga Beli</label>

<input 
name="purchase_price"
class="border rounded-lg p-2 w-full">

</div>


<div class="mb-4">

<label>Harga Jual</label>

<input 
name="selling_price"
class="border rounded-lg p-2 w-full">

</div>


<div class="mb-4">

<label>Stock</label>

<input 
name="stock"
class="border rounded-lg p-2 w-full">

</div>


<div class="mb-4">

<label>Minimum Stock</label>

<input 
name="minimum_stock"
class="border rounded-lg p-2 w-full">

</div>


<div class="mb-4">

<label>Description</label>

<textarea
name="description"
class="border rounded-lg p-2 w-full"></textarea>

</div>

<div id="attributeContainer" class="mt-6">

</div>


        <button 
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Simpan
        </button>


</form>


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

                        <label class="block mb-2 font-medium">
                            ${attribute.name}
                        </label>

                        <input
                            type="text"
                            name="attributes[${attribute.id}]"
                            class="w-full border rounded-lg p-2"
                        >

                    </div>
                `;

            });

            document.getElementById('attributeContainer').innerHTML = html;

        });

});

category.dispatchEvent(new Event('change'));

</script>
@endsection