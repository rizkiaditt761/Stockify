<?php

namespace App\Services\Activity;


interface ActivityService
{

    public function log(
        string $module,
        string $action,
        string $description,
        $subject = null
    );


    public function getActivities(
        array $filters = []
    );

}