<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>

        {{ $appSetting->app_name ?? config('app.name') }}

    </title>
    @if(!empty($appSetting?->favicon))

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('storage/'.$appSetting->favicon) }}">

@else

    <link
        rel="icon"
        href="{{ asset('favicon.ico') }}">

@endif

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="antialiased">

    @yield('content')

</body>

</html>