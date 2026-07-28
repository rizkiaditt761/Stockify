@extends('layouts.dashboard')

@section('content')

<div class="p-4 space-y-6">


    {{-- HEADER --}}
    <div
        class="rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white shadow-lg">


        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">


            <div>

                <div class="mb-2 flex items-center gap-2">

                    <svg
                        class="h-7 w-7"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/>

                    </svg>


                    <h1 class="text-3xl font-bold">
                        Pengaturan Aplikasi
                    </h1>

                </div>


                <p class="text-sm text-blue-100">
                    Kelola identitas, branding, dan informasi utama Stockify.
                </p>


            </div>



            


        </div>


    </div>







    @if(session('status') === 'setting-updated')

        <div
            class="rounded-xl border border-green-200 bg-green-50 px-5 py-3 text-sm font-semibold text-green-700">

            ✓ Pengaturan aplikasi berhasil diperbarui.

        </div>

    @endif








<form
    action="{{ route('settings.update') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6">


@csrf
@method('PATCH')





{{-- BRANDING --}}
<div class="grid gap-6 lg:grid-cols-2">



    {{-- LOGO --}}
    <div
        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">


        <div class="mb-5 flex items-center gap-3">

            <div class="rounded-xl bg-blue-100 p-3 text-blue-600">

                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>

                </svg>

            </div>


            <div>

                <h2 class="font-bold text-gray-800">
                    Logo Aplikasi
                </h2>

                <p class="text-xs text-gray-500">
                    Logo utama Stockify
                </p>

            </div>


        </div>





        <div class="mb-5 flex justify-center">


            @if($setting->logo)

                <img
                    id="logoPreview"
                    src="{{ asset('storage/'.$setting->logo) }}"
                    class="h-36 w-36 rounded-2xl border object-contain shadow">


            @else

                <div
                    id="logoPlaceholder"
                    class="flex h-36 w-36 items-center justify-center rounded-2xl bg-blue-100 text-5xl font-bold text-blue-600">

                    S

                </div>


            @endif


        </div>




        <input
            id="logoInput"
            type="file"
            name="logo"
            accept="image/*"
            class="block w-full rounded-xl border border-gray-300 text-sm
            file:mr-4
            file:rounded-lg
            file:border-0
            file:bg-blue-600
            file:px-4
            file:py-2
            file:text-white">



        <p class="mt-3 text-xs text-gray-500">
            PNG/JPG/WEBP maksimal 2MB.
        </p>



    </div>







    {{-- FAVICON --}}
    <div
        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">


        <div class="mb-5 flex items-center gap-3">

            <div class="rounded-xl bg-purple-100 p-3 text-purple-600">

                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 11c0 3.866-3.582 7-8 7a8 8 0 018-14c4.418 0 8 3.134 8 7"/>

                </svg>

            </div>


            <div>

                <h2 class="font-bold text-gray-800">
                    Favicon
                </h2>

                <p class="text-xs text-gray-500">
                    Icon browser tab
                </p>

            </div>

        </div>




        <div class="mb-5 flex justify-center">


            @if($setting->favicon)

                <img
                    id="faviconPreview"
                    src="{{ asset('storage/'.$setting->favicon) }}"
                    class="h-36 w-36 rounded-xl border object-contain shadow">


            @else

                <div
                    id="faviconPlaceholder"
                    class="flex h-28 w-28 items-center justify-center rounded-xl bg-gray-100 text-3xl font-bold text-gray-500">

                    ?

                </div>


            @endif


        </div>




        <input
            id="faviconInput"
            type="file"
            name="favicon"
            accept="image/*"
            class="block w-full rounded-xl border border-gray-300 text-sm
            file:mr-4
            file:rounded-lg
            file:border-0
            file:bg-purple-600
            file:px-4
            file:py-2
            file:text-white">


        <p class="mt-3 text-xs text-gray-500">
            Disarankan ukuran kecil (32x32 / 64x64).
        </p>



    </div>



</div>









{{-- INFORMATION --}}
<div
class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">


<h2 class="mb-6 text-xl font-bold text-gray-800">
    Informasi Aplikasi
</h2>



<div class="space-y-5">



<label class="block">

<span class="mb-2 block text-sm font-semibold text-gray-700">
Nama Aplikasi
</span>


<input
name="app_name"
value="{{ old('app_name',$setting->app_name) }}"
class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">


</label>





<label class="block">

<span class="mb-2 block text-sm font-semibold text-gray-700">
Deskripsi
</span>


<textarea
name="description"
rows="4"
class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('description',$setting->description) }}</textarea>


</label>





<label class="block">

<span class="mb-2 block text-sm font-semibold text-gray-700">
Footer Text
</span>


<input
name="footer_text"
value="{{ old('footer_text',$setting->footer_text) }}"
class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">


</label>



</div>


</div>






<div class="flex justify-end">


<button
type="submit"
class="rounded-xl bg-blue-600 px-8 py-3 font-semibold text-white shadow hover:bg-blue-700">


Simpan Perubahan


</button>


</div>




</form>


</div>





<script>


document
.getElementById('logoInput')
.addEventListener('change',function(e){

    const file=e.target.files[0];

    if(!file) return;


    let img=document.getElementById('logoPreview');


    if(!img){

        document
        .getElementById('logoPlaceholder')
        ?.remove();


        img=document.createElement('img');

        img.id='logoPreview';

        img.className=
        'h-36 w-36 rounded-2xl border object-contain shadow';


        document
        .querySelector('#logoInput')
        .parentElement
        .insertBefore(img,this);

    }


    img.src=URL.createObjectURL(file);

});





document
.getElementById('faviconInput')
.addEventListener('change',function(e){

    const file=e.target.files[0];

    if(!file) return;


    let img=document.getElementById('faviconPreview');


    if(img){

        img.src=URL.createObjectURL(file);

    }

});

</script>


@endsection