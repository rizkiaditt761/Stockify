@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    <div class="flex justify-between items-center mb-5">

        <h1 class="text-2xl font-bold">
            User Management
        </h1>

        <a href="{{ route('users.create') }}"
            class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
            + Tambah User
        </a>

    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">

        <table class="w-full text-left">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3">Nama</th>

                    <th class="p-3">Email</th>

                    <th class="p-3">Role</th>

                    <th class="p-3 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr class="border-b">

                        <td class="p-3">
                            {{ $user->name }}
                        </td>

                        <td class="p-3">
                            {{ $user->email }}
                        </td>

                        <td class="p-3 capitalize">
                            {{ $user->role }}
                        </td>

                        <td class="p-3">

                            <div class="flex justify-center gap-2">

                                <a
                                    href="{{ route('users.edit',$user->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('users.destroy',$user->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus user ini?')"
                                        class="bg-red-600 text-white px-3 py-1 rounded">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="p-5 text-center">

                            Belum ada data user.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection