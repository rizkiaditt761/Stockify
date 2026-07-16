<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="#">
    <meta name="author" content="#">
    <meta name="generator" content="Laravel">

    <title>Stockify Dashboard</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="canonical" href="{{ request()->fullUrl() }}">

    @if(isset($page->params['robots']))
        <meta name="robots" content="{{ $page->params['robots'] }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="/favicon.ico">

    <script>
        if (
            localStorage.getItem('color-theme') === 'dark' ||
            (
                !('color-theme' in localStorage) &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
            )
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

</head>

@php
    $whiteBg = isset($params['white_bg']) && $params['white_bg'];
@endphp

<body class="{{ $whiteBg ? 'bg-white' : 'bg-gray-50' }} overflow-hidden">

    {{-- Navbar --}}
    <x-navbar-dashboard />

    {{-- Wrapper --}}
    <div class="flex h-[calc(100vh-72px)] mt-[72px]">

        {{-- Sidebar --}}
        <x-sidebar.admin-sidebar />

        {{-- Content --}}
        <div
    id="main-content"
    class="flex-1 overflow-y-auto bg-gray-50 lg:ml-64">
            <main class="p-6 min-h-full">

                @yield('content')

            </main>

            <x-footer-dashboard />

        </div>

    </div>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>

</body>

</html>