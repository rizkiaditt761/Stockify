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

    {{ ucfirst($report) }}



    @if(!empty($start_date) && !empty($end_date))


        <br>


        Period :

        {{ $start_date }}

        -

        {{ $end_date }}


    @endif


</p>





{{-- ================================================= --}}
{{-- SUMMARY --}}
{{-- ================================================= --}}



<table class="summary">



@if($report == 'stock')



<tr>


<td>

Total Product

</td>


<td>

{{ $summary['total_products'] ?? 0 }}

</td>



<td>

Total Stock

</td>


<td>

{{ $summary['total_stock'] ?? 0 }}

</td>



</tr>



@endif





@if($report == 'transaction')



<tr>


<td>

Total Transaction

</td>


<td>

{{ $summary['total_transaction'] ?? 0 }}

</td>



<td>

Barang Masuk

</td>


<td>

{{ $summary['stock_in'] ?? 0 }}

</td>



<td>

Barang Keluar

</td>


<td>

{{ $summary['stock_out'] ?? 0 }}

</td>



</tr>



@endif






@if($report == 'activity')



<tr>


<td>

Total Activity

</td>


<td>

{{ $summary['total_activity'] ?? 0 }}

</td>



<td>

User Aktif

</td>


<td>

{{ $summary['total_user'] ?? 0 }}

</td>



</tr>



@endif





@if($report == 'all')



<tr>


<td>

Total Product

</td>


<td>

{{ $summary['total_products'] ?? 0 }}

</td>



<td>

Total Stock

</td>


<td>

{{ $summary['total_stock'] ?? 0 }}

</td>



<td>

Total Transaction

</td>


<td>

{{ $summary['total_transaction'] ?? 0 }}

</td>



</tr>



<tr>


<td>

Total Activity

</td>


<td>

{{ $summary['total_activity'] ?? 0 }}

</td>



</tr>



@endif



</table>
{{-- ================================================= --}}
{{-- PRODUCT STOCK REPORT --}}
{{-- ================================================= --}}



@if($report == 'stock')



<h2>

    Laporan Stok Barang

</h2>




<table>



<thead>


<tr>


<th>

No

</th>


<th>

Product

</th>


<th>

Category

</th>


<th>

Supplier

</th>


<th>

Stock

</th>


<th>

Minimum

</th>



</tr>



</thead>





<tbody>



@forelse($products as $product)



<tr>


<td>

{{ $loop->iteration }}

</td>




<td>


{{ $product->name }}


<br>


<small>

SKU : {{ $product->sku }}

</small>


</td>





<td>

{{ $product->category->name ?? '-' }}

</td>





<td>

{{ $product->supplier->name ?? '-' }}

</td>





<td>

{{ number_format($product->stock) }}

</td>





<td>

{{ number_format($product->minimum_stock) }}

</td>



</tr>




@empty



<tr>


<td 
colspan="6"
style="text-align:center">

Tidak ada data produk.

</td>


</tr>



@endforelse



</tbody>



</table>




@endif
{{-- ================================================= --}}
{{-- TRANSACTION REPORT --}}
{{-- ================================================= --}}



@if($report == 'transaction')



<h2>

    Laporan Barang Masuk & Keluar

</h2>




<table>



<thead>



<tr>


<th>

No

</th>


<th>

Tanggal

</th>


<th>

Produk

</th>


<th>

User

</th>


<th>

Type

</th>


<th>

Jumlah

</th>


<th>

Status

</th>



</tr>



</thead>





<tbody>



@forelse($transactions as $transaction)



<tr>



<td>

{{ $loop->iteration }}

</td>





<td>

{{ optional($transaction->transaction_date)->format('d M Y') }}

</td>





<td>


{{ $transaction->product->name ?? '-' }}


<br>


<small>

SKU :
{{ $transaction->product->sku ?? '-' }}

</small>


</td>





<td>

{{ $transaction->user->name ?? '-' }}

</td>





<td>

@if($transaction->type == 'IN')

    Barang Masuk

@else

    Barang Keluar

@endif

</td>





<td>

{{ number_format($transaction->quantity) }}

</td>





<td>


{{ ucfirst($transaction->status ?? '-') }}


</td>




</tr>




@empty



<tr>


<td 
colspan="7"
style="text-align:center">

Belum ada transaksi.

</td>


</tr>



@endforelse



</tbody>



</table>




@endif
{{-- ================================================= --}}
{{-- ACTIVITY REPORT --}}
{{-- ================================================= --}}



@if($report == 'activity')



<h2>

    Aktivitas Pengguna

</h2>




<table>



<thead>



<tr>


<th>

No

</th>


<th>

Waktu

</th>


<th>

User

</th>


<th>

Role

</th>


<th>

Module

</th>


<th>

Action

</th>


<th>

Description

</th>



</tr>



</thead>





<tbody>



@forelse($activities as $activity)



<tr>



<td>

{{ $loop->iteration }}

</td>





<td>

{{ optional($activity->created_at)->format('d M Y H:i') }}

</td>





<td>

{{ $activity->user->name ?? '-' }}

</td>





<td>

{{ ucfirst($activity->user->role ?? '-') }}

</td>





<td>

{{ $activity->module ?? '-' }}

</td>





<td>

{{ $activity->action ?? '-' }}

</td>





<td>

{{ $activity->description ?? '-' }}

</td>




</tr>




@empty



<tr>


<td 
colspan="7"
style="text-align:center">

Belum ada aktivitas.

</td>


</tr>



@endforelse



</tbody>



</table>




@endif




</body>


</html>