@extends('layouts.dashboard')

@section('content')

<div class="p-4">

    {{-- Header --}}
    <div class="mb-5">

        <h1 class="text-2xl font-bold text-gray-800">
            Edit User
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Perbarui informasi akun pengguna yang terdaftar di sistem.
        </p>

    </div>



    {{-- Card --}}
    <div class="bg-white rounded-lg shadow p-6">

        <form
            action="{{ route('users.update',$user->id) }}"
            method="POST">

            @csrf
            @method('PUT')



            {{-- Validation Error --}}
            @if ($errors->any())

                <div class="mb-5 rounded-lg bg-red-100 p-4 text-sm text-red-700">

                    <ul class="list-disc pl-5">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif



            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Nama --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name',$user->name) }}"
                        placeholder="Masukkan nama lengkap"
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:ring-blue-500 focus:border-blue-500">

                </div>



                {{-- Email --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <input
                    type="email"
                    value="{{ $user->email }}"
                    readonly
                    class="w-full rounded-lg border-gray-200 bg-gray-100 text-gray-500 cursor-not-allowed">
                                
                </div>



                



                {{-- Role --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Role
                    </label>

                    <select
                        name="role"
                        class="w-full rounded-lg border-gray-300 p-2.5 focus:ring-blue-500 focus:border-blue-500">

                        <option
                            value="admin"
                            {{ old('role',$user->role)=='admin' ? 'selected' : '' }}>

                            Admin

                        </option>

                        <option
                            value="manager"
                            {{ old('role',$user->role)=='manager' ? 'selected' : '' }}>

                            Manager Gudang

                        </option>

                        <option
                            value="staff"
                            {{ old('role',$user->role)=='staff' ? 'selected' : '' }}>

                            Staff Gudang

                        </option>

                    </select>

                </div>



                {{-- Status --}}
                
                            </div>



            {{-- Action Button --}}
            <div class="flex justify-start gap-3 mt-6">


                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">

                    Update User

                </button>

                <a
                    href="{{ route('users.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">

                    Batal

                </a>


            </div>


        </form>


    </div>


</div>


@endsection