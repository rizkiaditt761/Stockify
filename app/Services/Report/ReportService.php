<?php

namespace App\Services\Report;

use LaravelEasyRepository\BaseService;

interface ReportService extends BaseService
{
    public function getDashboardData($startDate = null, $endDate = null);
}