<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockTransactionRequest;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Services\StockTransaction\StockTransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockTransactionController extends Controller
{
    protected StockTransactionService $stockTransactionService;

    public function __construct(
        StockTransactionService $stockTransactionService
    ) {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Base Query
        |--------------------------------------------------------------------------
        */

        $query = StockTransaction::with([
            'product',
            'user'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->whereHas('product', function ($product) use ($search) {

                    $product->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );

                })

                ->orWhereHas('user', function ($user) use ($search) {

                    $user->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );

                })

                ->orWhere(
                    'notes',
                    'like',
                    "%{$search}%"
                );

            });

        }

        /*
        |--------------------------------------------------------------------------
        | Filter Tanggal
        |--------------------------------------------------------------------------
        */

        if ($request->filled('start_date')) {

            $query->whereDate(
                'transaction_date',
                '>=',
                $request->start_date
            );

        }

        if ($request->filled('end_date')) {

            $query->whereDate(
                'transaction_date',
                '<=',
                $request->end_date
            );

        }

                /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $summaryQuery = clone $query;

        $totalTransaction = (clone $summaryQuery)->count();

        $totalIn = (clone $summaryQuery)
            ->where('type', 'IN')
            ->count();

        $totalOut = (clone $summaryQuery)
            ->where('type', 'OUT')
            ->count();

        $totalInQty = (clone $summaryQuery)
            ->where('type', 'IN')
            ->sum('quantity');

        $totalOutQty = (clone $summaryQuery)
            ->where('type', 'OUT')
            ->sum('quantity');

        /*
        |--------------------------------------------------------------------------
        | Filter Card
        |--------------------------------------------------------------------------
        */

        if ($request->filled('type')) {

            $query->where(
                'type',
                $request->type
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Data Table
        |--------------------------------------------------------------------------
        */

        $transactions = $query
            ->latest('transaction_date')
            ->get();

        return view(
            'pages.stock_transaction.index',
            [
                'transactions'     => $transactions,
                'totalTransaction' => $totalTransaction,
                'totalIn'          => $totalIn,
                'totalOut'         => $totalOut,
                'totalInQty'       => $totalInQty,
                'totalOutQty'      => $totalOutQty,
                'activeType'       => $request->type,
                'search'           => $request->search,
                'startDate'        => $request->start_date,
                'endDate'          => $request->end_date,
            ]
        );
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view(
            'pages.stock_transaction.create',
            compact('products')
        );
    }

    public function store(StockTransactionRequest $request)
    {
        $product = Product::findOrFail(
            $request->product_id
        );

        $stockBefore = $product->stock;

        if ($request->type == 'IN') {

            $stockAfter =
                $stockBefore + $request->quantity;

        } else {

            if ($request->quantity > $stockBefore) {

                return back()
                    ->withErrors([
                        'quantity' => 'Stock tidak mencukupi.'
                    ])
                    ->withInput();

            }

            $stockAfter =
                $stockBefore - $request->quantity;
        }

        $product->update([
            'stock' => $stockAfter
        ]);

        $this->stockTransactionService
            ->createTransaction([

                'product_id'       => $product->id,
                'user_id'          => Auth::id(),
                'type'             => $request->type,
                'quantity'         => $request->quantity,
                'stock_before'     => $stockBefore,
                'stock_after'      => $stockAfter,
                'transaction_date' => now(),
                'status'           => 'Completed',
                'notes'            => $request->notes,

            ]);

        return redirect()
            ->route('stock_transactions.index')
            ->with(
                'success',
                'Transaksi berhasil disimpan.'
            );
    }

    public function show(StockTransaction $stockTransaction)
    {
        //
    }

    public function edit(StockTransaction $stockTransaction)
    {
        //
    }

    public function update(
        StockTransactionRequest $request,
        StockTransaction $stockTransaction
    ) {
        //
    }

    public function destroy(StockTransaction $stockTransaction)
    {
        //
    }
}