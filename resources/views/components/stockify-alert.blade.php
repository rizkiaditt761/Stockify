@once


<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-borderless/borderless.css"
>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<style>


/* =====================================================
   STOCKIFY ALERT SYSTEM v1
===================================================== */


/* CONTAINER */

.swal2-container{

    z-index:99999!important;

}




/* POPUP */

.swal2-popup.stockify-popup{


    width:440px!important;

    padding:32px!important;

    border-radius:28px!important;

    background:#ffffff!important;


    box-shadow:

        0 25px 80px rgba(15,23,42,.18)!important;


    


}




/* IMAGE / LOGO */

.swal2-image{


    width:90px!important;

    height:90px!important;

    object-fit:contain!important;


    margin:

        10px auto 18px!important;


}




/* TITLE */

.swal2-title.stockify-title{


    padding:0!important;


    margin:

        0 0 12px!important;


    font-size:26px!important;


    font-weight:800!important;


    color:#111827!important;


}




/* CONTENT */

.swal2-html-container{


    padding:0!important;


    margin:0!important;


    font-size:15px!important;


    line-height:1.7!important;


    color:#64748b!important;


}




/* FOOTER */

.stockify-footer{


    margin-top:18px;


    font-size:12px;


    font-weight:600;


    color:#94a3b8;


}




/* BUTTON AREA */

.swal2-actions{


    margin-top:28px!important;


    gap:12px!important;


}




/* CONFIRM BUTTON */

.swal2-confirm.stockify-confirm-btn{


    min-width:120px;


    padding:

        12px 24px!important;


    border-radius:14px!important;


    background:#2563eb!important;


    color:white!important;


    font-size:14px!important;


    font-weight:700!important;


    box-shadow:

        0 5px 0 rgba(0,0,0,.12)!important;


    transition:.18s ease;


}



.swal2-confirm.stockify-confirm-btn:hover{


    transform:

        translateY(-2px);


}



.swal2-confirm.stockify-confirm-btn:active{


    transform:

        translateY(3px);


    box-shadow:none!important;


}




/* CANCEL BUTTON */

.swal2-cancel.stockify-cancel-btn{


    min-width:120px;


    padding:

        12px 24px!important;


    border-radius:14px!important;


    background:#e5e7eb!important;


    color:#374151!important;


    font-size:14px!important;


    font-weight:700!important;


}




/* BACKDROP */

.swal2-backdrop-show{


    backdrop-filter:

        blur(7px);


    background:

        rgba(15,23,42,.35)!important;


}




/* ANIMATION */





</style>





<script>


/* =====================================================
   STOCKIFY GLOBAL CONFIG
===================================================== */


window.StockifyConfig = {


    logo:


    @if(!empty($appSetting?->logo))


        "{{ asset('storage/'.$appSetting->logo) }}"


    @else


        "{{ asset('static/images/logo.svg') }}"


    @endif
    ,



    appName:


    "{{ $appSetting->app_name ?? 'Stockify' }}"


};



</script>



@endonce

<script>


/* =====================================================
   STOCKIFY CONFIRM ENGINE v1
===================================================== */


(function(){


    function initStockifyConfirm(){



        document
        .querySelectorAll('.stockify-confirm')
        .forEach(function(form){



            if(form.dataset.stockifyAttached){

                return;

            }



            form.dataset.stockifyAttached = true;




            form.addEventListener(
                'submit',
                function(e){



                    e.preventDefault();




                    const title =

                        form.dataset.confirmTitle

                        ??

                        'Konfirmasi Aksi';




                    const text =

                        form.dataset.confirmText

                        ??

                        'Apakah kamu yakin ingin melanjutkan aksi ini?';




                    const button =

                        form.dataset.confirmButton

                        ??

                        'Ya, Lanjutkan';





                    Swal.fire({



                        title:title,



                        html:

                        `

                        <div>

                            ${text}

                        </div>



                        <div class="stockify-footer">

                            ${window.StockifyConfig.appName}

                        </div>

                        `,



                        imageUrl:

                            window.StockifyConfig.logo,



                        imageWidth:90,


                        imageHeight:90,



                        showCancelButton:true,



                        confirmButtonText:

                            button,



                        cancelButtonText:

                            'Batal',




                        reverseButtons:true,



                        buttonsStyling:false,



                        customClass:{



                            popup:

                                'stockify-popup',



                            title:

                                'stockify-title',



                            confirmButton:

                                'stockify-confirm-btn',



                            cancelButton:

                                'stockify-cancel-btn'


                        }



                    })



                    .then(function(result){



                        if(result.isConfirmed){



                            HTMLFormElement
                            .prototype
                            .submit
                            .call(form);



                        }



                    });



                }

            );



        });



    }





    document.addEventListener(

        'DOMContentLoaded',

        initStockifyConfirm

    );



})();



</script>

<script>

/* =====================================================
   STOCKIFY FLASH MESSAGE ENGINE v2
===================================================== */

(function(){


    document.addEventListener(
        'DOMContentLoaded',
        function(){

             console.log('DOM READY FLASH');


            @php
                $successMessage = session()->pull('success');
                $errorMessage   = session()->pull('error');
                $warningMessage = session()->pull('warning');
                $infoMessage    = session()->pull('info');
            @endphp



            @if($successMessage)

            Swal.fire({

                title:
                    'Berhasil!',


                html:
                `
                <div>
                    {{ $successMessage }}
                </div>

                <div class="stockify-footer">

                    ${window.StockifyConfig.appName}

                </div>
                `,


                imageUrl:
                    window.StockifyConfig.logo,


                imageWidth:90,

                imageHeight:90,


                timer:2500,

                timerProgressBar:true,

                showConfirmButton:true,

                confirmButtonText:'OK',

                allowOutsideClick:true,

                allowEscapeKey:true,

                didClose: () => {

                    console.log('STOCKIFY SUCCESS CLOSED');

                },


                customClass:{

                    popup:
                        'stockify-popup',

                    title:
                        'stockify-title'

                }


            });


            @endif



            @if($errorMessage)

            Swal.fire({

                title:
                    'Gagal!',


                text:
                    "{{ $errorMessage }}",


                icon:
                    'error',


                confirmButtonText:
                    'Mengerti',


                customClass:{

                    popup:
                        'stockify-popup',

                    title:
                        'stockify-title',

                    confirmButton:
                        'stockify-confirm-btn'

                }

            });


            @endif



            @if($warningMessage)

            Swal.fire({

                title:
                    'Perhatian!',


                text:
                    "{{ $warningMessage }}",


                icon:
                    'warning',


                confirmButtonText:
                    'OK',


                customClass:{

                    popup:
                        'stockify-popup',

                    title:
                        'stockify-title',

                    confirmButton:
                        'stockify-confirm-btn'

                }

            });


            @endif



            @if($infoMessage)

            Swal.fire({

                title:
                    'Informasi!',


                text:
                    "{{ $infoMessage }}",


                icon:
                    'info',


                timer:2500,

                showConfirmButton:false,


                customClass:{

                    popup:
                        'stockify-popup',

                    title:
                        'stockify-title'

                }

            });


            @endif


        }
    );


})();


</script>

<script>


/* =====================================================
   STOCKIFY ALERT HELPER v1
===================================================== */


window.StockifyAlert = {



    success(message){



        Swal.fire({



            title:

                'Berhasil!',



            html:

            `

            <div>

                ${message}

            </div>



            <div class="stockify-footer">

                ${window.StockifyConfig.appName}

            </div>

            `,



            imageUrl:

                window.StockifyConfig.logo,



            imageWidth:

                90,



            imageHeight:

                90,



            timer:

                2500,



            timerProgressBar:

                true,



            showConfirmButton:

                false,



            customClass:{



                popup:

                    'stockify-popup',



                title:

                    'stockify-title'


            }



        });



    },







    error(message){



        Swal.fire({



            title:

                'Gagal!',



            html:

            `

            <div>

                ${message}

            </div>



            <div class="stockify-footer">

                ${window.StockifyConfig.appName}

            </div>

            `,



            imageUrl:

                window.StockifyConfig.logo,



            imageWidth:

                90,



            imageHeight:

                90,



            icon:

                'error',



            confirmButtonText:

                'Mengerti',



            buttonsStyling:

                false,



            customClass:{



                popup:

                    'stockify-popup',



                title:

                    'stockify-title',



                confirmButton:

                    'stockify-confirm-btn'


            }



        });



    },







    warning(message){



        Swal.fire({



            title:

                'Perhatian!',



            html:

            `

            <div>

                ${message}

            </div>



            <div class="stockify-footer">

                ${window.StockifyConfig.appName}

            </div>

            `,



            imageUrl:

                window.StockifyConfig.logo,



            imageWidth:

                90,



            imageHeight:

                90,



            icon:

                'warning',



            confirmButtonText:

                'OK',



            buttonsStyling:

                false,



            customClass:{



                popup:

                    'stockify-popup',



                title:

                    'stockify-title',



                confirmButton:

                    'stockify-confirm-btn'


            }



        });



    },







    info(message){



        Swal.fire({



            title:

                'Informasi!',



            html:

            `

            <div>

                ${message}

            </div>



            <div class="stockify-footer">

                ${window.StockifyConfig.appName}

            </div>

            `,



            imageUrl:

                window.StockifyConfig.logo,



            imageWidth:

                90,



            imageHeight:

                90,



            timer:

                2500,



            timerProgressBar:

                true,



            showConfirmButton:

                false,



            customClass:{



                popup:

                    'stockify-popup',



                title:

                    'stockify-title'


            }



        });



    }



};



</script>