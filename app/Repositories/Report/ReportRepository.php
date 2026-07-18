<?php

namespace App\Repositories\Report;

use LaravelEasyRepository\Repository;

interface ReportRepository extends Repository
{
    public function getDashboardData($startDate = null, $endDate = null);
}