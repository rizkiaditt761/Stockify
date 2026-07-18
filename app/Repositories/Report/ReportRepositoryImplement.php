<?php

namespace App\Repositories\Report;

use LaravelEasyRepository\Implementations\Eloquent;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use App\Models\StockTransaction;
use App\Models\StockOpname;

class ReportRepositoryImplement extends Eloquent implements ReportRepository
{
    public function getDashboardData($startDate = null, $endDate = null)
{
    $transactions = StockTransaction::query();
    $opnames = StockOpname::query();

    if ($startDate && $endDate) {

        $transactions->whereBetween(
            'transaction_date',
            [$startDate, $endDate]
        );

        $opnames->whereBetween(
            'created_at',
            [$startDate, $endDate]
        );
    }

    // ===========================
    // Hitung Summary SESUDAH FILTER
    // ===========================

    $stockIn = (clone $transactions)
        ->where('type', 'IN')
        ->count();

    $stockOut = (clone $transactions)
        ->where('type', 'OUT')
        ->count();

    $stockOpname = (clone $opnames)
        ->count();

    return [

        'products' => Product::with([
            'category',
            'supplier'
        ])
        ->orderBy('name')
        ->get(),

        'suppliers' => Supplier::orderBy('name')->get(),

        'users' => User::orderBy('name')->get(),

        'categories' => \App\Models\Category::withCount('products')
            ->orderBy('name')
            ->get(),

        'transactions' => $transactions
            ->with('product')
            ->latest()
            ->get(),

        'opnames' => $opnames
            ->with('product')
            ->latest()
            ->get(),

        'summary' => [

            'total_products' => Product::count(),

            'total_suppliers' => Supplier::count(),

            'total_users' => User::count(),

            'stock_in' => $stockIn,

            'stock_out' => $stockOut,

            'stock_opname' => $stockOpname,

        ]

    ];

        
    }
}