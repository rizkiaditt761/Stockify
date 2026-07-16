<nav class="fixed top-0 left-0 z-50 w-full h-[72px] bg-white border-b border-gray-200 shadow-sm">

    <div class="flex items-center justify-between h-full px-6">

        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

            <img
                src="{{ asset('static/images/logo.svg') }}"
                alt="Stockify Logo"
                class="w-9 h-9">

            <span class="text-2xl font-bold text-gray-800">
                Stockify
            </span>

        </a>

        {{-- Right Side --}}
        <div class="flex items-center gap-5">

            {{-- Profile --}}
            <div class="flex items-center gap-3">

                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff"
                    class="w-10 h-10 rounded-full border"
                    alt="Profile">

                <div class="leading-tight text-right">

                    <p class="font-semibold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-sm text-gray-500 capitalize">
                        {{ auth()->user()->role }}
                    </p>

                </div>

            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="px-4 py-2 text-white transition bg-red-600 rounded-lg hover:bg-red-700">

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>