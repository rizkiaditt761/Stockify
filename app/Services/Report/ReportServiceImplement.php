<?php

namespace App\Services\Report;

use LaravelEasyRepository\Service;

use App\Repositories\Report\ReportRepository;

class ReportServiceImplement extends Service implements ReportService
{
    protected $mainRepository;

    public function __construct(ReportRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function getDashboardData($startDate = null, $endDate = null)
    {
        return $this->mainRepository->getDashboardData(
            $startDate,
            $endDate
        );
    }
}