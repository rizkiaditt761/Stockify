@extends('layouts.dashboard')

@section('content')

<div class="p-6">

    {{-- ========================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================= --}}

    <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Activity Log
            </h1>

            <p class="mt-2 max-w-2xl text-gray-500">
                Lihat seluruh riwayat aktivitas yang dilakukan oleh anda dalam sistem Stockify.
                Gunakan filter untuk mencari aktivitas berdasarkan kata kunci,
                module maupun periode waktu.
            </p>

        </div>

    </div>



    {{-- ========================================= --}}
    {{-- SUMMARY --}}
    {{-- ========================================= --}}

    <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">

        {{-- Total Aktivitas --}}
        <div class="rounded-xl border border-blue-100 bg-white p-6 shadow-sm transition hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Total Aktivitas
                    </p>

                    <h2 class="mt-3 text-4xl font-bold text-blue-600">

                        {{ $totalActivities }}

                    </h2>

                    <p class="mt-2 text-xs text-gray-400">
                        Seluruh aktivitas akun
                    </p>

                </div>

                <div class="rounded-full bg-blue-100 p-4">

                    <svg class="h-8 w-8 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 17v-6m3 6V7m3 10v-3m5 8H4a2 2 0 01-2-2V4a2 2 0 012-2h16a2 2 0 012 2v16a2 2 0 01-2 2z"/>

                    </svg>

                </div>

            </div>

        </div>



        {{-- Hari Ini --}}
        <div class="rounded-xl border border-green-100 bg-white p-6 shadow-sm transition hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Aktivitas Hari Ini
                    </p>

                    <h2 class="mt-3 text-4xl font-bold text-green-600">

                        {{ $todayActivities }}

                    </h2>

                    <p class="mt-2 text-xs text-gray-400">
                        Aktivitas pada hari ini
                    </p>

                </div>

                <div class="rounded-full bg-green-100 p-4">

                    <svg class="h-8 w-8 text-green-600"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                    </svg>

                </div>

            </div>

        </div>



        

    </div>



    {{-- ========================================= --}}
    {{-- FILTER --}}
    {{-- ========================================= --}}

    <div class="mt-8 rounded-xl border border-gray-200 bg-white shadow-sm">
                {{-- HEADER FILTER --}}
        <div class="border-b border-gray-100 px-6 py-5">

            <h2 class="text-xl font-semibold text-gray-800">
                Filter Aktivitas
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Gunakan filter untuk mencari aktivitas berdasarkan kata kunci,
                module maupun rentang tanggal.
            </p>

        </div>



        <form
            action="{{ route('activities.index') }}"
            method="GET"
            class="grid grid-cols-1 gap-6 p-6 lg:grid-cols-2">

            {{-- SEARCH --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Cari Aktivitas

                </label>

                <div class="relative">

                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">

                        <svg
                            class="h-5 w-5 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0a7 7 0 0114 0z"/>

                        </svg>

                    </div>

                    <input

                        type="text"

                        name="search"

                        value="{{ request('search') }}"

                        placeholder="Cari module, action atau aktivitas..."

                        class="w-full rounded-lg border-gray-300 pl-10 focus:border-blue-500 focus:ring-blue-500"

                    >

                </div>

            </div>



            {{-- MODULE --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Module

                </label>

                <select

                    name="module"

                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">

                        Semua Module

                    </option>

                    @foreach([
                        'product',
                        'supplier',
                        'stock_transaction',
                        'stock_opname',
                        'report',
                        'dashboard',
                        'profile',
                        'auth'
                    ] as $module)

                        <option

                            value="{{ $module }}"

                            {{ request('module') == $module ? 'selected' : '' }}

                        >

                            {{ ucfirst(str_replace('_',' ',$module)) }}

                        </option>

                    @endforeach

                </select>

            </div>



            {{-- START DATE --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Dari Tanggal

                </label>

                <input

                    type="date"

                    name="start_date"

                    value="{{ request('start_date') }}"

                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"

                >

            </div>



            {{-- END DATE --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">

                    Sampai Tanggal

                </label>

                <input

                    type="date"

                    name="end_date"

                    value="{{ request('end_date') }}"

                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"

                >

            </div>



            {{-- BUTTON --}}
            <div class="lg:col-span-2">

                <div class="flex flex-wrap gap-3">

                    <button

                        type="submit"

                        class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                        Filter

                    </button>

                    <a

                        href="{{ route('activities.index') }}"

                        class="rounded-lg bg-gray-500 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-600">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>



    {{-- ========================================= --}}
    {{-- TABLE --}}
    {{-- ========================================= --}}

    <div class="mt-8 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-100 px-6 py-5">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-xl font-bold text-gray-800">

                        Riwayat Aktivitas

                    </h2>

                    <p class="mt-1 text-sm text-gray-500">

                        Menampilkan seluruh aktivitas akun yang sedang login.

                    </p>

                </div>

                <span class="rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold text-blue-700">

                    {{ $activities->total() }} Aktivitas

                </span>

            </div>

        </div>

        <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider text-gray-600">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider text-gray-600">
                            Module
                        </th>

                        <th class="px-6 py-4 text-center font-semibold uppercase tracking-wider text-gray-600">
                            Action
                        </th>

                        <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider text-gray-600">
                            Aktivitas
                        </th>

                        <th class="px-6 py-4 text-center font-semibold uppercase tracking-wider text-gray-600">
                            Waktu
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                @forelse($activities as $activity)

                    <tr class="transition duration-150 hover:bg-gray-50">

                        {{-- NO --}}
                        <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-700">

                            {{ $activities->firstItem() + $loop->index }}

                        </td>



                        {{-- MODULE --}}
                        <td class="px-6 py-4">

                            @php

                                $moduleClass = match($activity->module){

                                    'product'
                                        => 'bg-blue-100 text-blue-700',

                                    'supplier'
                                        => 'bg-orange-100 text-orange-700',

                                    'stock_transaction'
                                        => 'bg-green-100 text-green-700',

                                    'stock_opname'
                                        => 'bg-purple-100 text-purple-700',

                                    'report'
                                        => 'bg-indigo-100 text-indigo-700',

                                    'dashboard'
                                        => 'bg-cyan-100 text-cyan-700',

                                    'profile'
                                        => 'bg-pink-100 text-pink-700',

                                    'auth'
                                        => 'bg-red-100 text-red-700',

                                    default
                                        => 'bg-gray-100 text-gray-700'

                                };

                            @endphp

                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $moduleClass }}">

                                {{ ucfirst(str_replace('_',' ',$activity->module)) }}

                            </span>

                        </td>



                        {{-- ACTION --}}
                        <td class="px-6 py-4 text-center">

                            @php

                                $actionClass = match(strtolower($activity->action)){

                                    'create',
                                    'created'
                                        => 'bg-green-100 text-green-700',

                                    'update',
                                    'updated'
                                        => 'bg-yellow-100 text-yellow-700',

                                    'delete',
                                    'deleted'
                                        => 'bg-red-100 text-red-700',

                                    'confirm',
                                    'confirmed'
                                        => 'bg-blue-100 text-blue-700',

                                    'reject',
                                    'rejected'
                                        => 'bg-orange-100 text-orange-700',

                                    'login'
                                        => 'bg-indigo-100 text-indigo-700',

                                    'logout'
                                        => 'bg-gray-200 text-gray-700',

                                    default
                                        => 'bg-gray-100 text-gray-700'

                                };

                            @endphp

                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $actionClass }}">

                                {{ ucfirst($activity->action) }}

                            </span>

                        </td>



                        {{-- DESCRIPTION --}}
                        <td class="px-6 py-4">

                            <div class="max-w-xl">

                                <p class="font-medium text-gray-700">

                                    {{ $activity->description }}

                                </p>

                            </div>

                        </td>



                        {{-- TIME --}}
                        <td class="whitespace-nowrap px-6 py-4 text-center">

                            <div class="font-medium text-gray-700">

                                {{ $activity->created_at->format('d M Y') }}

                            </div>

                            <div class="text-xs text-gray-500">

                                {{ $activity->created_at->format('H:i') }}

                            </div>

                        </td>

                    </tr>

                @empty
                

                    <tr>

                        <td
                            colspan="5"
                            class="px-6 py-14 text-center">

                            <div class="flex flex-col items-center">

                                <div class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gray-100">

                                    <svg
                                        class="h-10 w-10 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>

                                    </svg>

                                </div>

                                <h3 class="text-lg font-semibold text-gray-700">

                                    Belum Ada Aktivitas

                                </h3>

                                <p class="mt-2 max-w-md text-sm text-gray-500">

                                    Tidak ditemukan aktivitas yang sesuai
                                    dengan filter yang dipilih.

                                </p>

                                <a

                                    href="{{ route('activities.index') }}"

                                    class="mt-6 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">

                                    Reset Filter

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>



        {{-- FOOTER TABLE --}}
        <div class="flex flex-col items-center justify-between gap-4 border-t border-gray-100 bg-gray-50 px-6 py-4 md:flex-row">

            <div class="text-sm text-gray-500">

                Menampilkan

                <span class="font-semibold">

                    {{ $activities->firstItem() ?? 0 }}

                </span>

                -

                <span class="font-semibold">

                    {{ $activities->lastItem() ?? 0 }}

                </span>

                dari

                <span class="font-semibold">

                    {{ $activities->total() }}

                </span>

                aktivitas

            </div>

            <div>

                {{ $activities->withQueryString()->links() }}

            </div>

        </div>

    </div>

</div>
@endsection