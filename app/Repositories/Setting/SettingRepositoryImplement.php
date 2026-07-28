<?php

namespace App\Repositories\Setting;


use LaravelEasyRepository\Implementations\Eloquent;

use App\Models\Setting;


class SettingRepositoryImplement 
extends Eloquent 
implements SettingRepository
{


    protected $model;



    public function __construct(
        Setting $model
    )
    {

        $this->model = $model;

    }



    public function getSetting()
    {

        return Setting::firstOrCreate(
            [
                'id'=>1
            ],
            [
                'app_name'=>'Stockify'
            ]
        );

    }





    public function updateSetting(
        array $data
    )
    {

        $setting = $this->getSetting();


        $setting->update($data);


        return $setting;

    }


}