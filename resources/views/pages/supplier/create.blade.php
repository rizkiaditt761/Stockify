@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-5">
        Add Supplier
    </h1>

    <form action="{{ route('suppliers.store') }}" method="POST">

        @csrf

        <div class="flex justify-end mb-4">
            <a href="{{ route('suppliers.index') }}"
            class="px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 ">
            Batal
            </a>
        </div>


        <div class="mb-4">

            <label class="block mb-2">
                Nama Supplier
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border rounded-lg p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Alamat
            </label>

            <textarea
                name="address"
                rows="3"
                class="w-full border rounded-lg p-2">{{ old('address') }}</textarea>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Nomor HP
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                class="w-full border rounded-lg p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border rounded-lg p-2">

        </div>

        <button 
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Simpan
        </button>

    </form>

</div>

@endsection