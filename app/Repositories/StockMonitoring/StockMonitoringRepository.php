<?php

namespace App\Repositories\StockMonitoring;

use LaravelEasyRepository\Repository;

interface StockMonitoringRepository extends Repository
{
    public function getStockMonitoring();
}