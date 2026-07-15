<?php

namespace App\Services\StockMonitoring;

use LaravelEasyRepository\BaseService;

interface StockMonitoringService extends BaseService
{
    public function getStockMonitoring();
}