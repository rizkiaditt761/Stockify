<?php

namespace App\Services\Activity;


use LaravelEasyRepository\Service;

use App\Models\Activity;

use App\Repositories\Activity\ActivityRepository;


class ActivityServiceImplement extends Service implements ActivityService
{

    protected $mainRepository;


    public function __construct(
        ActivityRepository $mainRepository
    )
    {

        $this->mainRepository = $mainRepository;

    }



    /*
    |--------------------------------------------------------------------------
    | Create Activity Log
    |--------------------------------------------------------------------------
    */

    public function log(
        string $module,
        string $action,
        string $description,
        $subject = null
    )
    {

        return Activity::create([

            'user_id' => auth()->id(),

            'module' => $module,

            'action' => $action,

            'description' => $description,


            'subject_type' => $subject
                ? get_class($subject)
                : null,


            'subject_id' => $subject?->id,

        ]);

    }



    /*
    |--------------------------------------------------------------------------
    | Get Activity Logs
    |--------------------------------------------------------------------------
    */

    public function getActivities(
        array $filters = []
    )
    {

        return $this->mainRepository
            ->getActivities($filters);

    }

}