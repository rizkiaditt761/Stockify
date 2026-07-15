@extends('layouts.dashboard')

@section('content')

<div class="p-4">


<h1 class="text-2xl font-bold mb-6">
Dashboard Stockify
</h1>


<div class="grid grid-cols-3 gap-5">


<div class="bg-white rounded-lg shadow p-5">
<p class="text-gray-500">
Total Produk
</p>

<h2 class="text-3xl font-bold">
{{ $data['total_product'] }}
</h2>
</div>



<div class="bg-white rounded-lg shadow p-5">

<p class="text-gray-500">
Total Supplier
</p>

<h2 class="text-3xl font-bold">
{{ $data['total_supplier'] }}
</h2>

</div>



<div class="bg-white rounded-lg shadow p-5">

<p class="text-gray-500">
Total Kategori
</p>

<h2 class="text-3xl font-bold">
{{ $data['total_category'] }}
</h2>

</div>



<div class="bg-white rounded-lg shadow p-5">

<p class="text-gray-500">
Barang Masuk
</p>

<h2 class="text-3xl font-bold text-green-600">
{{ $data['total_stock_in'] }}
</h2>

</div>



<div class="bg-white rounded-lg shadow p-5">

<p class="text-gray-500">
Barang Keluar
</p>

<h2 class="text-3xl font-bold text-red-600">
{{ $data['total_stock_out'] }}
</h2>

</div>


</div>




<div class="mt-8 bg-white rounded-lg shadow p-5">

<h2 class="text-xl font-bold mb-4">
Produk Stok Menipis
</h2>


<table class="w-full text-left">

<thead>

<tr class="border-b">

<th class="p-3">
Produk
</th>

<th class="p-3">
Stok
</th>

<th class="p-3">
Minimum
</th>

<th class="p-3">
Status
</th>

</tr>

</thead>


<tbody>


@forelse($data['low_stock'] as $product)


<tr class="border-b">

<td class="p-3">
{{ $product->name }}
</td>


<td class="p-3">
{{ $product->stock }}
</td>


<td class="p-3">
{{ $product->minimum_stock }}
</td>


<td class="p-3">

<span class="bg-red-100 text-red-700 px-3 py-1 rounded">

Stok Rendah

</span>

</td>


</tr>


@empty


<tr>

<td colspan="4" class="p-3 text-center">

Semua stok aman

</td>

</tr>


@endforelse


</tbody>


</table>


</div>


</div>


@endsection