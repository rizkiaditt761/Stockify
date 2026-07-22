<?php

namespace App\Repositories\StockTransaction;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\StockTransaction;

class StockTransactionRepositoryImplement extends Eloquent implements StockTransactionRepository
{
    /**
     * Model class
     *
     * @property StockTransaction $model
     */
    protected $model;

    public function __construct(StockTransaction $model)
    {
        $this->model = $model;
    }

    public function createTransaction(array $data)
    {
        return $this->model->create($data);
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateTransaction($id, array $data)
    {
        $transaction = $this->findById($id);

        $transaction->update($data);

        return $transaction;
    }
}