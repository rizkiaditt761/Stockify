@php
    $url = explode('/', request()->url());
    $page_slug = $url[count($url) - 2] ?? '';
@endphp

<aside
    id="sidebar"
    class="fixed top-[72px] left-0 z-20 hidden w-64 h-[calc(100vh-72px)] lg:flex flex-col border-r border-gray-200 bg-white">

    <div class="flex-1 overflow-y-auto py-5">

        <div class="px-3">

            <ul class="space-y-2">

                {{ $slot }}

            </ul>

        </div>

    </div>

</aside>

<div
    id="sidebarBackdrop"
    class="fixed inset-0 z-10 hidden bg-gray-900/50">
</div>