<?php

namespace App\Services\StockOpname;

use LaravelEasyRepository\Service;
use App\Repositories\StockOpname\StockOpnameRepository;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\Auth;

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

        $systemStock = $product->stock;
        $physicalStock = $data['physical_stock'];

        // Selisih stok
        $difference = $physicalStock - $systemStock;

        // Simpan data stock opname
        $this->mainRepository->create([
            'product_id'     => $product->id,
            'system_stock'   => $systemStock,
            'physical_stock' => $physicalStock,
            'difference'     => $difference,
            'note'           => $data['note'] ?? null,
        ]);

        // Update stok produk
        $product->update([
            'stock' => $physicalStock,
        ]);

        // Jika ada selisih, buat transaksi otomatis
        if ($difference != 0) {

            StockTransaction::create([
                'product_id'       => $product->id,
                'user_id'          => Auth::id(),
                'type'             => $difference > 0 ? 'IN' : 'OUT',
                'quantity'         => abs($difference),
                'stock_before'     => $systemStock,
                'stock_after'      => $physicalStock,
                'transaction_date' => now(),
                'status'           => 'Completed',
                'notes'            => 'Stock Opname',
            ]);
        }
    }
}