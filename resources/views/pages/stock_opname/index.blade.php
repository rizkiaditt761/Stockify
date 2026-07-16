@extends('layouts.dashboard')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        Stock Opname
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-5">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('stock.opname.store') }}" method="POST">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div>

                <label>Produk</label>

                <select
                    name="product_id"
                    class="w-full border rounded-lg p-2">

                    @foreach($products as $product)

                        <option value="{{ $product->id }}">
                            {{ $product->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label>Stok Fisik</label>

                <input
                    type="number"
                    name="physical_stock"
                    class="w-full border rounded-lg p-2"
                    required>

            </div>

            <div>

                <label>Keterangan</label>

                <input
                    type="text"
                    name="note"
                    class="w-full border rounded-lg p-2">

            </div>

        </div>

        <button
            class="mt-5 bg-blue-700 text-white px-5 py-2 rounded-lg">

            Simpan Stock Opname

        </button>

    </form>

    <hr class="my-8">

    <table class="w-full border">

        <thead class="bg-gray-100">

            <tr>

                <th class="border p-2">Produk</th>

                <th class="border p-2">Stok Sistem</th>

                <th class="border p-2">Stok Fisik</th>

                <th class="border p-2">Selisih</th>

                <th class="border p-2">Keterangan</th>

                <th class="border p-2">Tanggal</th>

            </tr>

        </thead>

        <tbody>

        @forelse($opnames as $opname)

            <tr>

                <td class="border p-2">
                    {{ $opname->product->name }}
                </td>

                <td class="border p-2">
                    {{ $opname->system_stock }}
                </td>

                <td class="border p-2">
                    {{ $opname->physical_stock }}
                </td>

                <td class="border p-2">

                    @if($opname->difference > 0)

                        <span class="text-green-600">
                            +{{ $opname->difference }}
                        </span>

                    @elseif($opname->difference < 0)

                        <span class="text-red-600">
                            {{ $opname->difference }}
                        </span>

                    @else

                        <span class="text-blue-600">
                            0
                        </span>

                    @endif

                </td>

                <td class="border p-2">
                    {{ $opname->note }}
                </td>

                <td class="border p-2">
                    {{ $opname->created_at->format('d-m-Y') }}
                </td>

            </tr>

        @empty

            <tr>

                <td
                    colspan="6"
                    class="border p-5 text-center">

                    Belum ada data stock opname.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection