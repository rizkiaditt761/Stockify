@extends('layouts.dashboard')

@section('content')

<div class="p-4">

<h1 class="text-2xl font-bold mb-5">
Edit Produk
</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST">

    @csrf
    @method('PUT')

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
            type="text"
            name="name"
            value="{{ old('name', $product->name) }}"
            class="border rounded-lg p-2 w-full">
    </div>


    <div class="mb-4">
        <label>SKU</label>

        <input
            type="text"
            name="sku"
            value="{{ old('sku', $product->sku) }}"
            class="border rounded-lg p-2 w-full">
    </div>


    <div class="mb-4">
        <label>Kategori</label>

        <select
    id="category"
    name="category_id"
    class="border rounded-lg p-2 w-full">
            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>

            @endforeach

        </select>
    </div>


    <div class="mb-4">
        <label>Supplier</label>

        <select
            name="supplier_id"
            class="border rounded-lg p-2 w-full">

            @foreach($suppliers as $supplier)

                <option
                    value="{{ $supplier->id }}"
                    {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>

            @endforeach

        </select>
    </div>


    <div class="mb-4">
        <label>Harga Beli</label>

        <input
            type="number"
            step="0.01"
            name="purchase_price"
            value="{{ old('purchase_price', $product->purchase_price) }}"
            class="border rounded-lg p-2 w-full">
    </div>


    <div class="mb-4">
        <label>Harga Jual</label>

        <input
            type="number"
            step="0.01"
            name="selling_price"
            value="{{ old('selling_price', $product->selling_price) }}"
            class="border rounded-lg p-2 w-full">
    </div>


    <div class="mb-4">
        <label>Stock</label>

        <input
            type="number"
            name="stock"
            value="{{ old('stock', $product->stock) }}"
            class="border rounded-lg p-2 w-full">
    </div>


    <div class="mb-4">
        <label>Minimum Stock</label>

        <input
            type="number"
            name="minimum_stock"
            value="{{ old('minimum_stock', $product->minimum_stock) }}"
            class="border rounded-lg p-2 w-full">
    </div>


    <div class="mb-4">
        <label>Description</label>

        <textarea
            name="description"
            class="border rounded-lg p-2 w-full">{{ old('description', $product->description) }}</textarea>
    </div>

    <div id="attributeContainer" class="mt-6"></div>


    <button 
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Simpan
        </button>

</form>

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

                    <label class="block mb-2 font-medium">
                        ${attribute.name}
                    </label>

                    <input
                        type="text"
                        name="attributes[${attribute.id}]"
                        value="${value}"
                        class="w-full border rounded-lg p-2"
                    >

                </div>
            `;

        });

        document
            .getElementById('attributeContainer')
            .innerHTML = html;

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

</script>

@endsection