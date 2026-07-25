@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Tambah Supplier
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Tambahkan supplier baru yang akan digunakan pada sistem Stockify.
            </p>

        </div>

        <a href="{{ route('suppliers.index') }}"
            class="mt-4 md:mt-0 px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300">

            ← Kembali

        </a>

    </div>



    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <form
            action="{{ route('suppliers.store') }}"
            method="POST">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama Supplier --}}
                <div>

                    <label class="block mb-2 text-sm font-semibold text-gray-700">

                        Nama Supplier <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Contoh : PT Maju Jaya"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">

                    @error('name')

                        <p class="mt-2 text-sm text-red-600">

                            {{ $message }}

                        </p>

                    @enderror

                </div>



                {{-- Nomor HP --}}
                <div>

                    <label class="block mb-2 text-sm font-semibold text-gray-700">

                        Nomor HP <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">

                    @error('phone')

                        <p class="mt-2 text-sm text-red-600">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

            </div>



            {{-- Email --}}
            <div class="mt-6">

                <label class="block mb-2 text-sm font-semibold text-gray-700">

                    Email

                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="supplier@email.com"
                    class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">

                @error('email')

                    <p class="mt-2 text-sm text-red-600">

                        {{ $message }}

                    </p>

                @enderror

            </div>



            {{-- Alamat --}}
            <div class="mt-6">

                <label class="block mb-2 text-sm font-semibold text-gray-700">

                    Alamat

                </label>

                <textarea
                    name="address"
                    rows="4"
                    placeholder="Masukkan alamat lengkap supplier"
                    class="w-full rounded-xl border-gray-300 focus:border-blue-600 focus:ring-blue-600">{{ old('address') }}</textarea>

                @error('address')

                    <p class="mt-2 text-sm text-red-600">

                        {{ $message }}

                    </p>

                @enderror

            </div>



            {{-- Button --}}
            <div class="flex flex-wrap gap-3 mt-8">

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 text-white font-medium hover:bg-blue-700 transition">

                    Simpan Supplier

                </button>

                <a href="{{ route('suppliers.index') }}"
                    class="px-6 py-3 rounded-xl bg-gray-200 text-gray-700 font-medium hover:bg-gray-300 transition">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection