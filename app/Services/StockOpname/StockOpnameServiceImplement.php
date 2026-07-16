<?php

namespace App\Services\StockOpname;

use LaravelEasyRepository\Service;
use App\Repositories\StockOpname\StockOpnameRepository;
use App\Models\Product;

class StockOpnameServiceImplement extends Service implements StockOpnameService
{
    protected $mainRepository;

    public function __construct(StockOpnameRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function getProducts()
    {
        return $this->mainRepository->getProducts();
    }

    public function store(array $data)
    {
        $product = Product::findOrFail($data['product_id']);

        $difference = $data['physical_stock'] - $product->stock;

        $this->mainRepository->create([
            'product_id' => $product->id,
            'system_stock' => $product->stock,
            'physical_stock' => $data['physical_stock'],
            'difference' => $difference,
            'note' => $data['note'] ?? null,
        ]);

        $product->update([
            'stock' => $data['physical_stock'],
        ]);
    }
}