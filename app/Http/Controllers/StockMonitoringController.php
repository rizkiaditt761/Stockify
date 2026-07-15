<?php

namespace App\Http\Controllers;

use App\Services\StockMonitoring\StockMonitoringService;

class StockMonitoringController extends Controller
{

    protected $service;


    public function __construct(
        StockMonitoringService $service
    )
    {
        $this->service = $service;
    }


    public function index()
    {
        $products = $this->service->getStockMonitoring();


        return view(
            'pages.stock_monitoring.index',
            compact('products')
        );
    }

}