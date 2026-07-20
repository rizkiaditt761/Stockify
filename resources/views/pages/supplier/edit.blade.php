@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Edit Supplier
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi supplier yang terdaftar.
            </p>
        </div>

        <a href="{{ route('suppliers.index') }}"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700">

            ← Kembali

        </a>

    </div>

    {{-- Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        <form action="{{ route('suppliers.update', $supplier->id) }}"
            method="POST"
            class="p-6">

            @csrf
            @method('PUT')

            @if ($errors->any())

                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">

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


            {{-- Nama --}}
            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Nama Supplier
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $supplier->name) }}"
                    placeholder="Masukkan nama supplier"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600">

            </div>


            {{-- Alamat --}}
            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Alamat
                </label>

                <textarea
                    name="address"
                    rows="4"
                    placeholder="Masukkan alamat supplier"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600">{{ old('address', $supplier->address) }}</textarea>

            </div>


            {{-- HP & Email --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $supplier->phone) }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600">

                </div>

                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $supplier->email) }}"
                        placeholder="supplier@email.com"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring-blue-600">

                </div>

            </div>


            {{-- Button --}}
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-blue-700 text-white hover:bg-blue-800">

                    Simpan Perubahan

                </button>

                <a href="{{ route('suppliers.index') }}"
                    class="px-5 py-2.5 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection