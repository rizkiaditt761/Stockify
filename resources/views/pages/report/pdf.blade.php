<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        Stockify Report
    </title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
        }

        h1,h2,h3{
            margin:0;
        }

        h1{
            text-align:center;
            margin-bottom:8px;
        }

        p{
            margin:4px 0 15px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-bottom:25px;
        }

        th{
            border:1px solid #000;
            padding:6px;
            background:#eeeeee;
        }

        td{
            border:1px solid #000;
            padding:6px;
        }

        .summary{

            width:100%;
            margin-bottom:25px;

        }

        .summary td{

            border:1px solid #444;
            padding:8px;

        }

    </style>

</head>

<body>

<h1>

    STOCKIFY REPORT

</h1>

<p>

    Printed :
    {{ now()->format('d M Y H:i') }}

    <br>

    Report :
    {{ ucfirst($type) }}

    @if($startDate && $endDate)

        <br>

        Period :
        {{ $startDate }}
        -
        {{ $endDate }}

    @endif

</p>

<table class="summary">

<tr>

<td>
Total Product
</td>

<td>
{{ $summary['total_products'] }}
</td>

<td>
Total Supplier
</td>

<td>
{{ $summary['total_suppliers'] }}
</td>

<td>
Total User
</td>

<td>
{{ $summary['total_users'] }}
</td>

</tr>

<tr>

<td>
Stock In
</td>

<td>
{{ $summary['stock_in'] }}
</td>

<td>
Stock Out
</td>

<td>
{{ $summary['stock_out'] }}
</td>

<td>
Stock Opname
</td>

<td>
{{ $summary['stock_opname'] }}
</td>

</tr>

</table>

@if($type=='product' || $type=='all')

<h2>

Product

</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>Product</th>
<th>Category</th>
<th>Supplier</th>
<th>Stock</th>
<th>Minimum</th>

</tr>

</thead>

<tbody>

@foreach($products as $product)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $product->name }}</td>

<td>{{ $product->category->name }}</td>

<td>{{ $product->supplier->name }}</td>

<td>{{ $product->stock }}</td>

<td>{{ $product->minimum_stock }}</td>

</tr>

@endforeach

</tbody>

</table>

@endif

@if($type=='category' || $type=='all')

<h2>

Category

</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>Name</th>
<th>Total Product</th>

</tr>

</thead>

<tbody>

@foreach($categories as $category)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $category->name }}</td>

<td>{{ $category->products_count }}</td>

</tr>

@endforeach

</tbody>

</table>

@endif

@if($type=='supplier' || $type=='all')

<h2>

Supplier

</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>

</tr>

</thead>

<tbody>

@foreach($suppliers as $supplier)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $supplier->name }}</td>

<td>{{ $supplier->email }}</td>

<td>{{ $supplier->phone }}</td>

</tr>

@endforeach

</tbody>

</table>

@endif

@if($type=='user' || $type=='all')

<h2>

User

</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>

</tr>

</thead>

<tbody>

@foreach($users as $user)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $user->name }}</td>

<td>{{ $user->email }}</td>

<td>{{ ucfirst($user->role) }}</td>

</tr>

@endforeach

</tbody>

</table>

@endif

@if($type=='stock' || $type=='all')

<h2>

Inventory Transaction

</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>Date</th>
<th>Product</th>
<th>Type</th>
<th>Qty</th>

</tr>

</thead>

<tbody>

@foreach($transactions as $transaction)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $transaction->transaction_date }}</td>

<td>{{ $transaction->product->name }}</td>

<td>{{ $transaction->type }}</td>

<td>{{ $transaction->quantity }}</td>

</tr>

@endforeach

</tbody>

</table>

<h2>

Stock Opname

</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>Date</th>
<th>Product</th>
<th>System</th>
<th>Physical</th>
<th>Difference</th>

</tr>

</thead>

<tbody>

@foreach($opnames as $opname)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $opname->created_at }}</td>

<td>{{ $opname->product->name }}</td>

<td>{{ $opname->system_stock }}</td>

<td>{{ $opname->physical_stock }}</td>

<td>{{ $opname->difference }}</td>

</tr>

@endforeach

</tbody>

</table>

@endif

</body>

</html>