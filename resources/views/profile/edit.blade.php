@extends('layouts.dashboard')

@section('content')

<div class="p-6">

    {{-- ========================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================= --}}

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-800">

            Profile Saya

        </h1>

        <p class="mt-2 text-gray-500">

            Kelola informasi akun, foto profil, keamanan akun,
            dan pengaturan pribadi Anda.

        </p>

    </div>



    {{-- ========================================= --}}
    {{-- PROFILE CARD --}}
    {{-- ========================================= --}}

    <div class="mb-8 rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="flex flex-col items-center gap-6 p-8 lg:flex-row">

            {{-- Avatar --}}
            <div>

                @if(auth()->user()->avatar)

                    <img
                        src="{{ asset('storage/' . auth()->user()->avatar) }}"
                        class="h-32 w-32 rounded-full border-4 border-blue-100 object-cover">

                @else

                    <div
                        class="flex h-32 w-32 items-center justify-center rounded-full bg-blue-600 text-5xl font-bold text-white">

                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                    </div>

                @endif

            </div>



            {{-- User Info --}}
            <div class="flex-1">

                <h2 class="text-3xl font-bold text-gray-800">

                    {{ auth()->user()->name }}

                </h2>

                <p class="mt-1 text-gray-500">

                    {{ auth()->user()->email }}

                </p>

                <div class="mt-5 flex flex-wrap gap-3">

                    <span class="rounded-full bg-blue-100 px-4 py-1 text-sm font-semibold text-blue-700">

                        {{ ucfirst(auth()->user()->role) }}

                    </span>

                    <span class="rounded-full bg-green-100 px-4 py-1 text-sm font-semibold text-green-700">

                        {{ auth()->user()->is_active ? 'Aktif' : 'Nonaktif' }}

                    </span>

                    <span class="rounded-full bg-gray-100 px-4 py-1 text-sm text-gray-700">

                        Bergabung
                        {{ auth()->user()->created_at->format('d M Y') }}

                    </span>

                </div>

            </div>

        </div>

    </div>



    {{-- ========================================= --}}
    {{-- PROFILE INFORMATION --}}
    {{-- ========================================= --}}

    <div class="mb-8 rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-100 px-6 py-5">

            <h2 class="text-xl font-bold text-gray-800">

                Informasi Profil

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Perbarui nama, email dan foto profil Anda.

            </p>

        </div>

        <div class="p-6">

            @include('profile.partials.update-profile-information-form')

        </div>

    </div>



    {{-- ========================================= --}}
    {{-- PASSWORD --}}
    {{-- ========================================= --}}

    <div class="mb-8 rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-100 px-6 py-5">

            <h2 class="text-xl font-bold text-gray-800">

                Keamanan Akun

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Ganti password akun Anda secara berkala.

            </p>

        </div>

        <div class="p-6">

            @include('profile.partials.update-password-form')

        </div>

    </div>



    

</div>

@endsection