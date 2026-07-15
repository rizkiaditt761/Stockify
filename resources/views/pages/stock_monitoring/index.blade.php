@extends('layouts.dashboard')

@section('content')

<div class="p-4">

<h1 class="text-2xl font-bold mb-5">
    Monitoring Stok Minimum
</h1>


<div class="bg-white rounded-lg shadow">

<table class="w-full text-left">

<thead class="bg-gray-100">

<tr>
<th class="p-3">
Produk
</th>

<th class="p-3">
Stok
</th>

<th class="p-3">
Minimum Stok
</th>

<th class="p-3">
Status
</th>

</tr>

</thead>


<tbody>


@foreach($products as $product)

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

@if($product->stock == 0)

<span class="text-red-600 font-bold">
Habis
</span>


@else

<span class="text-yellow-600 font-bold">
Menipis
</span>

@endif

</td>


</tr>

@endforeach


</tbody>

</table>

</div>

</div>


@endsection