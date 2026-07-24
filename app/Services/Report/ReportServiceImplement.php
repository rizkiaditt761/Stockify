<?php

namespace App\Services\Report;

use LaravelEasyRepository\Service;
use App\Repositories\Report\ReportRepository;

class ReportServiceImplement extends Service implements ReportService
{
    protected $mainRepository;

    public function __construct(
        ReportRepository $mainRepository
    ) {
        $this->mainRepository = $mainRepository;
    }

    public function getReportData(array $filters)
    {
        return $this->mainRepository
            ->getReportData($filters);
    }
}