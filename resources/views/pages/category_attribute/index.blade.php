@extends('layouts.dashboard')

@section('content')

<div class="p-4">

<h1 class="text-2xl font-bold mb-5">
Kelola Atribut {{ $category->name }}
</h1>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('category.attributes.store', $category->id) }}" method="POST">

@csrf

<div id="attributes">

@if($attributes->count())

@foreach($attributes as $attribute)

<div class="flex gap-3 mb-3">
    <input
        type="text"
        name="attributes[]"
        value="{{ $attribute->name }}"
        class="border rounded-lg p-2 w-full">
</div>

@endforeach

@else

<div class="flex gap-3 mb-3">
    <input
        type="text"
        name="attributes[]"
        placeholder="Nama atribut"
        class="border rounded-lg p-2 w-full">
</div>

@endif

</div>

<button
type="button"
onclick="addAttribute()"
class="bg-green-600 text-white px-4 py-2 rounded-lg mb-5">
+ Tambah Atribut
</button>

<br>

<button
type="submit"
class="bg-blue-700 text-white px-5 py-2 rounded-lg">
Simpan
</button>

</form>

</div>

<script>

function addAttribute(){

document.getElementById('attributes').insertAdjacentHTML(
'beforeend',

`<div class="flex gap-3 mb-3">
<input
type="text"
name="attributes[]"
placeholder="Nama atribut"
class="border rounded-lg p-2 w-full">
</div>`

);

}

</script>

@endsection