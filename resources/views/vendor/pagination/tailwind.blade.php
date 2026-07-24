@if ($paginator->hasPages())

<nav role="navigation"
    aria-label="{{ __('Pagination Navigation') }}"
    class="flex items-center justify-between">

    {{-- Mobile --}}
    <div class="flex justify-between flex-1 sm:hidden">

        @if ($paginator->onFirstPage())

            <span
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">

                {!! __('pagination.previous') !!}

            </span>

        @else

            <a href="{{ $paginator->previousPageUrl() }}"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">

                {!! __('pagination.previous') !!}

            </a>

        @endif



        @if ($paginator->hasMorePages())

            <a href="{{ $paginator->nextPageUrl() }}"
                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">

                {!! __('pagination.next') !!}

            </a>

        @else

            <span
                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">

                {!! __('pagination.next') !!}

            </span>

        @endif

    </div>



    {{-- Desktop --}}
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">

       



        <div>

            <span class="inline-flex rounded-xl shadow-sm overflow-hidden">

                {{-- Previous --}}

                @if ($paginator->onFirstPage())

                    <span aria-disabled="true">

                        <span
                            class="relative inline-flex items-center px-3 py-2 text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed">

                            <svg class="w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 20 20">

                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />

                            </svg>

                        </span>

                    </span>

                @else

                    <a href="{{ $paginator->previousPageUrl() }}"
                        rel="prev"
                        class="relative inline-flex items-center px-3 py-2 text-blue-600 bg-white border border-blue-200 hover:bg-blue-50 transition">

                        <svg class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20">

                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />

                        </svg>

                    </a>

                @endif

                {{-- Pagination Elements --}}

@foreach ($elements as $element)

    {{-- Three Dots --}}
    @if (is_string($element))

        <span aria-disabled="true">

            <span
                class="relative inline-flex items-center px-4 py-2 border border-gray-200 bg-gray-50 text-gray-400">

                {{ $element }}

            </span>

        </span>

    @endif



    {{-- Page Number --}}
    @if (is_array($element))

        @foreach ($element as $page => $url)

            @if ($page == $paginator->currentPage())

                <span aria-current="page">

                    <span
                        class="relative inline-flex items-center px-4 py-2 border border-blue-600 bg-blue-600 text-white font-semibold shadow-sm">

                        {{ $page }}

                    </span>

                </span>

            @else

                <a href="{{ $url }}"
                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-200 bg-white text-gray-700 hover:bg-blue-50 hover:text-blue-700 hover:border-blue-300 transition duration-200">

                    {{ $page }}

                </a>

            @endif

        @endforeach

    @endif

@endforeach



{{-- Next Page Link --}}

@if ($paginator->hasMorePages())

    <a href="{{ $paginator->nextPageUrl() }}"
        rel="next"
        aria-label="{{ __('pagination.next') }}"
        class="relative inline-flex items-center px-3 py-2 border border-blue-200 bg-white text-blue-600 hover:bg-blue-50 hover:text-blue-700 transition rounded-r-xl">

        <svg class="w-5 h-5"
            fill="currentColor"
            viewBox="0 0 20 20">

            <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"/>

        </svg>

    </a>

@else

    <span aria-disabled="true">

        <span
            class="relative inline-flex items-center px-3 py-2 border border-gray-200 bg-gray-100 text-gray-400 rounded-r-xl cursor-not-allowed">

            <svg class="w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20">

                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"/>

            </svg>

        </span>

    </span>

@endif

            </span>

        </div>

    </div>

</nav>

@endif
