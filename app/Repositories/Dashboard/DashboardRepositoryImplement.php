<?php

namespace App\Repositories\Dashboard;

use LaravelEasyRepository\Implementations\Eloquent;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockTransaction;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardRepositoryImplement extends Eloquent implements DashboardRepository
{

    public function getDashboardData()
    {

        $user = Auth::user();

        $role = $user->role;


        /*
        |--------------------------------------------------------------------------
        | Data Umum
        |--------------------------------------------------------------------------
        */

        $data = [

            /*
            |--------------------------------------------------------------------------
            | Header
            |--------------------------------------------------------------------------
            */

            'currentUser' => $user,

            'today' => now(),




            /*
            |--------------------------------------------------------------------------
            | Statistic
            |--------------------------------------------------------------------------
            */

            'totalProducts' => Product::count(),

            'totalTransactions' => StockTransaction::count(),




            /*
            |--------------------------------------------------------------------------
            | Product
            |--------------------------------------------------------------------------
            */

            'lowStocks' => Product::with('category')
                ->orderBy('stock')
                ->where('stock', '<=', 5)
                ->take(5)
                ->get(),


            'latestProducts' => Product::with('category')
                ->latest()
                ->take(5)
                ->get(),




            /*
            |--------------------------------------------------------------------------
            | Recent Transaction
            |--------------------------------------------------------------------------
            */

            'recentTransactions' => StockTransaction::with([

                    'product',

                    'user'

                ])
                ->latest()
                ->take(5)
                ->get(),




            /*
            |--------------------------------------------------------------------------
            | Stock Movement Chart
            |--------------------------------------------------------------------------
            */

            'transactionChart' => StockTransaction::select(

                    DB::raw('DATE(transaction_date) as date'),

                    DB::raw("
                        SUM(
                            CASE
                                WHEN type='IN'
                                THEN quantity
                                ELSE 0
                            END
                        ) as total_in
                    "),

                    DB::raw("
                        SUM(
                            CASE
                                WHEN type='OUT'
                                THEN quantity
                                ELSE 0
                            END
                        ) as total_out
                    ")

                )

                ->whereDate(
                    'transaction_date',
                    '>=',
                    now()->subDays(6)
                )

                ->groupBy(
                    DB::raw('DATE(transaction_date)')
                )

                ->orderBy('date')

                ->get(),




            /*
            |--------------------------------------------------------------------------
            | Today Activity
            |--------------------------------------------------------------------------
            */

            'todayTransactions' => StockTransaction::whereDate(
                    'transaction_date',
                    today()
                )
                ->count(),


            'todayStockIn' => StockTransaction::where(
                    'type',
                    'IN'
                )
                ->whereDate(
                    'transaction_date',
                    today()
                )
                ->sum('quantity'),


            'todayStockOut' => StockTransaction::where(
                    'type',
                    'OUT'
                )
                ->whereDate(
                    'transaction_date',
                    today()
                )
                ->sum('quantity'),

        ];



        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($role == 'admin') {

            $data += [

                'totalCategories' => Category::count(),

                'totalSuppliers' => Supplier::count(),

                'totalUsers' => DB::table('users')->count(),

            ];

        }
        
        /*
        |--------------------------------------------------------------------------
        | MANAGER
        |--------------------------------------------------------------------------
        */

        if ($role == 'manager') {

            $data += [

                'pendingTransactions' => StockTransaction::where(
                        'status',
                        'Pending'
                    )
                    ->count(),

                'completedTransactions' => StockTransaction::where(
                        'status',
                        'Completed'
                    )
                    ->count(),

                'approvedToday' => StockTransaction::where(
                        'status',
                        'Completed'
                    )
                    ->whereDate(
                        'transaction_date',
                        today()
                    )
                    ->count(),

                'totalStockIn' => StockTransaction::where(
                        'type',
                        'IN'
                    )
                    ->sum('quantity'),

                'totalStockOut' => StockTransaction::where(
                        'type',
                        'OUT'
                    )
                    ->sum('quantity'),

            ];

        }



        /*
        |--------------------------------------------------------------------------
        | STAFF
        |--------------------------------------------------------------------------
        */

        if ($role == 'staff') {

            $data += [

                'pendingTransactions' => StockTransaction::where(
                        'status',
                        'Pending'
                    )
                    ->count(),

                'rejectedTransactions' => StockTransaction::where(
                        'status',
                        'Rejected'
                    )
                    ->count(),

                'completedTransactions' => StockTransaction::where(
                        'status',
                        'Completed'
                    )
                    ->count(),

                'todayInput' => StockTransaction::where(
                        'user_id',
                        $user->id
                    )
                    ->whereDate(
                        'transaction_date',
                        today()
                    )
                    ->count(),

            ];

        }



        /*
        |--------------------------------------------------------------------------
        | Return
        |--------------------------------------------------------------------------
        */

        return $data;

    }

}