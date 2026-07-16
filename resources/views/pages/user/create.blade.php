@extends('layouts.dashboard')

@section('content')

<div class="p-4">

<h1 class="text-2xl font-bold mb-5">
Tambah User
</h1>

<form action="{{ route('users.store') }}" method="POST">

@csrf

<div class="mb-4">

<label>Nama</label>

<input
type="text"
name="name"
class="border rounded-lg w-full p-2">

</div>

<div class="mb-4">

<label>Email</label>

<input
type="email"
name="email"
class="border rounded-lg w-full p-2">

</div>

<div class="mb-4">

<label>Password</label>

<input
type="password"
name="password"
class="border rounded-lg w-full p-2">

</div>

<div class="mb-4">

<label>Role</label>

<select
name="role"
class="border rounded-lg w-full p-2">

<option value="admin">Admin</option>

<option value="manager">Manager</option>

<option value="staff">Staff</option>

</select>

</div>

<button
class="bg-blue-700 text-white px-5 py-2 rounded-lg">

Simpan

</button>

</form>

</div>

@endsection