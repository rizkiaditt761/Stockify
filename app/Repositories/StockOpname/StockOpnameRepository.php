<?php

namespace App\Repositories\StockOpname;

use LaravelEasyRepository\Repository;

interface StockOpnameRepository extends Repository
{
    public function getProducts();

}