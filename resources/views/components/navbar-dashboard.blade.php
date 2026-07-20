<nav class="fixed top-0 left-0 z-50 w-full h-[72px] bg-white border-b border-gray-200 shadow-sm">

    <div class="flex items-center justify-between h-full px-6">

        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

            <img
                src="{{ asset('static/images/logo.svg') }}"
                class="w-10 h-10"
                alt="Stockify">

            <div>

                <h1 class="text-xl font-bold text-gray-800">
                    Stockify
                </h1>

                <p class="text-xs text-gray-500">
                    Warehouse Management
                </p>

            </div>

        </a>

        {{-- Right --}}
        <div class="relative">

            <button
                id="profileButton"
                type="button"
                class="flex items-center gap-3 px-2 py-1.5 rounded-xl hover:bg-gray-100 transition-all duration-200">

                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff"
                    class="w-10 h-10 rounded-full ring-2 ring-blue-500 object-cover">

                <div class="hidden md:block text-left">

                    <p class="font-semibold text-gray-800 leading-none">

                        {{ auth()->user()->name }}

                    </p>

                    <span class="text-xs text-gray-500 capitalize">

                        {{ auth()->user()->role }}

                    </span>

                </div>

                <svg
                    class="w-5 h-5 text-gray-500 transition duration-300"
                    id="dropdownArrow"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 9l-7 7-7-7"/>

                </svg>

            </button>

            <div
                id="profileDropdown"
                class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 opacity-0 invisible scale-95 -translate-y-2 transition-all duration-200 origin-top-right">

                                {{-- Header --}}
                <div class="px-5 py-4 border-b">

                    <div class="flex items-center gap-3">

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff"
                            class="w-12 h-12 rounded-full">

                        <div>

                            <h3 class="font-semibold text-gray-800">

                                {{ auth()->user()->name }}

                            </h3>

                            <p class="text-sm text-gray-500">

                                {{ auth()->user()->email }}

                            </p>

                            <span
                                class="inline-flex mt-1 px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-700 capitalize">

                                {{ auth()->user()->role }}

                            </span>

                        </div>

                    </div>

                </div>

                {{-- Menu --}}
                <div class="py-2">

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50 transition">

                        <svg class="w-5 h-5 text-gray-500"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5.121 17.804A9 9 0 1118.364 4.56M15 11a3 3 0 11-6 0 3 3 0 016 0zm-9 9a6 6 0 1112 0"/>

                        </svg>

                        <span class="text-gray-700">

                            My Profile

                        </span>

                    </a>

                    <button
                        disabled
                        class="flex w-full items-center gap-3 px-5 py-3 text-gray-400 cursor-not-allowed">

                        <svg class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4s4-1.79 4-4s-1.79-4-4-4zm8 4a8 8 0 01-.24 1.95l2.06 1.6l-2 3.46l-2.43-.98a8.2 8.2 0 01-3.37 1.95L13.5 22h-3l-.52-2.02a8.2 8.2 0 01-3.37-1.95l-2.43.98l-2-3.46l2.06-1.6A8 8 0 014 12c0-.67.08-1.32.24-1.95L2.18 8.45l2-3.46l2.43.98A8.2 8.2 0 019.98 4L10.5 2h3l.52 2.02a8.2 8.2 0 013.37 1.95l2.43-.98l2 3.46l-2.06 1.6c.16.63.24 1.28.24 1.95z"/>

                        </svg>

                        Settings

                        <span class="ml-auto text-xs">

                            Soon

                        </span>

                    </button>

                </div>

                <div class="border-t">

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button
                            class="flex items-center w-full gap-3 px-5 py-3 text-red-600 hover:bg-red-50 rounded-b-2xl transition">

                            <svg class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>

                            </svg>

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</nav>

<script>

const profileButton = document.getElementById('profileButton');
const profileDropdown = document.getElementById('profileDropdown');
const dropdownArrow = document.getElementById('dropdownArrow');

profileButton.addEventListener('click', () => {

    profileDropdown.classList.toggle('opacity-0');
    profileDropdown.classList.toggle('invisible');
    profileDropdown.classList.toggle('scale-95');
    profileDropdown.classList.toggle('-translate-y-2');

    dropdownArrow.classList.toggle('rotate-180');

});

document.addEventListener('click', function(e){

    if(!profileButton.contains(e.target) &&
       !profileDropdown.contains(e.target)){

        profileDropdown.classList.add(
            'opacity-0',
            'invisible',
            'scale-95',
            '-translate-y-2'
        );

        dropdownArrow.classList.remove('rotate-180');

    }

});

</script>