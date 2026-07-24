<?php

namespace App\Services\Dashboard;

use LaravelEasyRepository\Service;
use App\Repositories\Dashboard\DashboardRepository;

class DashboardServiceImplement extends Service implements DashboardService
{
    protected $mainRepository;

    public function __construct(
        DashboardRepository $mainRepository
    ) {
        $this->mainRepository = $mainRepository;
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard Data
    |--------------------------------------------------------------------------
    */

    public function getDashboardData()
    {
        return $this->mainRepository->getDashboardData();
    }
}