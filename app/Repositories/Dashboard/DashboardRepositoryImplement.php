<?php

namespace App\Repositories\Dashboard;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\StockTransaction;
use LaravelEasyRepository\Implementations\Eloquent;

class DashboardRepositoryImplement extends Eloquent implements DashboardRepository
{

    public function getStatistics()
    {
        return [

            'total_product' => Product::count(),

            'total_supplier' => Supplier::count(),

            'total_category' => Category::count(),


            'total_stock_in' => StockTransaction::where(
                'type',
                'IN'
            )->count(),


            'total_stock_out' => StockTransaction::where(
                'type',
                'OUT'
            )->count(),


            'low_stock' => Product::whereColumn(
                'stock',
                '<=',
                'minimum_stock'
            )
            ->get()

        ];
    }

}