@props(['icon' => null, 'routeName' => null, 'title' => null])

<li>
    <a href="{{ route($routeName) }}"
        class="flex items-center p-2 text-base rounded-lg group
        {{ request()->routeIs($routeName)
            ? 'bg-blue-700 text-white'
            : 'text-gray-900 hover:bg-blue-700 hover:text-white dark:text-gray-200 dark:hover:bg-blue-700 dark:hover:text-white' }}">

        {{ $icon }}

        <span class="ml-3" sidebar-toggle-item>
            {{ $title }}
        </span>
    </a>
</li>