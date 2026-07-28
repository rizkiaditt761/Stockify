@extends('layouts.dashboard')

@section('content')

<div class="p-6">


{{-- Header --}}
<div class="mb-6 flex items-center justify-between">


    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Stock Opname
        </h1>


        <p class="mt-1 text-sm text-gray-500">
            Catat hasil pengecekan fisik dan lakukan penyesuaian stok barang.
        </p>


    </div>


</div>











{{-- Summary Cards --}}
<div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-3">



{{-- Total Opname --}}
<div
class="rounded-xl border border-blue-200 bg-white p-6 transition-all hover:-translate-y-1 hover:shadow-lg">


<div class="flex justify-between">


<div>

<p class="text-sm text-gray-500">
Total Opname
</p>


<h2 class="mt-2 text-4xl font-bold text-blue-600">

{{ $totalOpname }}

</h2>


<p class="mt-1 text-sm text-gray-500">
Pengecekan
</p>


</div>



<div
class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 text-2xl">

📋

</div>


</div>


</div>







{{-- Penyesuaian Naik --}}
<div
class="rounded-xl border border-green-200 bg-white p-6 transition-all hover:-translate-y-1 hover:shadow-lg">


<div class="flex justify-between">


<div>


<p class="text-sm text-gray-500">
Penyesuaian Naik
</p>


<h2 class="mt-2 text-4xl font-bold text-green-600">

{{ $totalIncrease }}

</h2>


<p class="mt-1 text-sm text-gray-500">
Riwayat Penyesuaian
</p>


</div>




<div
class="flex h-14 w-14 items-center justify-center rounded-full bg-green-100 text-2xl">

📈

</div>


</div>


</div>







{{-- Penyesuaian Turun --}}
<div
class="rounded-xl border border-red-200 bg-white p-6 transition-all hover:-translate-y-1 hover:shadow-lg">


<div class="flex justify-between">


<div>


<p class="text-sm text-gray-500">
Penyesuaian Turun
</p>


<h2 class="mt-2 text-4xl font-bold text-red-600">

{{ $totalDecrease }}

</h2>


<p class="mt-1 text-sm text-gray-500">
Riwayat Penyesuaian
</p>


</div>




<div
class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100 text-2xl">

📉

</div>


</div>


</div>



</div>







{{-- Filter Periode --}}
<form
method="GET"
class="mb-6 rounded-xl border border-gray-200 bg-white p-5 shadow-sm">


<div class="grid grid-cols-1 gap-4 md:grid-cols-3">





<div>

<label class="mb-2 block text-sm font-medium text-gray-700">

Tanggal Awal

</label>


<input
type="date"
name="start_date"
value="{{ request('start_date') }}"
class="w-full rounded-lg border border-gray-300 px-4 py-2.5">


</div>







<div>

<label class="mb-2 block text-sm font-medium text-gray-700">

Tanggal Akhir

</label>


<input
type="date"
name="end_date"
value="{{ request('end_date') }}"
class="w-full rounded-lg border border-gray-300 px-4 py-2.5">


</div>







<div class="flex items-end gap-3">


<button
type="submit"
class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">


Filter


</button>




<a
href="{{ route('stock.opname.index') }}"
class="rounded-lg bg-gray-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-700">


Reset


</a>



</div>



</div>


</form>
{{-- Form Stock Opname --}}
@if(auth()->user()->role == 'manager')


<div class="mb-8 rounded-xl border border-gray-200 bg-white shadow-sm">


    <div class="border-b border-gray-200 px-6 py-4">


        <h2 class="text-lg font-semibold text-gray-800">

            Form Stock Opname

        </h2>


        <p class="mt-1 text-sm text-gray-500">

            Masukkan hasil pengecekan fisik stok untuk dibandingkan dengan stok sistem.

        </p>


    </div>






<form
action="{{ route('stock.opname.store') }}"
method="POST"
class="p-6">


@csrf





<div class="grid grid-cols-1 gap-6 md:grid-cols-3">





{{-- Produk --}}
<div>


<label class="mb-2 block text-sm font-medium text-gray-700">

Produk

</label>



<select
id="product"
name="product_id"
class="w-full rounded-lg border border-gray-300 px-4 py-2.5">


@foreach($products as $product)


<option
value="{{ $product->id }}"
data-stock="{{ $product->stock }}">


{{ $product->name }}


</option>


@endforeach


</select>


</div>








{{-- Stok Sistem --}}
<div>


<label class="mb-2 block text-sm font-medium text-gray-700">

Stok Sistem

</label>



<input
id="systemStock"
type="number"
readonly
class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2.5">


</div>








{{-- Stok Fisik --}}
<div>


<label class="mb-2 block text-sm font-medium text-gray-700">

Stok Fisik Hasil Cek

</label>



<input
id="physicalStock"
type="number"
name="physical_stock"
min="0"
required
class="w-full rounded-lg border border-gray-300 px-4 py-2.5"
placeholder="Masukkan jumlah fisik">


</div>



</div>







{{-- Penyesuaian --}}
<div class="mt-6">


<div class="rounded-lg border border-gray-200 bg-gray-50 p-4">


<p class="text-sm text-gray-500">

Penyesuaian Stok

</p>



<h3
id="difference"
class="mt-1 text-3xl font-bold text-blue-600">

0

</h3>



<p class="mt-1 text-xs text-gray-500">

Nilai positif menambah stok, nilai negatif mengurangi stok.

</p>



</div>


</div>







{{-- Catatan --}}
<div class="mt-6">


<label class="mb-2 block text-sm font-medium text-gray-700">

Keterangan

</label>



<input
type="text"
name="note"
placeholder="Contoh: Hasil pengecekan rak A"
class="w-full rounded-lg border border-gray-300 px-4 py-2.5">


</div>








<div class="mt-6 flex justify-end">


<button
type="submit"
class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-medium text-white hover:bg-blue-700">


Simpan Stock Opname


</button>


</div>




</form>


</div>


@endif
{{-- Riwayat Stock Opname --}}

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">



<div class="border-b border-gray-200 px-6 py-4">


<h2 class="text-lg font-semibold text-gray-800">

Riwayat Stock Opname

</h2>



<p class="mt-1 text-sm text-gray-500">

Daftar hasil pengecekan dan penyesuaian stok barang.

</p>


</div>







<div class="overflow-x-auto">


<table class="w-full text-sm">



<thead class="bg-gray-50 text-xs uppercase text-gray-600">


<tr>


<th class="px-6 py-4 text-center">
No
</th>


<th class="px-6 py-4 text-left">
Produk
</th>


<th class="px-6 py-4 text-center">
Stok Sistem
</th>


<th class="px-6 py-4 text-center">
Stok Fisik
</th>


<th class="px-6 py-4 text-center">
Penyesuaian
</th>


<th class="px-6 py-4 text-left">
Keterangan
</th>


<th class="px-6 py-4 text-left">
Dibuat Oleh
</th>


<th class="px-6 py-4 text-center">
Tanggal
</th>


</tr>


</thead>







<tbody>


@forelse($opnames as $opname)


<tr class="border-t hover:bg-gray-50">





<td class="px-6 py-4 text-center">

{{ $opnames->firstItem() + $loop->index }}

</td>








<td class="px-6 py-4 font-medium text-gray-800">


{{ $opname->product->name }}


</td>








<td class="px-6 py-4 text-center">


{{ $opname->system_stock }}


</td>








<td class="px-6 py-4 text-center font-semibold">


{{ $opname->physical_stock }}


</td>








{{-- Penyesuaian --}}

<td class="px-6 py-4 text-center">



@if($opname->difference > 0)



<span
class="inline-flex whitespace-nowrap rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">


+{{ $opname->difference }}


</span>



@elseif($opname->difference < 0)



<span
class="inline-flex whitespace-nowrap rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">


{{ $opname->difference }}


</span>



@else



<span
class="inline-flex whitespace-nowrap rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">


0


</span>



@endif



</td>








<td class="px-6 py-4">


@if($opname->note)


{{ $opname->note }}



@else


<span class="text-gray-400">

-

</span>


@endif



</td>









<td class="px-6 py-4">


{{ $opname->user->name ?? '-' }}


</td>








<td class="px-6 py-4 text-center whitespace-nowrap">


{{ $opname->created_at->format('d M Y') }}



<br>


<span class="text-xs text-gray-500">


{{ $opname->created_at->format('H:i') }}


</span>


</td>





</tr>




@empty



<tr>


<td
colspan="8"
class="py-12 text-center text-gray-500">


Belum ada data Stock Opname.


</td>


</tr>



@endforelse



</tbody>



</table>



</div>







{{-- Pagination --}}

@if($opnames->hasPages())


<div class="border-t border-gray-200 px-6 py-4">


{{ $opnames->links() }}


</div>


@endif




</div>





<script>

document.addEventListener(
    'DOMContentLoaded',
    function(){


        const product = document.getElementById('product');
        const systemStock = document.getElementById('systemStock');
        const physicalStock = document.getElementById('physicalStock');
        const difference = document.getElementById('difference');



        if(
            product &&
            systemStock &&
            physicalStock &&
            difference
        ){



            function updateDifference(){


                const currentStock = Number(
                    product.options[
                        product.selectedIndex
                    ].dataset.stock
                );



                systemStock.value = currentStock;



                const physical = Number(
                    physicalStock.value || 0
                );



                const diff = physical - currentStock;



                difference.innerText =
                    diff > 0
                    ? '+' + diff
                    : diff;



                difference.className =
                    'mt-1 text-3xl font-bold';



                if(diff > 0){


                    difference.classList.add(
                        'text-green-600'
                    );


                }
                else if(diff < 0){


                    difference.classList.add(
                        'text-red-600'
                    );


                }
                else{


                    difference.classList.add(
                        'text-blue-600'
                    );


                }



            }





            product.addEventListener(
                'change',
                updateDifference
            );



            physicalStock.addEventListener(
                'input',
                updateDifference
            );



            updateDifference();


        }


    }

);

</script>


@endsection