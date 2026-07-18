<h2 class="text-xl font-bold mt-8 mb-4">
    Transaction Report
</h2>

<div class="grid grid-cols-3 gap-5 mb-6">

<div class="bg-green-100 rounded-lg p-5">

<h3 class="font-semibold">

Stock In

</h3>

<p class="text-3xl font-bold mt-2">

{{ $summary['stock_in'] }}

</p>

</div>

<div class="bg-red-100 rounded-lg p-5">

<h3 class="font-semibold">

Stock Out

</h3>

<p class="text-3xl font-bold mt-2">

{{ $summary['stock_out'] }}

</p>

</div>

<div class="bg-blue-100 rounded-lg p-5">

<h3 class="font-semibold">

Stock Opname

</h3>

<p class="text-3xl font-bold mt-2">

{{ $summary['stock_opname'] }}

</p>

</div>

</div>

<div class="bg-white rounded-lg shadow overflow-hidden mb-6">

<h3 class="font-bold text-lg p-4 border-b">

Stock Transaction

</h3>

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-3">Tanggal</th>

<th class="p-3">Product</th>

<th class="p-3">Type</th>

<th class="p-3">Qty</th>

</tr>

</thead>

<tbody>

@foreach($transactions as $transaction)

<tr class="border-t">

<td class="p-3">

{{ $transaction->transaction_date->format('d M Y') }}

</td>

<td class="p-3">

{{ $transaction->product->name }}

</td>

<td class="p-3">

{{ $transaction->type }}

</td>

<td class="p-3">

{{ $transaction->quantity }}

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="bg-white rounded-lg shadow overflow-hidden">

<h3 class="font-bold text-lg p-4 border-b">

Stock Opname

</h3>

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-3">Tanggal</th>

<th class="p-3">Product</th>

<th class="p-3">System</th>

<th class="p-3">Physical</th>

<th class="p-3">Difference</th>

</tr>

</thead>

<tbody>

@foreach($opnames as $opname)

<tr class="border-t">

<td class="p-3">

{{ $opname->created_at->format('d M Y') }}

</td>

<td class="p-3">

{{ $opname->product->name }}

</td>

<td class="p-3">

{{ $opname->system_stock }}

</td>

<td class="p-3">

{{ $opname->physical_stock }}

</td>

<td class="p-3">

{{ $opname->difference }}

</td>

</tr>

@endforeach

</tbody>

</table>

</div>