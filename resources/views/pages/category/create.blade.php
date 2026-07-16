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

        
        <a href="{{ route('categories.index') }}"
             class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Batal
        </a>
        

    </form>
    

</div>

@endsection