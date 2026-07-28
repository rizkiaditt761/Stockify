<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Activity\ActivityService;
use App\Services\Activity\ActivityServiceImplement;

use App\Repositories\Setting\SettingRepository;
use App\Repositories\Setting\SettingRepositoryImplement;

use App\Models\Setting;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(
            ActivityService::class,
            ActivityServiceImplement::class
        );


        $this->app->bind(
            SettingRepository::class,
            SettingRepositoryImplement::class
        );
    }



    public function boot(): void
    {

        View::composer('*', function ($view) {

            $view->with(
                'appSetting',
                Setting::first()
            );

        });

    }

}