<?php

namespace App\Services\StockMonitoring;

use LaravelEasyRepository\Service;
use App\Repositories\StockMonitoring\StockMonitoringRepository;

class StockMonitoringServiceImplement extends Service implements StockMonitoringService
{

    protected $mainRepository;


    public function __construct(
        StockMonitoringRepository $mainRepository
    )
    {
        $this->mainRepository = $mainRepository;
    }


    public function getStockMonitoring()
    {
        return $this->mainRepository->getStockMonitoring();
    }

}