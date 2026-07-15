<?php

namespace App\Repositories\StockMonitoring;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Product;

class StockMonitoringRepositoryImplement extends Eloquent implements StockMonitoringRepository
{

    protected $model;


    public function __construct(Product $model)
    {
        $this->model = $model;
    }


    public function getStockMonitoring()
    {
        return $this->model
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->get();
    }

}