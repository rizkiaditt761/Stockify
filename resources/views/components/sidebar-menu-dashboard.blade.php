@props(['icon' => null, 'routeName' => null, 'title' => null])

@php
    $active = request()->routeIs(str_replace('.index', '.*', $routeName));
@endphp

<li>
    <a href="{{ route($routeName) }}"
        class="flex items-center p-2 text-base rounded-lg group
        {{ $active
            ? 'bg-blue-700 text-white'
            : 'text-gray-900 hover:bg-blue-700 hover:text-white' }}">

        {{ $icon }}

        <span class="ml-3">
            {{ $title }}
        </span>
    </a>
</li>