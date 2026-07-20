<aside
    id="logo-sidebar"
    class="fixed top-[72px] left-0 z-40 w-64 h-[calc(100vh-72px)] transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0">

    <div class="h-full flex flex-col">


        {{-- Header --}}
        <div class="px-6 pt-6 pb-3">

            <h2 class="text-xs font-semibold tracking-widest uppercase text-gray-400">
                Main Menu
            </h2>

        </div>


        {{-- Menu --}}
     <div id="sidebar-scroll"
     class="flex-1 overflow-y-auto">

    <x-sidebar-menu-dashboard />

</div>


    </div>

</aside>