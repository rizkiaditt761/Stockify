@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-5">
        Supplier Management
    </h1>

    <div class="bg-white rounded-lg shadow p-5">

        <a href="{{ route('suppliers.create') }}"
            class="inline-flex items-center mb-4 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
            Tambah Supplier
        </a>

        <table class="w-full text-sm text-left">

            <thead class="border-b">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3">No. HP</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>

            @foreach($suppliers as $supplier)

                <tr class="border-b">

                    <td class="px-4 py-3">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $supplier->name }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $supplier->address }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $supplier->phone }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $supplier->email }}
                    </td>

                    <td class="px-4 py-3 text-center">

                        <a href="{{ route('suppliers.edit', $supplier->id) }}"
                            class=" inline-block px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                            Edit
                        </a>

                        <form
                            action="{{ route('suppliers.destroy', $supplier->id) }}"
                            method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                Delete
                            </button>

                        </form>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection