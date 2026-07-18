@extends('layouts.dashboard')

@section('content')

<h1 class="text-3xl font-bold text-gray-800 mb-8">
    Dashboard
</h1>

{{-- Statistic Card --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-600">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Products</p>
                <h2 class="text-3xl font-bold mt-2">{{ $totalProducts }}</h2>
                <p class="text-gray-400 text-sm mt-1">Registered Products</p>
            </div>

            <div class="bg-blue-100 p-4 rounded-full text-2xl">
                📦
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-600">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Categories</p>
                <h2 class="text-3xl font-bold mt-2">{{ $totalCategories }}</h2>
                <p class="text-gray-400 text-sm mt-1">Available Categories</p>
            </div>

            <div class="bg-green-100 p-4 rounded-full text-2xl">
                📂
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Suppliers</p>
                <h2 class="text-3xl font-bold mt-2">{{ $totalSuppliers }}</h2>
                <p class="text-gray-400 text-sm mt-1">Active Suppliers</p>
            </div>

            <div class="bg-yellow-100 p-4 rounded-full text-2xl">
                🚚
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-600">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Transactions</p>
                <h2 class="text-3xl font-bold mt-2">{{ $totalTransactions }}</h2>
                <p class="text-gray-400 text-sm mt-1">Total Activity</p>
            </div>

            <div class="bg-purple-100 p-4 rounded-full text-2xl">
                📊
            </div>
        </div>
    </div>

</div>

{{-- Quick Action --}}
<div class="grid md:grid-cols-3 gap-6 mt-8">

    <a href="{{ route('products.create') }}"
        class="bg-blue-600 text-white rounded-xl p-6 shadow hover:bg-blue-700 transition">

        <h3 class="text-xl font-bold">➕ Add Product</h3>

        <p class="mt-2 text-blue-100">
            Register new warehouse product
        </p>

    </a>

    <a href="{{ route('stock_transactions.create') }}"
        class="bg-green-600 text-white rounded-xl p-6 shadow hover:bg-green-700 transition">

        <h3 class="text-xl font-bold">📥 Stock Transaction</h3>

        <p class="mt-2 text-green-100">
            Record stock movement
        </p>

    </a>

    <a href="{{ route('reports.index') }}"
        class="bg-purple-600 text-white rounded-xl p-6 shadow hover:bg-purple-700 transition">

        <h3 class="text-xl font-bold">📑 Reports</h3>

        <p class="mt-2 text-purple-100">
            View warehouse reports
        </p>

    </a>

</div>

<div class="bg-white rounded-xl shadow mt-8">

    <div class="px-6 py-4 border-b">

        <h2 class="font-semibold text-lg">
            📈 Stock Movement (Last 7 Days)
        </h2>

    </div>

    <div class="p-6">

        <canvas id="transactionChart" height="90"></canvas>

    </div>

</div>

{{-- Low Stock & Latest Product --}}
<div class="grid lg:grid-cols-2 gap-6 mt-8">

    {{-- Low Stock --}}
    <div class="bg-white rounded-xl shadow">

        <div class="px-6 py-4 border-b">
            <h2 class="font-semibold text-lg">
                ⚠ Low Stock Alert
            </h2>
        </div>

        <div class="divide-y">

            @forelse($lowStocks as $product)

                <div class="flex justify-between items-center px-6 py-4">

                    <div>

                        <h3 class="font-semibold">
                            {{ $product->name }}
                        </h3>

                        <p class="text-gray-500 text-sm">
                            {{ $product->category->name }}
                        </p>

                    </div>

                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full font-bold">

                        {{ $product->stock }}

                    </span>

                </div>

            @empty

                <div class="text-center py-10 text-green-600">

                    🎉 All stock levels are safe.

                </div>

            @endforelse

        </div>

    </div>

    {{-- Latest Products --}}
    <div class="bg-white rounded-xl shadow">

        <div class="px-6 py-4 border-b">

            <h2 class="font-semibold text-lg">

                🆕 Latest Products

            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left">Product</th>

                        <th class="px-6 py-3 text-left">Category</th>

                        <th class="px-6 py-3 text-left">Stock</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($latestProducts as $product)

                        <tr class="border-t">

                            <td class="px-6 py-4">

                                {{ $product->name }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $product->category->name }}

                            </td>

                            <td class="px-6 py-4 font-semibold">

                                {{ $product->stock }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="text-center py-8 text-gray-400">

                                No products available.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- Recent Transaction --}}
<div class="bg-white rounded-xl shadow mt-8">

    <div class="px-6 py-4 border-b">

        <h2 class="font-semibold text-lg">

            Recent Transactions

        </h2>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-3 text-left">Product</th>

                    <th class="px-6 py-3 text-left">Type</th>

                    <th class="px-6 py-3 text-left">Qty</th>

                    <th class="px-6 py-3 text-left">User</th>

                    <th class="px-6 py-3 text-left">Date</th>

                </tr>

            </thead>

            <tbody>

                @forelse($recentTransactions as $transaction)

                    <tr class="border-t">

                        <td class="px-6 py-4">

                            {{ $transaction->product->name }}

                        </td>

                        <td class="px-6 py-4">

                            @if(strtoupper($transaction->type) == 'IN')

                                <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                    IN
                                </span>

                            @else

                                <span class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                    OUT
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            {{ $transaction->quantity }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $transaction->user->name }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $transaction->created_at->format('d M Y H:i') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-8 text-gray-400">

                            No transactions yet.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const chartData = @json($transactionChart);

const labels = chartData.map(item => {

    return new Date(item.date).toLocaleDateString('en-US', {
        weekday: 'short'
    });

});

const dataIn = chartData.map(item => Number(item.total_in));

const dataOut = chartData.map(item => Number(item.total_out));

new Chart(document.getElementById('transactionChart'), {

    type: 'line',

    data: {

        labels: labels,

        datasets: [

            {
                label: 'Stock IN',
                data: dataIn,
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34,197,94,0.15)',
                borderWidth: 3,
                tension: 0.35,
                fill: true
            },

            {
                label: 'Stock OUT',
                data: dataOut,
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239,68,68,0.15)',
                borderWidth: 3,
                tension: 0.35,
                fill: true
            }

        ]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                position: 'top'

            }

        },

        scales: {

            y: {

                beginAtZero: true,
                ticks: {
                    precision: 0
                }

            }

        }

    }

});

</script>

@endsection