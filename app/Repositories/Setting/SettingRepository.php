<?php

namespace App\Repositories\Setting;


interface SettingRepository
{


    public function getSetting();


    public function updateSetting(
        array $data
    );


}