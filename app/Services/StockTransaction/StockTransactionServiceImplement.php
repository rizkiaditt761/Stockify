<?php

namespace App\Services\StockTransaction;

use LaravelEasyRepository\Service;
use App\Repositories\StockTransaction\StockTransactionRepository;

class StockTransactionServiceImplement extends Service implements StockTransactionService
{
    /**
     * don't change $this->mainRepository variable name
     */
    protected $mainRepository;

    public function __construct(
        StockTransactionRepository $mainRepository
    ) {
        $this->mainRepository = $mainRepository;
    }

    public function createTransaction(array $data)
    {
        return $this->mainRepository->createTransaction($data);
    }

    public function findById($id)
    {
        return $this->mainRepository->findById($id);
    }

    public function updateTransaction($id, array $data)
    {
        return $this->mainRepository->updateTransaction($id, $data);
    }
}