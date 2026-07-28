@extends('layouts.guest')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-100 flex items-center justify-center px-6 py-10">

    <div class="w-full max-w-md">

        {{-- Logo --}}
<div class="mb-8 text-center">

    <div class="relative mx-auto mb-3 h-28 w-28 overflow-visible">

        {{-- Shadow --}}
        <div class="logo-shadow absolute bottom-3 left-1/2 -translate-x-1/2"></div>

        {{-- Logo --}}
        @if(!empty($appSetting->logo))

            <img
                src="{{ asset('storage/'.$appSetting->logo) }}"
                class="logo-float absolute left-1/2 top-0 z-10 h-24 w-24 -translate-x-1/2 object-contain"
                alt="{{ $appSetting->app_name }}">

        @else

            <img
                src="{{ asset('static/images/logo.svg') }}"
                class="logo-float absolute left-1/2 top-0 z-10 h-24 w-24 -translate-x-1/2 object-contain"
                alt="Stockify">

        @endif

    </div>

    <h1 class="text-3xl font-bold text-gray-800">
        {{ $appSetting->app_name ?? 'Stockify' }}
    </h1>

    <p class="mt-2 text-gray-500">
        {{ $appSetting->description ?? 'Warehouse Management System' }}
    </p>

</div>



        {{-- Card --}}
        <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-xl">

            <div class="mb-8 text-center">

                <h2 class="text-2xl font-bold text-gray-800">

                    Selamat Datang
                    <span class="wave">👋</span>

                </h2>

                <p class="mt-2 text-sm text-gray-500">

                    Silakan masuk untuk melanjutkan ke dashboard.

                </p>

            </div>

            <x-auth-session-status
                class="mb-5"
                :status="session('status')" />

            <form
                method="POST"
                action="{{ route('login') }}"
                class="space-y-6">

                @csrf
                                {{-- =============================== --}}
                {{-- Email --}}
                {{-- =============================== --}}

                <div>

                    <label
                        for="email"
                        class="mb-2 block text-sm font-semibold text-gray-700">

                        Email

                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Masukkan email"
                        class="w-full rounded-xl border-gray-300 shadow-sm transition focus:border-blue-500 focus:ring-blue-500">

                    @error('email')

                        <p class="mt-2 text-sm text-red-500">

                            {{ $message }}

                        </p>

                    @enderror

                </div>



                {{-- =============================== --}}
                {{-- Password --}}
                {{-- =============================== --}}

                <div>

                    <label
                        for="password"
                        class="mb-2 block text-sm font-semibold text-gray-700">

                        Password

                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password"
                        class="w-full rounded-xl border-gray-300 shadow-sm transition focus:border-blue-500 focus:ring-blue-500">

                    @error('password')

                        <p class="mt-2 text-sm text-red-500">

                            {{ $message }}

                        </p>

                    @enderror

                </div>



                {{-- =============================== --}}
                {{-- Remember Me --}}
                {{-- =============================== --}}

                <div class="flex items-center justify-between">

                    <label class="flex items-center gap-2">

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">

                        <span class="text-sm text-gray-600">

                            Ingat Saya

                        </span>

                    </label>

                    @if(Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="text-sm font-medium text-blue-600 transition hover:text-blue-700">

                            Lupa Password?

                        </a>

                    @endif

                </div>
                                {{-- =============================== --}}
                {{-- Login Button --}}
                {{-- =============================== --}}

                <button
                type="submit"
                class="
                flex
                w-full
                items-center
                justify-center
                rounded-xl

                bg-blue-600

                px-6
                py-3

                font-semibold
                text-white

                shadow-[0_3px_8px_rgba(37,99,235,.25)]

                transition-all
                duration-150

                hover:-translate-y-[1px]
                hover:shadow-[0_6px_14px_rgba(37,99,235,.30)]
                hover:bg-blue-700

                active:translate-y-[2px]
                active:shadow-[0_2px_5px_rgba(37,99,235,.20)]

                focus:outline-none
                focus:ring-4
                focus:ring-blue-200
                ">
                <svg
                    class="mr-2 h-5 w-5 transition-transform duration-200 group-hover:translate-x-1"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h14m-6-6l6 6-6 6"/>

                </svg>

                Masuk ke Dashboard

            </button>

            </form>

        </div>

        {{-- Footer --}}
        <div class="mt-8 text-center">

            <p class="text-sm text-gray-500">

                

                <span class="text-sm font-semibold text-blue-600">

                    ®️izkii Stockify-{{ date('Y') }}          v1.0.0

                </span>

            </p>

            <p class="mt-1 text-xs text-gray-400">

                {{ $appSetting->footer_text ?? 'Management Gudang' }}

            </p>

        </div>

    </div>

</div>

<style>

.logo-float{

    position:absolute;

    left:50%;

    top:0;

    transform:translateX(-50%);

    z-index:10;

    animation:floatingLogo 2.7s ease-in-out infinite;

}

.logo-shadow{

    position:absolute;

    left:50%;

    bottom:0;

    transform:translateX(-50%);

    width:80px;

    height:22px;

    border-radius:9999px;

    background:rgba(0,0,0,.35);

    filter:blur(5px);

    z-index:0;

    animation:shadowFloat 2.7s ease-in-out infinite;

}

@keyframes floatingLogo{

    0%{

        transform:
            translate(-50%,0px)
            rotateX(0deg)
            scale(1);

    }

    50%{

        transform:
            translate(-50%,-18px)
            rotateX(8deg)
            scale(1.04);

    }

    100%{

        transform:
            translate(-50%,0px)
            rotateX(0deg)
            scale(1);

    }

}

@keyframes shadowFloat{

    0%{

        transform:
            translateX(-50%)
            scale(1);

        opacity:.30;

        filter:blur(8px);

    }

    50%{

        transform:
            translateX(-50%)
            scale(1.45);

        opacity:.10;

        filter:blur(12px);

    }

    100%{

        transform:
            translateX(-50%)
            scale(1);

        opacity:.30;

        filter:blur(8px);

    }

}

.wave{

    display:inline-block;

    transform-origin:70% 70%;

    animation:waveHand 2.6s ease-in-out infinite;

}

@keyframes waveHand{

    0%{
        transform:rotate(0deg);
    }

    8%{
        transform:rotate(14deg);
    }

    16%{
        transform:rotate(-8deg);
    }

    24%{
        transform:rotate(14deg);
    }

    32%{
        transform:rotate(-6deg);
    }

    40%{
        transform:rotate(10deg);
    }

    48%{
        transform:rotate(-3deg);
    }

    56%{
        transform:rotate(6deg);
    }

    64%{
        transform:rotate(0deg);
    }

    100%{
        transform:rotate(0deg);
    }

}

</style>

@endsection