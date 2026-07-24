<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockOpname;
use App\Services\Activity\ActivityService;
use App\Services\StockOpname\StockOpnameService;

class StockOpnameController extends Controller
{
    protected $stockOpnameService;
    protected $activityService;

    public function __construct(
        StockOpnameService $stockOpnameService,
        ActivityService $activityService
    ) {
        $this->stockOpnameService = $stockOpnameService;
        $this->activityService = $activityService;
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
            'product_id'     => 'required',
            'physical_stock' => 'required|integer|min:0',
            'note'           => 'nullable',
        ]);

        $opname = $this->stockOpnameService->store(
            $request->all()
        );

        $this->activityService->log(

            'Stock Opname',

            'CREATE',

            'Melakukan Stock Opname pada produk ' .
            $opname->product->name .
            ' (Stock Sistem: ' .
            $opname->system_stock .
            ', Stock Fisik: ' .
            $opname->physical_stock .
            ')',

            $opname

        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Stock opname berhasil disimpan.'
            );
    }
}