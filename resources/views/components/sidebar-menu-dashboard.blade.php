@props(['icon' => null, 'routeName' => null, 'title' => null])

@php
    $prefix = explode('.', $routeName)[0];
    $active = request()->routeIs($prefix . '.*');
@endphp

<li>
    <a href="{{ route($routeName) }}"
        class="flex items-center p-2 text-base rounded-lg group
        {{ $active
            ? 'bg-blue-700 text-white'
            : 'text-gray-900 hover:bg-blue-700 hover:text-white' }}">

        {{ $icon }}

        <span class="ml-3" sidebar-toggle-item>
            {{ $title }}
        </span>
    </a>
</li>