<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockOpname\StockOpnameService;
use App\Models\StockOpname;

class StockOpnameController extends Controller
{
    protected $stockOpnameService;

    public function __construct(StockOpnameService $stockOpnameService)
    {
        $this->stockOpnameService = $stockOpnameService;
    }

    public function index()
    {
        $products = $this->stockOpnameService->getProducts();

        $opnames = StockOpname::with('product')
            ->latest()
            ->get();

        return view(
            'pages.stock_opname.index',
            compact(
                'products',
                'opnames'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'physical_stock' => 'required|integer|min:0',
            'note' => 'nullable'
        ]);

        $this->stockOpnameService->store(
            $request->all()
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Stock opname berhasil disimpan.'
            );
    }
}