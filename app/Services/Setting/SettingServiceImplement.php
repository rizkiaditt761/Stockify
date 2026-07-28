<?php

namespace App\Services\Setting;


use App\Repositories\Setting\SettingRepository;
use Illuminate\Support\Facades\Storage;


class SettingServiceImplement implements SettingService
{

    protected $settingRepository;



    public function __construct(
        SettingRepository $settingRepository
    )
    {
        $this->settingRepository = $settingRepository;
    }




    public function getSetting()
    {

        return $this->settingRepository
            ->getSetting();

    }




    public function updateSetting(
        array $data
    )
    {

        $setting = $this->getSetting();



        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */


        if(isset($data['logo'])){


            if($setting->logo){

                Storage::disk('public')
                    ->delete($setting->logo);

            }


            $data['logo'] =
                $data['logo']
                ->store(
                    'settings',
                    'public'
                );

        }





        /*
        |--------------------------------------------------------------------------
        | Upload Favicon
        |--------------------------------------------------------------------------
        */


        if(isset($data['favicon'])){


            if($setting->favicon){

                Storage::disk('public')
                    ->delete($setting->favicon);

            }



            $data['favicon'] =
                $data['favicon']
                ->store(
                    'settings',
                    'public'
                );

        }



        return $this->settingRepository
            ->updateSetting($data);

    }


}