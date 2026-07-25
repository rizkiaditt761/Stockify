<?php

namespace App\Repositories\Supplier;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Supplier;

class SupplierRepositoryImplement extends Eloquent implements SupplierRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }

    public function getSupplierData(array $filters)
{
    $query = Supplier::query();

    if (!empty($filters['search'])) {

        $query->where(function ($q) use ($filters) {

            $q->where('name', 'like', '%' . $filters['search'] . '%')
              ->orWhere('email', 'like', '%' . $filters['search'] . '%')
              ->orWhere('phone', 'like', '%' . $filters['search'] . '%');

        });

    }

    return $query
        ->withCount('products')
        ->orderBy('name')
        ->paginate(10)
        ->withQueryString();
}
    // Write something awesome :)
}
