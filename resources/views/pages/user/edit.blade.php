@extends('layouts.dashboard')

@section('content')

<div class="p-4">

<h1 class="text-2xl font-bold mb-5">
Edit User
</h1>

<form action="{{ route('users.update',$user->id) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-4">

<label>Nama</label>

<input
type="text"
name="name"
value="{{ $user->name }}"
class="border rounded-lg w-full p-2">

</div>

<div class="mb-4">

<label>Email</label>

<input
type="email"
name="email"
value="{{ $user->email }}"
class="border rounded-lg w-full p-2">

</div>

<div class="mb-4">

<label>Password Baru</label>

<input
type="password"
name="password"
class="border rounded-lg w-full p-2">

<small class="text-gray-500">
Kosongkan jika tidak ingin mengganti password.
</small>

</div>

<div class="mb-4">

<label>Role</label>

<select
name="role"
class="border rounded-lg w-full p-2">

<option value="admin" {{ $user->role=='admin'?'selected':'' }}>
Admin
</option>

<option value="manager" {{ $user->role=='manager'?'selected':'' }}>
Manager
</option>

<option value="staff" {{ $user->role=='staff'?'selected':'' }}>
Staff
</option>

</select>

</div>

<button
class="bg-yellow-500 text-white px-5 py-2 rounded-lg">

Update

</button>

</form>

</div>

@endsection