@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-5">
        Edit Category
    </h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">

        @csrf
        @method('PUT')

        

        <div class="mb-4">
            <label class="block mb-2">
                Category Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $category->name) }}"
                class="border rounded-lg p-2 w-full"
                placeholder="Enter category name">

            @error('name')
                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="border rounded-lg p-2 w-full"
                placeholder="Enter description">{{ old('description', $category->description) }}</textarea>

            @error('description')
                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button 
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Update
        </button>

        
        <a href="{{ route('categories.index', $category->id) }}"
            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Batal
        </a>
        

    </form>

</div>

@endsection