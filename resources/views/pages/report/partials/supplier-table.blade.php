<h2 class="text-xl font-bold mt-8 mb-4">
    Supplier Report
</h2>

<div class="bg-white rounded-lg shadow overflow-hidden mb-8">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-3">Supplier</th>

<th class="p-3">Email</th>

<th class="p-3">Phone</th>

</tr>

</thead>

<tbody>

@foreach($suppliers as $supplier)

<tr class="border-t">

<td class="p-3">

{{ $supplier->name }}

</td>

<td class="p-3">

{{ $supplier->email }}

</td>

<td class="p-3">

{{ $supplier->phone }}

</td>

</tr>

@endforeach

</tbody>

</table>

</div>