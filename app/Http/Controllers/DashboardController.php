<?php

namespace App\Http\Controllers;

use App\Services\Dashboard\DashboardService;

class DashboardController extends Controller
{

    protected $dashboardService;


    public function __construct(
        DashboardService $dashboardService
    )
    {

        $this->dashboardService = $dashboardService;

    }



    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $data = $this->dashboardService
            ->getDashboardData();


        return view(
            'pages.dashboard.index',
            $data
        );

    }

}