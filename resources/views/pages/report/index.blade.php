@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-6">
        Reports
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <a href="#"
            class="bg-white border rounded-xl shadow p-6 hover:bg-gray-50">

            <h2 class="font-bold text-lg">
                Product Report
            </h2>

            <p class="text-gray-500 mt-2">
                View all products.
            </p>

        </a>

        <a href="#"
            class="bg-white border rounded-xl shadow p-6 hover:bg-gray-50">

            <h2 class="font-bold text-lg">
                Transaction Report
            </h2>

            <p class="text-gray-500 mt-2">
                View stock transactions.
            </p>

        </a>

        <a href="#"
            class="bg-white border rounded-xl shadow p-6 hover:bg-gray-50">

            <h2 class="font-bold text-lg">
                Stock Opname Report
            </h2>

            <p class="text-gray-500 mt-2">
                View stock opname history.
            </p>

        </a>

        <a href="#"
            class="bg-white border rounded-xl shadow p-6 hover:bg-gray-50">

            <h2 class="font-bold text-lg">
                Supplier Report
            </h2>

            <p class="text-gray-500 mt-2">
                View suppliers.
            </p>

        </a>

    </div>

</div>

@endsection