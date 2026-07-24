<?php

namespace App\Repositories\Activity;

use LaravelEasyRepository\Implementations\Eloquent;

use App\Models\Activity;

class ActivityRepositoryImplement extends Eloquent implements ActivityRepository
{

    public function getActivities(array $filters = [])
    {

        $query = Activity::with([
            'user'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Personal User Filter
        |--------------------------------------------------------------------------
        */

        if (!empty($filters['user_id'])) {

            $query->where(
                'user_id',
                $filters['user_id']
            );

        }



        /*
        |--------------------------------------------------------------------------
        | Filter Module
        |--------------------------------------------------------------------------
        */

        if (!empty($filters['module'])) {

            $query->where(
                'module',
                $filters['module']
            );

        }



        /*
        |--------------------------------------------------------------------------
        | Filter Date Range
        |--------------------------------------------------------------------------
        */

        if (!empty($filters['start_date'])) {

            $query->whereDate(
                'created_at',
                '>=',
                $filters['start_date']
            );

        }


        if (!empty($filters['end_date'])) {

            $query->whereDate(
                'created_at',
                '<=',
                $filters['end_date']
            );

        }



        /*
        |--------------------------------------------------------------------------
        | Search Activity
        |--------------------------------------------------------------------------
        */

        if (!empty($filters['search'])) {


            $search = $filters['search'];


            $query->where(function ($q) use ($search) {


                $q->where(
                    'module',
                    'like',
                    "%{$search}%"
                )


                ->orWhere(
                    'action',
                    'like',
                    "%{$search}%"
                )


                ->orWhere(
                    'description',
                    'like',
                    "%{$search}%"
                );


            });


        }



        return $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

    }

}