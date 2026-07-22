<?php

namespace App\Repositories\StockTransaction;

use LaravelEasyRepository\Repository;

interface StockTransactionRepository extends Repository
{
    public function createTransaction(array $data);

    public function findById($id);

    public function updateTransaction($id, array $data);
}