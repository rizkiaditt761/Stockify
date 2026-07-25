<?php

namespace App\Services\Supplier;

use LaravelEasyRepository\BaseService;
use App\Services\Supplier\SupplierService;

interface SupplierService extends BaseService
{
    public function getSupplierData(array $filters);
}
