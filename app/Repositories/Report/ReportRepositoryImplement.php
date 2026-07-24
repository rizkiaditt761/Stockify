<?php

namespace App\Repositories\Report;

use LaravelEasyRepository\Implementations\Eloquent;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\User;
use App\Models\Activity;
use App\Models\Supplier;

class ReportRepositoryImplement extends Eloquent implements ReportRepository
{
    public function getReportData(array $filters)
    {
        /*
        |--------------------------------------------------------------------------
        | Filter
        |--------------------------------------------------------------------------
        */

        $report = $filters['report'] ?? 'stock';

        $type = $filters['type'] ?? 'all';

        $categoryId = $filters['category_id'] ?? null;

        $startDate = $filters['start_date'] ?? null;

        $endDate = $filters['end_date'] ?? null;

        $search = $filters['search'] ?? null;


        /*
        |--------------------------------------------------------------------------
        | Product Stock Report
        |--------------------------------------------------------------------------
        */

        $products = collect();


        if ($report == 'stock' || $report == 'all') {


            $productQuery = Product::with([
                'category',
                'supplier',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Filter Category
            |--------------------------------------------------------------------------
            */

            if ($categoryId) {

                $productQuery->where(
                    'category_id',
                    $categoryId
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Search Product
            |--------------------------------------------------------------------------
            */

            if ($search) {

                $productQuery->where(function ($query) use ($search) {

                    $query->where(
                        'name',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'sku',
                        'like',
                        "%{$search}%"
                    );

                });

            }


            $products = $productQuery
                ->orderBy('name')
                ->get();

        }



        /*
        |--------------------------------------------------------------------------
        | Transaction Report
        |--------------------------------------------------------------------------
        */

        $transactions = collect();


        if ($report == 'transaction' || $report == 'all') {


            $transactionQuery = StockTransaction::with([
                'product.category',
                'user',
                'confirmedBy',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Filter Category
            |--------------------------------------------------------------------------
            */

            if ($categoryId) {

                $transactionQuery->whereHas(
                    'product',
                    function ($query) use ($categoryId) {

                        $query->where(
                            'category_id',
                            $categoryId
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Filter Type
            |--------------------------------------------------------------------------
            */

            if ($type != 'all') {

                $transactionQuery->where(
                    'type',
                    $type
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Filter Date
            |--------------------------------------------------------------------------
            */

            if ($startDate) {

                $transactionQuery->whereDate(
                    'transaction_date',
                    '>=',
                    $startDate
                );

            }


            if ($endDate) {

                $transactionQuery->whereDate(
                    'transaction_date',
                    '<=',
                    $endDate
                );

            }

                        /*
            |--------------------------------------------------------------------------
            | Search Transaction
            |--------------------------------------------------------------------------
            */

            if ($search) {

                $transactionQuery->where(function ($query) use ($search) {


                    $query->whereHas(
                        'product',
                        function ($product) use ($search) {

                            $product->where(
                                'name',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'sku',
                                'like',
                                "%{$search}%"
                            );

                        }
                    )


                    ->orWhereHas(
                        'user',
                        function ($user) use ($search) {

                            $user->where(
                                'name',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'role',
                                'like',
                                "%{$search}%"
                            );

                        }
                    )


                    ->orWhere(
                        'status',
                        'like',
                        "%{$search}%"
                    )


                    ->orWhere(
                        'type',
                        'like',
                        "%{$search}%"
                    );


                });

            }



            $transactions = $transactionQuery
                ->latest('transaction_date')
                ->get();

        }



        /*
        |--------------------------------------------------------------------------
        | User Activity Report
        |--------------------------------------------------------------------------
        */

        $activities = collect();



        if ($report == 'activity' || $report == 'all') {


            $activityQuery = Activity::with([
                'user',
            ]);



            /*
            |--------------------------------------------------------------------------
            | Filter Date
            |--------------------------------------------------------------------------
            */

            if ($startDate) {

                $activityQuery->whereDate(
                    'created_at',
                    '>=',
                    $startDate
                );

            }



            if ($endDate) {

                $activityQuery->whereDate(
                    'created_at',
                    '<=',
                    $endDate
                );

            }



            /*
            |--------------------------------------------------------------------------
            | Search Activity
            |--------------------------------------------------------------------------
            */

            if ($search) {


                $activityQuery->where(function ($query) use ($search) {


                    $query->where(
                        'module',
                        'like',
                        "%{$search}%"
                    )


                    ->orWhere(
                        'action',
                        'like',
                        "%{$search}%"
                    )


                    ->orWhere(
                        'description',
                        'like',
                        "%{$search}%"
                    )


                    ->orWhereHas(
                        'user',
                        function ($user) use ($search) {


                            $user->where(
                                'name',
                                'like',
                                "%{$search}%"
                            )


                            ->orWhere(
                                'role',
                                'like',
                                "%{$search}%"
                            );


                        }
                    );


                });


            }



            $activities = $activityQuery
                ->latest()
                ->get();


        }

                /*
|--------------------------------------------------------------------------
| Dynamic Summary
|--------------------------------------------------------------------------
*/

$summary = [];


/*
|--------------------------------------------------------------------------
| Stock Report Summary
|--------------------------------------------------------------------------
*/

if ($report == 'stock') {


    $summary = [

        'total_products' => $products->count(),

        'total_stock' => $products->sum('stock'),

    ];


}



/*
|--------------------------------------------------------------------------
| Transaction Report Summary
|--------------------------------------------------------------------------
*/

if ($report == 'transaction') {


    $summary = [

        'total_transaction' => $transactions->count(),

        'stock_in' => $transactions
            ->where('type', 'IN')
            ->count(),

        'stock_out' => $transactions
            ->where('type', 'OUT')
            ->count(),

    ];


}



/*
|--------------------------------------------------------------------------
| Activity Report Summary
|--------------------------------------------------------------------------
*/

if ($report == 'activity') {


    $summary = [

        'total_activity' => $activities->count(),

        'total_user' => $activities
            ->pluck('user_id')
            ->unique()
            ->count(),

    ];


}



/*
|--------------------------------------------------------------------------
| All Report Summary
|--------------------------------------------------------------------------
*/

if ($report == 'all') {


    $summary = [

        'total_products' => $products->count(),

        'total_stock' => $products->sum('stock'),

        'total_transaction' => $transactions->count(),

        'total_activity' => $activities->count(),

    ];


}



        /*
        |--------------------------------------------------------------------------
        | Return
        |--------------------------------------------------------------------------
        */

        return [

            'report' => $report,

            'products' => $products,

            'transactions' => $transactions,

            'activities' => $activities,

            'categories' => Category::orderBy('name')->get(),

            'summary' => $summary,

        ];

    }
}