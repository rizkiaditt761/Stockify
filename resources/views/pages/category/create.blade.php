@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-5">
        Add Category
    </h1>


    <form action="{{ route('categories.store') }}" method="POST">
    @csrf

    @error('name, description')
    <p class="text-red-500 text-sm mt-2">
        {{ $message }}
    </p>
    @enderror

    <div class="flex justify-end mb-4">
        <a href="{{ route('categories.index') }}"
            class="px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
            Batal
        </a>
    </div>

        <div>
            <label class="block mb-2">
                Category Name
            </label>

           <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            class="border rounded-lg p-2 w-full"
            placeholder="Enter category name">
        </div>

        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium">
                Deskripsi
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full rounded-lg border p-2"
                placeholder="Masukkan deskripsi kategori">{{ old('description') }}</textarea>
        </div>

        <button 
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Simpan
        </button>

    </form>
    

</div>

@endsection