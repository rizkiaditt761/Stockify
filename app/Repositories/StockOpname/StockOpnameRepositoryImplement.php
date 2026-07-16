<?php

namespace App\Repositories\StockOpname;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\StockOpname;
use App\Models\Product;

class StockOpnameRepositoryImplement extends Eloquent implements StockOpnameRepository
{
    protected $model;

    public function __construct(StockOpname $model)
    {
        $this->model = $model;
    }

    public function getProducts()
    {
        return Product::all();
    }
}