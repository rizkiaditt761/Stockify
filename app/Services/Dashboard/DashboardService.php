<?php

namespace App\Services\Dashboard;

use LaravelEasyRepository\BaseService;

interface DashboardService extends BaseService
{
    public function getDashboardData();
}