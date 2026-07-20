@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <div class="flex justify-between items-center mb-5">

        <div>

            <h1 class="text-2xl font-bold text-gray-800">
                Manajemen Supplier
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola data supplier yang bekerja sama dengan perusahaan.
            </p>

        </div>

        <a href="{{ route('suppliers.create') }}"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 shadow">

            + Tambah Supplier

        </a>

    </div>


    @if(session('success'))

    <div class="mb-5 p-4 text-sm text-green-700 bg-green-100 rounded-lg">

        {{ session('success') }}

    </div>

    @endif



    <div class="bg-white rounded-lg shadow">

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="text-xs uppercase bg-gray-50 border-b">

                    <tr>

                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Nama Supplier
                        </th>

                        <th class="px-6 py-4">
                            Alamat
                        </th>

                        <th class="px-6 py-4">
                            Nomor HP
                        </th>

                        <th class="px-6 py-4">
                            Email
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                @foreach($suppliers as $supplier)

                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="px-6 py-4">

                            {{ $loop->iteration }}

                        </td>

                        <td class="px-6 py-4 font-medium text-gray-800">

                            {{ $supplier->name }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $supplier->address }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $supplier->phone }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $supplier->email }}

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('suppliers.edit',$supplier->id) }}"
                                    class="px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('suppliers.destroy',$supplier->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="px-3 py-2 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection