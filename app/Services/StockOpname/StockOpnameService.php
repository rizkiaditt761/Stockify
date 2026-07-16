<?php

namespace App\Services\StockOpname;

use LaravelEasyRepository\BaseService;

interface StockOpnameService extends BaseService
{
    public function getProducts();

    public function store(array $data);
}