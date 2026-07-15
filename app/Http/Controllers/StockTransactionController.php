<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockTransactionRequest;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Services\StockTransaction\StockTransactionService;

class StockTransactionController extends Controller
{
    protected StockTransactionService $stockTransactionService;

    public function __construct(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function index()
    {
        $transactions = StockTransaction::with('product')
            ->latest()
            ->get();

        return view('pages.stock_transaction.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();

        return view(
            'pages.stock_transaction.create',
            compact('products')
        );
    }

    public function store(StockTransactionRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        $stockBefore = $product->stock;

        if ($request->type == 'IN') {
            $stockAfter = $stockBefore + $request->quantity;
        } else {

            if ($request->quantity > $stockBefore) {
                return back()
                    ->withErrors([
                        'quantity' => 'Stock tidak mencukupi.'
                    ])
                    ->withInput();
            }

            $stockAfter = $stockBefore - $request->quantity;
        }

        $product->update([
            'stock' => $stockAfter
        ]);

        $this->stockTransactionService->createTransaction([
            'product_id' => $product->id,
            'user_id' => 1,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'stock_before' => $stockBefore,
            'stock_after' => $stockAfter,
            'transaction_date' => $request->transaction_date,
            'status' => 'Completed',
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('stock_transactions.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    public function show(StockTransaction $stockTransaction)
    {
        //
    }

    public function edit(StockTransaction $stockTransaction)
    {
        //
    }

    public function update(StockTransactionRequest $request, StockTransaction $stockTransaction)
    {
        //
    }

    public function destroy(StockTransaction $stockTransaction)
    {
        //
    }
}