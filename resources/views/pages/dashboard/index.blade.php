@extends('layouts.dashboard')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Dashboard
        </h1>

        <p class="text-gray-500 mt-2">
            Welcome back! Here's an overview of your warehouse today.
        </p>

    </div>

    <div class="mt-4 md:mt-0 text-right">

        <p class="text-sm text-gray-500">
            Today
        </p>

        <h2 class="text-lg font-semibold text-gray-700">
            {{ now()->format('d F Y') }}
        </h2>

    </div>

</div>

{{-- Statistic Card --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition border border-gray-100 p-6">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500 text-sm">
                    Total Products
                </p>

                <h2 class="text-4xl font-bold mt-2 text-gray-800">

                    {{ $totalProducts }}

                </h2>

                <p class="text-blue-600 text-sm mt-2">

                    Registered products

                </p>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-blue-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M20 7L12 3L4 7L12 11L20 7ZM4 12L12 16L20 12M4 17L12 21L20 17"/>

                </svg>

            </div>

        </div>

    </div>

    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition border border-gray-100 p-6">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500 text-sm">
                    Categories
                </p>

                <h2 class="text-4xl font-bold mt-2 text-gray-800">

                    {{ $totalCategories }}

                </h2>

                <p class="text-green-600 text-sm mt-2">

                    Available category

                </p>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-green-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 7L12 3L21 7L12 11L3 7ZM3 17L12 21L21 17"/>

                </svg>

            </div>

        </div>

    </div>

    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition border border-gray-100 p-6">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500 text-sm">
                    Suppliers
                </p>

                <h2 class="text-4xl font-bold mt-2 text-gray-800">

                    {{ $totalSuppliers }}

                </h2>

                <p class="text-yellow-600 text-sm mt-2">

                    Active supplier

                </p>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-yellow-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 17V6l-2 2m8 9V6l2 2"/>

                </svg>

            </div>

        </div>

    </div>

    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition border border-gray-100 p-6">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500 text-sm">
                    Transactions
                </p>

                <h2 class="text-4xl font-bold mt-2 text-gray-800">

                    {{ $totalTransactions }}

                </h2>

                <p class="text-purple-600 text-sm mt-2">

                    Warehouse activity

                </p>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-purple-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 17v-6h13M9 5v6h13M3 5h.01M3 17h.01"/>

                </svg>

            </div>

        </div>

    </div>

</div>

{{-- Quick Action --}}
<div class="grid lg:grid-cols-3 gap-6 mt-8">

    <a href="{{ route('products.create') }}"
        class="group bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl text-white p-7 hover:scale-[1.02] transition shadow-lg">

        <h3 class="font-bold text-xl">

            Add Product

        </h3>

        <p class="mt-2 text-blue-100">

            Register a new warehouse product.

        </p>

    </a>

    <a href="{{ route('stock_transactions.create') }}"
        class="group bg-gradient-to-r from-green-600 to-green-700 rounded-2xl text-white p-7 hover:scale-[1.02] transition shadow-lg">

        <h3 class="font-bold text-xl">

            Stock Transaction

        </h3>

        <p class="mt-2 text-green-100">

            Record stock movement.

        </p>

    </a>

    <a href="{{ route('reports.index') }}"
        class="group bg-gradient-to-r from-purple-600 to-purple-700 rounded-2xl text-white p-7 hover:scale-[1.02] transition shadow-lg">

        <h3 class="font-bold text-xl">

            Reports

        </h3>

        <p class="mt-2 text-purple-100">

            View warehouse reports.

        </p>

    </a>

</div>

{{-- Chart --}}
<div class="bg-white rounded-2xl shadow mt-8">

    <div class="flex justify-between items-center px-6 py-5 border-b">

        <h2 class="font-bold text-lg text-gray-800">

            Stock Movement (Last 7 Days)

        </h2>

        <span class="text-sm text-gray-400">

            Updated automatically

        </span>

    </div>

    <div class="p-6">

        <canvas id="transactionChart" height="90"></canvas>

    </div>

</div>

{{-- Low Stock & Latest Product --}}
<div class="grid lg:grid-cols-2 gap-6 mt-8">

    {{-- Low Stock --}}
    <div class="bg-white rounded-2xl shadow">

        <div class="flex justify-between items-center px-6 py-4 border-b">

            <h2 class="font-bold text-lg text-gray-800">

                Low Stock Alert

            </h2>

            <span class="text-xs bg-red-100 text-red-600 px-3 py-1 rounded-full">

                Need Attention

            </span>

        </div>

        <div class="divide-y">

            @forelse($lowStocks as $product)

                <div class="flex justify-between items-center px-6 py-4 hover:bg-gray-50 transition">

                    <div>

                        <h3 class="font-semibold text-gray-800">

                            {{ $product->name }}

                        </h3>

                        <p class="text-sm text-gray-500">

                            {{ $product->category->name }}

                        </p>

                    </div>

                    <span
                        class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-bold">

                        {{ $product->stock }}

                    </span>

                </div>

            @empty

                <div class="py-14 text-center">

                    <div class="text-5xl mb-2">

                        🎉

                    </div>

                    <p class="text-green-600 font-semibold">

                        All stock levels are safe

                    </p>

                </div>

            @endforelse

        </div>

    </div>

    {{-- Latest Product --}}
    <div class="bg-white rounded-2xl shadow">

        <div class="flex justify-between items-center px-6 py-4 border-b">

            <h2 class="font-bold text-lg text-gray-800">

                Latest Products

            </h2>

            <span class="text-xs text-gray-400">

                Recently Added

            </span>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-sm">

                            Product

                        </th>

                        <th class="px-6 py-3 text-left text-sm">

                            Category

                        </th>

                        <th class="px-6 py-3 text-left text-sm">

                            Stock

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($latestProducts as $product)

                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-medium">

                                {{ $product->name }}

                            </td>

                            <td class="px-6 py-4 text-gray-500">

                                {{ $product->category->name }}

                            </td>

                            <td class="px-6 py-4">

                                <span
                                    class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">

                                    {{ $product->stock }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3"
                                class="text-center py-10 text-gray-400">

                                No product available.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- Recent Transaction --}}
<div class="bg-white rounded-2xl shadow mt-8">

    <div class="flex justify-between items-center px-6 py-5 border-b">

        <h2 class="font-bold text-lg text-gray-800">

            Recent Transactions

        </h2>

        <a href="{{ route('stock_transactions.index') }}"
            class="text-blue-600 text-sm hover:underline">

            View All

        </a>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-3 text-left">

                        Product

                    </th>

                    <th class="px-6 py-3 text-left">

                        Type

                    </th>

                    <th class="px-6 py-3 text-left">

                        Qty

                    </th>

                    <th class="px-6 py-3 text-left">

                        User

                    </th>

                    <th class="px-6 py-3 text-left">

                        Date

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($recentTransactions as $transaction)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="px-6 py-4">

                            {{ $transaction->product->name }}

                        </td>

                        <td class="px-6 py-4">

                            @if(strtoupper($transaction->type)=='IN')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">

                                    Stock In

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">

                                    Stock Out

                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4 font-semibold">

                            {{ $transaction->quantity }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $transaction->user->name }}

                        </td>

                        <td class="px-6 py-4 text-gray-500">

                            {{ $transaction->created_at->format('d M Y H:i') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="text-center py-10 text-gray-400">

                            No transaction available.

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
        month: 'short',
        day: 'numeric'
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

                label: 'Stock In',

                data: dataIn,

                borderColor: '#2563eb',

                backgroundColor: 'rgba(37,99,235,.12)',

                fill: true,

                tension: .4,

                borderWidth: 3,

                pointRadius: 4,

                pointHoverRadius: 6

            },

            {

                label: 'Stock Out',

                data: dataOut,

                borderColor: '#ef4444',

                backgroundColor: 'rgba(239,68,68,.12)',

                fill: true,

                tension: .4,

                borderWidth: 3,

                pointRadius: 4,

                pointHoverRadius: 6

            }

        ]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        interaction: {

            mode: 'index',

            intersect: false

        },

        plugins: {

            legend: {

                position: 'top',

                labels: {

                    usePointStyle: true,

                    pointStyle: 'circle',

                    padding: 20

                }

            }

        },

        scales: {

            x: {

                grid: {

                    display: false

                }

            },

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