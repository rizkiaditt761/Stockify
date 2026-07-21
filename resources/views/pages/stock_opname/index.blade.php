@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Stock Opname
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Sesuaikan stok sistem dengan hasil perhitungan fisik di gudang.
            </p>

        </div>

    </div>

    {{-- Alert --}}
    @if(session('success'))

        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif

    {{-- Form --}}
    <div class="mb-8 rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-200 px-6 py-4">

            <h2 class="text-lg font-semibold text-gray-800">
                Form Stock Opname
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Masukkan hasil perhitungan stok fisik produk.
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
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:ring-blue-500">

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
                        Stok Fisik
                    </label>

                    <input
                        id="physicalStock"
                        type="number"
                        name="physical_stock"
                        min="0"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:ring-blue-500">

                </div>

            </div>

            {{-- Selisih --}}
            <div class="mt-6">

                <div class="rounded-lg bg-gray-50 p-4 border border-gray-200">

                    <p class="text-sm text-gray-500">

                        Selisih Stok

                    </p>

                    <h3
                        id="difference"
                        class="mt-1 text-3xl font-bold text-gray-700">

                        0

                    </h3>

                </div>

            </div>

            {{-- Keterangan --}}
            <div class="mt-6">

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Keterangan
                </label>

                <input
                    type="text"
                    name="note"
                    placeholder="Contoh: Rak A dihitung ulang"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:ring-blue-500">

            </div>

            <div class="mt-6 flex justify-end">

                <button
                    type="submit"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">

                    Simpan Stock Opname

                </button>

            </div>

        </form>

    </div>

        {{-- Riwayat Stock Opname --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-200 px-6 py-4">

            <h2 class="text-lg font-semibold text-gray-800">
                Riwayat Stock Opname
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Daftar seluruh hasil penyesuaian stok yang pernah dilakukan.
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
                            Selisih
                        </th>

                        <th class="px-6 py-4 text-left">
                            Keterangan
                        </th>

                        <th class="px-6 py-4 text-center">
                            Tanggal
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($opnames as $opname)

                    <tr class="border-t transition hover:bg-gray-50">

                        <td class="px-6 py-4 text-center">

                            {{ $loop->iteration }}

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

                        <td class="px-6 py-4 text-center">

                            @if($opname->difference > 0)

                                <span class="inline-flex whitespace-nowrap rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                    +{{ $opname->difference }}

                                </span>

                            @elseif($opname->difference < 0)

                                <span class="inline-flex whitespace-nowrap rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                                    {{ $opname->difference }}

                                </span>

                            @else

                                <span class="inline-flex whitespace-nowrap rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">

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
                            colspan="6"
                            class="py-12 text-center text-gray-500">

                            Belum ada data Stock Opname.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

const product = document.getElementById('product');
const systemStock = document.getElementById('systemStock');
const physicalStock = document.getElementById('physicalStock');
const difference = document.getElementById('difference');

function updateDifference(){

    const currentStock = Number(
        product.options[product.selectedIndex].dataset.stock
    );

    systemStock.value = currentStock;

    const physical = Number(
        physicalStock.value || 0
    );

    const diff = physical - currentStock;

    difference.innerText =
        diff > 0 ? '+' + diff : diff;

    difference.className =
        'mt-1 text-3xl font-bold';

    if(diff > 0){

        difference.classList.add(
            'text-green-600'
        );

    }else if(diff < 0){

        difference.classList.add(
            'text-red-600'
        );

    }else{

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

</script>

@endsection