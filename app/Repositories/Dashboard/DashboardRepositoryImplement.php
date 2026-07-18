<?php

namespace App\Repositories\Dashboard;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;

class DashboardRepositoryImplement extends Eloquent implements DashboardRepository
{
    public function getDashboardData()
{
    return [
        'totalProducts'      => Product::count(),
        'totalCategories'    => Category::count(),
        'totalSuppliers'     => Supplier::count(),
        'totalTransactions'  => StockTransaction::count(),

        'recentTransactions' => StockTransaction::with(['product', 'user'])
            ->latest()
            ->take(5)
            ->get(),

        'lowStocks' => Product::with('category')
        ->where('stock', '<=', 5)
        ->orderBy('stock')
        ->take(5)
        ->get(),

        'latestProducts' => Product::with('category')
        ->latest()
        ->take(5)
        ->get(),

        'transactionChart' => StockTransaction::select(
        DB::raw('DATE(transaction_date) as date'),
        DB::raw("SUM(CASE WHEN type='IN' THEN quantity ELSE 0 END) as total_in"),
        DB::raw("SUM(CASE WHEN type='OUT' THEN quantity ELSE 0 END) as total_out")
        )
        ->whereDate('transaction_date', '>=', now()->subDays(6))
        ->groupBy(DB::raw('DATE(transaction_date)'))
        ->orderBy('date')
        ->get(),
    ];
}
}