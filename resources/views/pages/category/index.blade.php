@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-5">
        Category Management
    </h1>


    <div class="bg-white rounded-lg shadow p-5">

        <a href="{{ route('categories.create') }}"
    class="inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
    Tambah Kategori
</a>

        @if(session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full text-sm text-left">

            <thead>
                <tr>
                    <th class="px-4 py-3">
                        No
                    </th>

                    <th class="px-4 py-3">
                        Category Name
                    </th>

                    <th class="px-4 py-3">
                        Description
                    </th>

                    <th class="px-4 py-3">
                        Action
                    </th>

                </tr>
            </thead>


            <tbody>

            @foreach($categories as $category)

                <tr class="border-b">

                    <td class="px-4 py-3">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $category->name }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $category->description }}
                    </td>

                    <td class="px-4 py-3 flex gap-2">

                        <a href="{{ route('categories.edit', $category->id) }}"
                            class="px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                            Edit
                        </a>

                        <a href="{{ route('category.attributes.index', $category->id) }}"
                            class="px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                            Kelola Atribut
                        </a>
                        <form
                            action="{{ route('categories.destroy', $category->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>


@endsection