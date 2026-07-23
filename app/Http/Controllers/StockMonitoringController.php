<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockMonitoringController extends Controller
{
    public function index(Request $request)
{
    $status = $request->status;

    $query = Product::with('category');

    /*
    |--------------------------------------------------------------------------
    | Filter Status
    |--------------------------------------------------------------------------
    */

    if ($status == 'safe') {

        $query->where('is_active', true)
              ->whereColumn('stock', '>', 'minimum_stock');

    } elseif ($status == 'low') {

        $query->where('is_active', true)
              ->where('stock', '>', 0)
              ->whereColumn('stock', '<=', 'minimum_stock');

    } elseif ($status == 'empty') {

        $query->where('is_active', true)
              ->where('stock', 0);

    } elseif ($status == 'inactive') {

        $query->where('is_active', false);

    }

    /*
    |--------------------------------------------------------------------------
    | Search Product / Category
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where(
                'name',
                'like',
                "%{$search}%"
            )

            ->orWhereHas('category', function ($category) use ($search) {

                $category->where(
                    'name',
                    'like',
                    "%{$search}%"
                );

            });

        });

    }

    $products = $query
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Statistic Card
    |--------------------------------------------------------------------------
    */

    $totalProduct = Product::count();

    $totalStock = Product::sum('stock');

    $stockSafe = Product::where('is_active', true)
        ->whereColumn('stock', '>', 'minimum_stock')
        ->count();

    $stockLow = Product::where('is_active', true)
        ->where('stock', '>', 0)
        ->whereColumn('stock', '<=', 'minimum_stock')
        ->count();

    $stockEmpty = Product::where('is_active', true)
        ->where('stock', 0)
        ->count();

    $stockInactive = Product::where('is_active', false)
        ->count();

    return view(
        'pages.stock_monitoring.index',
        compact(
            'products',
            'totalProduct',
            'totalStock',
            'stockSafe',
            'stockLow',
            'stockEmpty',
            'stockInactive',
            'status'
        )
    );
}
}