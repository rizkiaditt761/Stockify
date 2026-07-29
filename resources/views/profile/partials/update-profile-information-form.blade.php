<form
    method="POST"
    action="{{ route('profile.update') }}"
    enctype="multipart/form-data"
    class="space-y-8">

    @csrf
    @method('PATCH')

    {{-- =============================== --}}
    {{-- GRID --}}
    {{-- =============================== --}}

    <div class="grid gap-8 lg:grid-cols-2">

        {{-- =============================== --}}
        {{-- Nama --}}
        {{-- =============================== --}}

        <div>

            <label
                for="name"
                class="mb-2 block text-sm font-semibold text-gray-700">

                Nama Lengkap

            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

            @error('name')

                <p class="mt-2 text-sm text-red-500">

                    {{ $message }}

                </p>

            @enderror

        </div>



        {{-- =============================== --}}
        {{-- Email --}}
        {{-- =============================== --}}

        <div>

            <label
                for="email"
                class="mb-2 block text-sm font-semibold text-gray-700">

                Email

            </label>

            <input
                type="email"
                value="{{ $user->email }}"
                readonly
                class="w-full rounded-lg border-gray-200 bg-gray-100 text-gray-500 cursor-not-allowed">
                          
            @error('email')

                <p class="mt-2 text-sm text-red-500">

                    {{ $message }}

                </p>

            @enderror

        </div>
                {{-- =============================== --}}
        {{-- Upload Avatar --}}
        {{-- =============================== --}}

        <div class="lg:col-span-2">

            <label
                for="avatar"
                class="mb-2 block text-sm font-semibold text-gray-700">

                Foto Profil

            </label>

            <div class="mb-5 flex justify-center">

            @if($user->avatar)

                <img
                    id="avatarPreview"
                    src="{{ asset('storage/' . $user->avatar) }}"
                    class="h-32 w-32 rounded-full border-4 border-blue-100 object-cover shadow">

            @else

                <img
                    id="avatarPreview"
                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff&size=256"
                    class="h-32 w-32 rounded-full border-4 border-blue-100 object-cover shadow">

            @endif

        </div>

            <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-6">

                <input
                    id="avatarInput"
                    name="avatar"
                    type="file"
                    accept="image/*"
                    class="block w-full rounded-lg border border-gray-300 bg-white text-sm
                           file:mr-4
                           file:rounded-lg
                           file:border-0
                           file:bg-blue-600
                           file:px-4
                           file:py-2
                           file:text-sm
                           file:font-semibold
                           file:text-white
                           hover:file:bg-blue-700">

                <p class="mt-3 text-xs text-gray-500">

                    Format yang didukung:
                    JPG, JPEG, PNG, WEBP • Maksimal 2 MB.

                </p>
                @if($user->avatar)

                <button
                    type="button"
                    onclick="deleteAvatar()"
                    class="mt-4 inline-flex items-center rounded-lg bg-red-100 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-200">

                    <svg
                        class="mr-2 h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"/>

                    </svg>

                    Hapus Foto Profil

                </button>


                

                

@endif

                @error('avatar')

                    <p class="mt-2 text-sm text-red-500">

                        {{ $message }}

                    </p>

                @enderror

            </div>

        </div>

    </div>
        {{-- =============================== --}}
    {{-- Tombol Simpan --}}
    {{-- =============================== --}}

    <div class="flex flex-col gap-4 border-t border-gray-200 pt-6 sm:flex-row sm:items-center sm:justify-between">

        <div>

            @if (
    session('status') === 'profile-updated'
    ||
    session('status') === 'avatar-deleted'
)

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

                    @if(session('status') === 'avatar-deleted')

                        Foto profil berhasil dihapus.

                    @else

                        Profil berhasil diperbarui.

                    @endif

                </div>

            @else

                <p class="text-sm text-gray-500">

                    Pastikan data yang dimasukkan sudah benar sebelum disimpan.

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

            Simpan Perubahan

        </button>

    </div>

    <script>

document
.getElementById('avatarInput')
.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(!file) return;

    document
        .getElementById('avatarPreview')
        .src = URL.createObjectURL(file);

});

function deleteAvatar(){

    if(confirm('Hapus foto profil?')){

        document
            .getElementById('deleteAvatarForm')
            .submit();

    }

}

</script>

</form>
<form
                    id="deleteAvatarForm"
                    method="POST"
                    action="{{ route('profile.avatar.delete') }}"
                    class="hidden">

                    @csrf
                    @method('DELETE')

                </form>
