@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-5">
        Edit Supplier
    </h1>

    <form action="{{ route('suppliers.update',$supplier->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="flex justify-end mb-4">
            <a href="{{ route('suppliers.index', $supplier->id) }}"
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
                value="{{ old('name',$supplier->name) }}"
                class="w-full border rounded-lg p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Alamat
            </label>

            <textarea
                name="address"
                rows="3"
                class="w-full border rounded-lg p-2">{{ old('address',$supplier->address) }}</textarea>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Nomor HP
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone',$supplier->phone) }}"
                class="w-full border rounded-lg p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email',$supplier->email) }}"
                class="w-full border rounded-lg p-2">

        </div>

        <button
            type="submit"
            class="bg-blue-700 text-white px-5 py-2 rounded-lg">

            Update

        </button>

    </form>

</div>

@endsection