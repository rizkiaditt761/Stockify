<?php

namespace App\Services\StockTransaction;

use LaravelEasyRepository\Service;
use App\Repositories\StockTransaction\StockTransactionRepository;

class StockTransactionServiceImplement extends Service implements StockTransactionService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(StockTransactionRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function createTransaction(array $data)
{
    return $this->mainRepository->createTransaction($data);
}

   
}
