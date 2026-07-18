<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('name')
            ->get();

        $totalProduct = Product::count();

        $stockSafe = Product::whereColumn('stock', '>', 'minimum_stock')->count();

        $stockLow = Product::where('stock', '>', 0)
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->count();

        $stockEmpty = Product::where('stock', 0)->count();

        return view('pages.stock_monitoring.index', compact(
            'products',
            'totalProduct',
            'stockSafe',
            'stockLow',
            'stockEmpty'
        ));
    }
}