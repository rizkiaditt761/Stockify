@extends('layouts.dashboard')

@section('content')

<div class="p-4">


    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">


        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                User Management
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola akun pengguna, role, dan akses sistem Stockify.
            </p>

        </div>



        @if(auth()->user()->role == 'admin')

            <a href="{{ route('users.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium">

                + Tambah User

            </a>

        @endif


    </div>




    {{-- User Summary Card --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">


        {{-- Total User --}}
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 shadow-sm">


            <p class="text-sm font-medium text-blue-700">

                Total User

            </p>


            <h2 class="text-4xl font-bold text-blue-700 mt-2">

                {{ $totalUser }}

            </h2>


            <p class="text-sm text-gray-500 mt-2">

                Termasuk akun Anda yang sedang login

            </p>


        </div>




        {{-- Active User --}}
        <div class="bg-green-50 border border-green-200 rounded-xl p-5 shadow-sm">


            <p class="text-sm font-medium text-green-700">

                Active User

            </p>


            <h2 class="text-4xl font-bold text-green-700 mt-2">

                {{ $activeUser }}

            </h2>


            <p class="text-sm text-gray-500 mt-2">

                User yang dapat login ke sistem

            </p>


        </div>




        {{-- Inactive User --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 shadow-sm">


            <p class="text-sm font-medium text-gray-700">

                Inactive User

            </p>


            <h2 class="text-4xl font-bold text-gray-700 mt-2">

                {{ $inactiveUser }}

            </h2>


            <p class="text-sm text-gray-500 mt-2">

                User yang dinonaktifkan

            </p>


        </div>



    </div>





    {{-- Filter --}}
    <div class="flex flex-col md:flex-row gap-3 mb-6">


        <form method="GET"
            class="flex flex-col md:flex-row gap-3">



            {{-- Search --}}
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari user..."
                class="border rounded-lg px-4 py-2 w-60">





            {{-- Filter Role --}}
            <select
                name="role"
                onchange="this.form.submit()"
                class="border rounded-lg px-4 py-2 w-60">


                <option value="">

                    Semua Role

                </option>


                <option
                    value="admin"
                    {{ request('role') == 'admin' ? 'selected' : '' }}>

                    Admin

                </option>


                <option
                    value="manager"
                    {{ request('role') == 'manager' ? 'selected' : '' }}>

                    Manager Gudang

                </option>


                <option
                    value="staff"
                    {{ request('role') == 'staff' ? 'selected' : '' }}>

                    Staff Gudang

                </option>


            </select>





            {{-- Filter Status --}}
            <select
                name="status"
                onchange="this.form.submit()"
                class="border rounded-lg px-4 py-2 w-60">


                <option
                    value="">

                    Semua Status

                </option>


                <option
                    value="active"
                    {{ request('status') == 'active' ? 'selected' : '' }}>

                    Active

                </option>


                <option
                    value="inactive"
                    {{ request('status') == 'inactive' ? 'selected' : '' }}>

                    Inactive

                </option>


            </select>





            {{-- Button Search --}}
            <button
                type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">


                Cari


            </button>



        </form>





        {{-- Reset --}}
        @if(request('search') || request('role') || request('status'))

            <a href="{{ route('users.index') }}"
               class="rounded-lg bg-gray-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-700">


                Reset


            </a>

        @endif



    </div>





    {{-- User Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">


        <div class="overflow-x-auto">


            <table class="w-full text-sm">



                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">


                    <tr>


                        <th class="px-6 py-4 text-left">
                            No
                        </th>


                        <th class="px-6 py-4 text-left">
                            User
                        </th>


                        <th class="px-6 py-4 text-left">
                            Email
                        </th>


                        <th class="px-6 py-4 text-center">
                            Role
                        </th>


                        <th class="px-6 py-4 text-center">
                            Status
                        </th>


                        <th class="px-6 py-4 text-center">
                            Action
                        </th>


                    </tr>


                </thead>




                <tbody>



                @forelse($users as $user)



                    <tr class="border-t hover:bg-gray-50">



                        {{-- No --}}
                        <td class="px-6 py-4">


                            {{ $users->firstItem() + $loop->index }}


                        </td>





                        {{-- User --}}
<td class="px-6 py-4">


    <div class="flex items-center gap-3">


        @if($user->avatar)


            <img
                src="{{ asset('storage/' . $user->avatar) }}"
                class="h-10 w-10 rounded-full object-cover border border-gray-200 shadow-sm">


        @else


            <div
                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">


                <span class="font-semibold text-blue-700">


                    {{ strtoupper(substr($user->name,0,1)) }}


                </span>


            </div>


        @endif




        <div>


            <div class="font-semibold text-gray-800">

                {{ $user->name }}

            </div>



            <div class="text-xs text-gray-500 mt-1">

                ID :
                {{ $user->id }}

            </div>


        </div>


    </div>


</td>





                        {{-- Email --}}
                        <td class="px-6 py-4">


                            {{ $user->email }}


                        </td>







                        {{-- Role --}}
                        <td class="px-6 py-4 text-center">



                            @if($user->role == 'admin')


                                <span
                                    class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">


                                    Admin


                                </span>



                            @elseif($user->role == 'manager')



                                <span
                                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">


                                    Manager Gudang


                                </span>



                            @else



                                <span
                                    class="rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">


                                    Staff Gudang


                                </span>



                            @endif



                        </td>







                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">



                            @if($user->is_active)



                                <span
                                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">


                                    Active


                                </span>



                            @else



                                <span
                                    class="rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">


                                    Inactive


                                </span>



                            @endif



                        </td>







                        {{-- Action --}}
                        <td class="px-6 py-4 text-center">



                            <div class="flex justify-start gap-2">





                                {{-- Edit --}}

                                <a href="{{ route('users.edit',$user->id) }}"
                                    class="px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">


                                    Edit


                                </a>








                                {{-- Activate / Deactivate --}}


                                @if($user->is_active)



                                    <form
                                        action="{{ route('users.deactivate',$user->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Nonaktifkan user ini?')">


                                        @csrf
                                        @method('PATCH')



                                        <button
                                            type="submit"
                                            class="px-3 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">


                                            Nonaktifkan


                                        </button>



                                    </form>




                                @else



                                    <form
                                        action="{{ route('users.activate',$user->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Aktifkan kembali user ini?')">


                                        @csrf
                                        @method('PATCH')



                                        <button
                                            type="submit"
                                            class="px-3 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">


                                            Aktifkan


                                        </button>



                                    </form>



                                @endif





                            </div>



                        </td>




                    </tr>





                @empty



                    <tr>


                        <td colspan="6"
                            class="text-center py-10 text-gray-500">


                            Tidak ada data user.


                        </td>


                    </tr>



                @endforelse





                </tbody>



            </table>



        </div>
                {{-- Pagination --}}

        @if($users->hasPages())


            <div class="border-t bg-white px-6 py-4">


                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">



                    <div class="text-sm text-gray-600">


                        Menampilkan


                        <span class="font-semibold text-blue-600">

                            {{ $users->firstItem() }}

                        </span>


                        -


                        <span class="font-semibold text-blue-600">

                            {{ $users->lastItem() }}

                        </span>



                        dari


                        <span class="font-semibold text-blue-600">

                            {{ $users->total() }}

                        </span>


                        user



                    </div>




                    {{ $users->links() }}



                </div>


            </div>


        @endif



    </div>


</div>


@endsection