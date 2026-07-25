@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-5">

        <h1 class="text-2xl font-bold text-gray-800">
            Tambah User
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Tambahkan akun pengguna baru ke dalam sistem Stockify.
        </p>

    </div>



    {{-- Card --}}
    <div class="bg-white rounded-lg shadow p-6">

        <form action="{{ route('users.store') }}" method="POST">

            @csrf



            {{-- Validation Error --}}
            @if ($errors->any())

                <div class="mb-5 rounded-lg bg-red-100 p-4 text-sm text-red-700">

                    <ul class="list-disc pl-5">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif



            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Nama --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Rizki Adit Setiawan"
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:border-blue-500 focus:ring-blue-500">

                </div>



                {{-- Email --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Contoh: rizki@gmail.com"
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:border-blue-500 focus:ring-blue-500">

                </div>



                {{-- Password --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:border-blue-500 focus:ring-blue-500">

                </div>



                {{-- Role --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Role
                    </label>

                    <select
                        name="role"
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:border-blue-500 focus:ring-blue-500">

                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>
                            Manager Gudang
                        </option>

                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>
                            Staff Gudang
                        </option>

                    </select>

                </div>



                {{-- Status --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Status Akun
                    </label>

                    <select
                        name="is_active"
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:border-blue-500 focus:ring-blue-500">

                        <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ old('is_active') === "0" ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    <p class="mt-2 text-xs text-gray-500">
                        User dengan status <b>Inactive</b> tidak dapat login ke dalam sistem.
                    </p>

                </div>
                            </div>

            <div class="flex justify-start gap-3 mt-6">

                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">

                    Simpan User

                </button>

                <a
                    href="{{ route('users.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection