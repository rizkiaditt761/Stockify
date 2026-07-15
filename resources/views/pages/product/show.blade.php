@extends('layouts.dashboard')

@section('content')

<div class="p-4">


<h1 class="text-2xl font-bold mb-5">
Detail Produk
</h1>

<div class="flex justify-end mb-4">
        <a href="{{ route('products.index') }}"
            class="px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
            Kembali
        </a>
    </div>


<div class="bg-white shadow rounded-lg p-5">


<p>
<b>Nama:</b>
{{ $product->name }}
</p>


<p>
<b>SKU:</b>
{{ $product->sku }}
</p>


<p>
<b>Kategori:</b>
{{ $product->category->name }}
</p>


<p>
<b>Supplier:</b>
{{ $product->supplier->name }}
</p>


<p>
<b>Harga Beli:</b>
{{ $product->purchase_price }}
</p>


<p>
<b>Harga Jual:</b>
{{ $product->selling_price }}
</p>


<p>
<b>Stock:</b>
{{ $product->stock }}
</p>


<hr class="my-4">


<h2 class="font-bold">
Atribut Produk
</h2>


@forelse($product->attributes as $attribute)

<p>
{{ $attribute->name }} :
{{ $attribute->value }}
</p>


@empty

<p>
Belum ada atribut
</p>

@endforelse


</div>


</div>

@endsection