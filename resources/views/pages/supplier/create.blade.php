@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Tambah Supplier
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Tambahkan supplier baru yang akan digunakan pada sistem.
            </p>

        </div>


    </div>


    {{-- Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        <form
            action="{{ route('suppliers.store') }}"
            method="POST"
            class="p-6">

            @csrf

            @if ($errors->any())

                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                    <h3 class="font-semibold text-red-700 mb-2">
                        Terjadi kesalahan
                    </h3>

                    <ul class="list-disc list-inside text-sm text-red-600">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nama Supplier
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama supplier"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600">

                </div>


                {{-- Nomor HP --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600">

                </div>

            </div>


            {{-- Email --}}
            <div class="mt-6">

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="supplier@email.com"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600">

            </div>


            {{-- Alamat --}}
            <div class="mt-6">

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Alamat
                </label>

                <textarea
                    name="address"
                    rows="4"
                    placeholder="Masukkan alamat supplier"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600">{{ old('address') }}</textarea>

            </div>


            {{-- Button --}}
            <div class="flex gap-3 mt-8">

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-blue-700 text-white hover:bg-blue-800 transition">

                    Simpan Supplier

                </button>

                <a href="{{ route('suppliers.index') }}"
                    class="px-5 py-2.5 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection