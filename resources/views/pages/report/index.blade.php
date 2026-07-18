@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-6">
        Reports
    </h1>

    <form method="GET" class="bg-white rounded-lg shadow p-5 mb-6">

       <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
            <div>

                <label class="block mb-2 font-medium">
                    Jenis Report
                </label>

                <select
                    name="type"
                    class="w-full border rounded-lg p-2">

                    

                    <option value="stock"
                        {{ $type=='stock' ? 'selected' : '' }}>
                        Transaction
                    </option>

                    <option value="product"
                        {{ $type=='product' ? 'selected' : '' }}>
                        Product
                    </option>

                    <option value="category"
                        {{ $type=='category' ? 'selected' : '' }}>
                        Category
                    </option>

                    <option value="supplier"
                        {{ $type=='supplier' ? 'selected' : '' }}>
                        Supplier
                    </option>

                    <option value="user"
                        {{ $type=='user' ? 'selected' : '' }}>
                        User
                    </option>

                    <option value="all"
                        {{ $type=='all' ? 'selected' : '' }}>
                        Semua
                    </option>

                </select>

            </div>

            <div>

                <label class="block mb-2 font-medium">
                    Tanggal Awal
                </label>

                <input
                    type="date"
                    name="start_date"
                    value="{{ request('start_date') }}"
                    class="w-full border rounded-lg p-2">

            </div>

            <div>

                <label class="block mb-2 font-medium">
                    Tanggal Akhir
                </label>

                <input
                    type="date"
                    name="end_date"
                    value="{{ request('end_date') }}"
                    class="w-full border rounded-lg p-2">

            </div>

           <div class="flex items-center gap-2">

    <button
        class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg">
        Filter
    </button>

    <a
        href="{{ route('reports.index') }}"
        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
        Reset
    </a>

    <a
        href="{{ route('reports.export.pdf', request()->all()) }}"
        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg whitespace-nowrap">
        Export PDF
    </a>

</div>

        </div>

    </form>

   

    @if($type=='product')

<div class="bg-white rounded-lg shadow">

<table class="w-full">

<thead>

<tr class="bg-gray-100">

<th class="p-3">Product</th>

<th class="p-3">Category</th>

<th class="p-3">Stock</th>

<th class="p-3">Minimum</th>

</tr>

</thead>

<tbody>

@foreach($products as $product)

<tr>

<td class="p-3">
{{ $product->name }}
</td>

<td class="p-3">
{{ $product->category->name }}
</td>

<td class="p-3">
{{ $product->stock }}
</td>

<td class="p-3">
{{ $product->minimum_stock }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endif

    @if($type=='category')

<div class="bg-white rounded-lg shadow overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">
                    No
                </th>

                <th class="p-3 text-left">
                    Category
                </th>

                <th class="p-3 text-center">
                    Total Product
                </th>

                <th class="p-3 text-center">
                    Total Attribute
                </th>

            </tr>

        </thead>

        <tbody>

        @forelse($categories as $category)

            <tr class="border-t">

                <td class="p-3">
                    {{ $loop->iteration }}
                </td>

                <td class="p-3">
                    {{ $category->name }}
                </td>

                <td class="p-3 text-center">
                    {{ $category->products_count }}
                </td>

                <td class="p-3 text-center">
                    {{ $category->category_attributes_count }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4" class="text-center p-5">
                    Tidak ada data kategori.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endif

    @if($type=='supplier')

<div class="bg-white rounded-lg shadow">

<table class="w-full">

<thead>

<tr class="bg-gray-100">

<th class="p-3">
Supplier
</th>

<th class="p-3">
Email
</th>

<th class="p-3">
Phone
</th>

</tr>

</thead>

<tbody>

@foreach($suppliers as $supplier)

<tr>

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

@endif

    @if($type=='user')

<div class="bg-white rounded-lg shadow">

<table class="w-full">

<thead>

<tr class="bg-gray-100">

<th class="p-3">

Nama

</th>

<th class="p-3">

Email

</th>

<th class="p-3">

Role

</th>

</tr>

</thead>

<tbody>

@foreach($users as $user)

<tr>

<td class="p-3">

{{ $user->name }}

</td>

<td class="p-3">

{{ $user->email }}

</td>

<td class="p-3">

{{ ucfirst($user->role) }}

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endif

    @if($type=='stock')

<div class="grid grid-cols-3 gap-5 mb-6">

    <div class="bg-green-100 rounded-lg p-5">

        <h2>Stock In</h2>

        <p class="text-3xl font-bold">

            {{ $summary['stock_in'] }}

        </p>

    </div>

    <div class="bg-red-100 rounded-lg p-5">

        <h2>Stock Out</h2>

        <p class="text-3xl font-bold">

            {{ $summary['stock_out'] }}

        </p>

    </div>

    <div class="bg-blue-100 rounded-lg p-5">

        <h2>Stock Opname</h2>

        <p class="text-3xl font-bold">

            {{ $summary['stock_opname'] }}

        </p>

    </div>

</div>

{{-- STOCK TRANSACTION --}}

<div class="bg-white rounded-lg shadow mb-6">

    <div class="p-4 border-b">

        <h2 class="font-bold text-lg">

            Stock Transaction

        </h2>

    </div>

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3">Tanggal</th>

                <th class="p-3">Produk</th>

                <th class="p-3">Jenis</th>

                <th class="p-3">Qty</th>

                <th class="p-3">Stock Awal</th>

                <th class="p-3">Stock Akhir</th>

            </tr>

        </thead>

        <tbody>

        @forelse($transactions as $transaction)

            <tr class="border-t">

                <td class="p-3">

                    {{ $transaction->transaction_date->format('d-m-Y') }}

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

                <td class="p-3">

                    {{ $transaction->stock_before }}

                </td>

                <td class="p-3">

                    {{ $transaction->stock_after }}

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6" class="text-center p-4">

                    Tidak ada transaksi.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

{{-- STOCK MONITORING --}}

<div class="bg-white rounded-lg shadow mb-6">

    <div class="p-4 border-b">

        <h2 class="font-bold text-lg">

            Stock Monitoring

        </h2>

    </div>

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3">Produk</th>

                <th class="p-3">Stock</th>

                <th class="p-3">Minimum</th>

                <th class="p-3">Status</th>

            </tr>

        </thead>

        <tbody>

        @foreach($products as $product)

            <tr class="border-t">

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

                    @if($product->stock==0)

                        Habis

                    @elseif($product->stock <= $product->minimum_stock)

                        Hampir Habis

                    @else

                        Aman

                    @endif

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

{{-- STOCK OPNAME --}}

<div class="bg-white rounded-lg shadow">

    <div class="p-4 border-b">

        <h2 class="font-bold text-lg">

            Stock Opname

        </h2>

    </div>

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3">Tanggal</th>

                <th class="p-3">Produk</th>

                <th class="p-3">System</th>

                <th class="p-3">Physical</th>

                <th class="p-3">Selisih</th>

            </tr>

        </thead>

        <tbody>

        @forelse($opnames as $opname)

            <tr class="border-t">

                <td class="p-3">

                    {{ $opname->created_at->format('d-m-Y') }}

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

        @empty

            <tr>

                <td colspan="5" class="text-center p-4">

                    Tidak ada data stock opname.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endif

    @if($type=='all')

<h2 class="text-xl font-bold mb-4">

Executive Summary

</h2>

<div class="grid grid-cols-2 md:grid-cols-3 gap-5">

<div class="bg-white shadow rounded-lg p-5">

Total Product

<h2 class="text-3xl font-bold">

{{ $summary['total_products'] }}

</h2>

</div>

<div class="bg-white shadow rounded-lg p-5">

Total Supplier

<h2 class="text-3xl font-bold">

{{ $summary['total_suppliers'] }}

</h2>

</div>

<div class="bg-white shadow rounded-lg p-5">

Total User

<h2 class="text-3xl font-bold">

{{ $summary['total_users'] }}

</h2>

</div>

<div class="bg-white shadow rounded-lg p-5">

Stock In

<h2 class="text-3xl font-bold">

{{ $summary['stock_in'] }}

</h2>

</div>

<div class="bg-white shadow rounded-lg p-5">

Stock Out

<h2 class="text-3xl font-bold">

{{ $summary['stock_out'] }}

</h2>

</div>

<div class="bg-white shadow rounded-lg p-5">

Stock Opname

<h2 class="text-3xl font-bold">

{{ $summary['stock_opname'] }}

</h2>


</div>

</div>
@include('pages.report.partials.product-table')
@include('pages.report.partials.category-table')
@include('pages.report.partials.supplier-table')
@include('pages.report.partials.user-table')
@include('pages.report.partials.inventory-table')

@endif

</div>

@endsection
