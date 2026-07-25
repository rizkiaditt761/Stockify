@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Edit Supplier
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi supplier yang terdaftar pada sistem Stockify.
            </p>

        </div>

        <a href="{{ route('suppliers.index') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">

            <svg class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 19l-7-7 7-7"/>

            </svg>

            Kembali

        </a>

    </div>



    {{-- Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        <form
            action="{{ route('suppliers.update',$supplier->id) }}"
            method="POST"
            class="p-6">

            @csrf
            @method('PUT')

            @if($errors->any())

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5">

                    <h3 class="font-semibold text-red-700">

                        Terjadi Kesalahan

                    </h3>

                    <ul class="mt-2 list-disc list-inside text-sm text-red-600 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- Nama & HP --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">

                        Nama Supplier
                        <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name',$supplier->name) }}"
                        placeholder="Contoh : PT Sumber Makmur"
                        class="w-full rounded-lg border-gray-300 focus:ring-blue-600 focus:border-blue-600">

                </div>



                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">

                        Nomor HP

                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone',$supplier->phone) }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full rounded-lg border-gray-300 focus:ring-blue-600 focus:border-blue-600">

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
                    value="{{ old('email',$supplier->email) }}"
                    placeholder="supplier@email.com"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-600 focus:border-blue-600">

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
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-600 focus:border-blue-600">{{ old('address',$supplier->address) }}</textarea>

            </div>



            {{-- Tombol --}}
            <div class="flex flex-wrap gap-3 mt-8">

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 text-white hover:bg-blue-800">

                    <svg class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7"/>

                    </svg>

                    Simpan Perubahan

                </button>



                <a
                    href="{{ route('suppliers.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection