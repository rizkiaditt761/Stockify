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

        // Filter berdasarkan status stok
        if ($status == 'safe') {

            $query->whereColumn('stock', '>', 'minimum_stock');

        } elseif ($status == 'low') {

            $query->where('stock', '>', 0)
                ->whereColumn('stock', '<=', 'minimum_stock');

        } elseif ($status == 'empty') {

            $query->where('stock', 0);

        }

        // Search
        if ($request->filled('search')) {

            $query->where('name', 'like', '%' . $request->search . '%');

        }

        $products = $query
            ->orderBy('name')
            ->get();

        // Statistik
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
            'stockEmpty',
            'status'
        ));
    }
}