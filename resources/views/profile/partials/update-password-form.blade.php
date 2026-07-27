<form
    method="POST"
    action="{{ route('password.update') }}"
    class="space-y-8">

    @csrf
    @method('PUT')

    {{-- =============================== --}}
    {{-- GRID --}}
    {{-- =============================== --}}

    <div class="grid gap-8 lg:grid-cols-2">

        {{-- =============================== --}}
        {{-- Password Lama --}}
        {{-- =============================== --}}

        <div class="lg:col-span-2">

            <label
                for="update_password_current_password"
                class="mb-2 block text-sm font-semibold text-gray-700">

                Password Saat Ini

            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                placeholder="Masukkan password saat ini"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @if($errors->updatePassword->has('current_password'))

                <p class="mt-2 text-sm text-red-500">

                    {{ $errors->updatePassword->first('current_password') }}

                </p>

            @endif

        </div>



        {{-- =============================== --}}
        {{-- Password Baru --}}
        {{-- =============================== --}}

        <div>

            <label
                for="update_password_password"
                class="mb-2 block text-sm font-semibold text-gray-700">

                Password Baru

            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @if($errors->updatePassword->has('password'))

                <p class="mt-2 text-sm text-red-500">

                    {{ $errors->updatePassword->first('password') }}

                </p>

            @endif

        </div>



        {{-- =============================== --}}
        {{-- Konfirmasi Password --}}
        {{-- =============================== --}}

        <div>

            <label
                for="update_password_password_confirmation"
                class="mb-2 block text-sm font-semibold text-gray-700">

                Konfirmasi Password Baru

            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                placeholder="Ulangi password baru"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @if($errors->updatePassword->has('password_confirmation'))

                <p class="mt-2 text-sm text-red-500">

                    {{ $errors->updatePassword->first('password_confirmation') }}

                </p>

            @endif

        </div>

    </div>
        {{-- =============================== --}}
    {{-- Footer --}}
    {{-- =============================== --}}

    <div class="flex flex-col gap-4 border-t border-gray-200 pt-6 sm:flex-row sm:items-center sm:justify-between">

        <div>

            @if (session('status') === 'password-updated')

                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="inline-flex items-center rounded-lg bg-green-100 px-4 py-2 text-sm font-medium text-green-700">

                    <svg
                        class="mr-2 h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7"/>

                    </svg>

                    Password berhasil diperbarui.

                </div>

            @else

                <p class="text-sm text-gray-500">

                    Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol
                    agar password lebih aman.

                </p>

            @endif

        </div>

        <button
            type="submit"
            class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow transition hover:bg-blue-700">

            <svg
                class="mr-2 h-5 w-5"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 13l4 4L19 7"/>

            </svg>

            Perbarui Password

        </button>

    </div>

</form>