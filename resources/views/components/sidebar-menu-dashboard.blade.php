<nav class="flex-1 px-4 py-5 overflow-y-auto">

    <ul class="space-y-2">

        {{-- Dashboard --}}
        <li>

            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200
                {{ request()->routeIs('dashboard')
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                    : 'text-gray-700 hover:bg-gray-100 hover:translate-x-1'
                }}">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l2-2m0 0l7-7 7 7m-9 9V9m0 12h6"/>
                </svg>

                <span class="font-medium">
                    Dashboard
                </span>

            </a>

        </li>

        {{-- Categories --}}
        @if(auth()->user()->role == 'admin')

        <li>

            <a href="{{ route('categories.index') }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200
                {{ request()->routeIs('categories.*')
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                    : 'text-gray-700 hover:bg-gray-100 hover:translate-x-1'
                }}">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 7l9-4 9 4-9 4-9-4zm0 5l9 4 9-4M3 17l9 4 9-4"/>

                </svg>

                <span class="font-medium">
                    Categories
                </span>

            </a>

        </li>

        @endif

        {{-- Products --}}
        <li>

            <a href="{{ route('products.index') }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200
                {{ request()->routeIs('products.*')
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                    : 'text-gray-700 hover:bg-gray-100 hover:translate-x-1'
                }}">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M20 7L12 3 4 7m16 0v10l-8 4m8-14l-8 4M4 7v10l8 4m0-10v10"/>

                </svg>

                <span class="font-medium">
                    Products
                </span>

            </a>

        </li>

        {{-- Suppliers --}}
        @if(in_array(auth()->user()->role, ['admin','manager']))

        <li>

            <a href="{{ route('suppliers.index') }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200
                {{ request()->routeIs('suppliers.*')
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                    : 'text-gray-700 hover:bg-gray-100 hover:translate-x-1'
                }}">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7M9 11h6"/>

                </svg>

                <span class="font-medium">
                    Suppliers
                </span>

            </a>

        </li>

        @endif

        {{-- Transactions --}}
        <li>

            <a href="{{ route('stock_transactions.index') }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200
                {{ request()->routeIs('stock_transactions.*')
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                    : 'text-gray-700 hover:bg-gray-100 hover:translate-x-1'
                }}">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8 7h8m-8 5h8m-8 5h5M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/>

                </svg>

                <span class="font-medium">
                    Transactions
                </span>

            </a>

        </li>

        {{-- Inventory --}}
        <li>

            <a href="{{ route('stock.monitoring.index') }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200
                {{ request()->routeIs('stock.monitoring.*')
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                    : 'text-gray-700 hover:bg-gray-100 hover:translate-x-1'
                }}">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 7h18M5 7v13h14V7M9 7V4h6v3"/>

                </svg>

                <span class="font-medium">
                    Stock Monitoring
                </span>

            </a>

        </li>

        {{-- Stock Opname --}}
        <li>

            <a href="{{ route('stock.opname.index') }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200
                {{ request()->routeIs('stock.opname.*')
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                    : 'text-gray-700 hover:bg-gray-100 hover:translate-x-1'
                }}">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7"/>

                </svg>

                <span class="font-medium">
                    Stock Opname
                </span>

            </a>

        </li>

        {{-- Reports --}}
        @if(in_array(auth()->user()->role, ['admin','manager']))

        <li>

            <a href="{{ route('reports.index') }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200
                {{ request()->routeIs('reports.*')
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                    : 'text-gray-700 hover:bg-gray-100 hover:translate-x-1'
                }}">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 17v-6h4v6m4 0V7M5 17V9"/>

                </svg>

                <span class="font-medium">
                    Reports
                </span>

            </a>

        </li>

        @endif

        {{-- Users --}}
        @if(auth()->user()->role == 'admin')

        <li>

            <a href="{{ route('users.index') }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200
                {{ request()->routeIs('users.*')
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                    : 'text-gray-700 hover:bg-gray-100 hover:translate-x-1'
                }}">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m14-10a4 4 0 10-8 0 4 4 0 008 0zm6 10v-2a4 4 0 00-3-3.87"/>

                </svg>

                <span class="font-medium">
                    Users
                </span>

            </a>

        </li>

        @endif

    </ul>

</nav>