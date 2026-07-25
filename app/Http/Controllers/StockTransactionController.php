<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockTransactionRequest;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Services\StockTransaction\StockTransactionService;
use App\Services\Activity\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockTransactionController extends Controller
{
    protected StockTransactionService $stockTransactionService;
    protected ActivityService $activityService;

    public function __construct(
        StockTransactionService $stockTransactionService,
        ActivityService $activityService
    ) {
        $this->stockTransactionService = $stockTransactionService;

        $this->activityService = $activityService;
    }

    public function index(Request $request)
{
    $query = StockTransaction::with([
        'product',
        'user',
        'confirmedBy'
    ]);



    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    if($request->search){

        $search = $request->search;

        $query->where(function($q) use ($search){

            $q->whereHas('product', function($product) use ($search){

                $product->where('name','like','%'.$search.'%');

            });


            $q->orWhereHas('user', function($user) use ($search){

                $user->where('name','like','%'.$search.'%');

            });


            $q->orWhere(
                'notes',
                'like',
                '%'.$search.'%'
            );

        });

    }




    /*
    |--------------------------------------------------------------------------
    | STATUS FILTER
    |--------------------------------------------------------------------------
    */

    if($request->status){

        $query->where(
            'status',
            $request->status
        );

    }





    /*
    |--------------------------------------------------------------------------
    | TYPE FILTER
    |--------------------------------------------------------------------------
    */

    if($request->type){

        $query->where(
            'type',
            $request->type
        );

    }





    /*
    |--------------------------------------------------------------------------
    | DATE FILTER
    |--------------------------------------------------------------------------
    */

    if($request->start_date){

        $query->whereDate(
            'transaction_date',
            '>=',
            $request->start_date
        );

    }



    if($request->end_date){

        $query->whereDate(
            'transaction_date',
            '<=',
            $request->end_date
        );

    }





    /*
    |--------------------------------------------------------------------------
    | SUMMARY CARD
    |--------------------------------------------------------------------------
    */


    $totalTransaction = (clone $query)
        ->count();



    $totalPending = (clone $query)
        ->where('status','Pending')
        ->count();



    $totalCompleted = (clone $query)
        ->where('status','Completed')
        ->count();



    $totalRejected = (clone $query)
        ->where('status','Rejected')
        ->count();



    $totalCancelled = (clone $query)
        ->where('status','Cancelled')
        ->count();






    /*
    |--------------------------------------------------------------------------
    | TABLE DATA
    |--------------------------------------------------------------------------
    */

    $transactions = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();





    return view(
        'pages.stock_transaction.index',
        compact(
            'transactions',
            'totalTransaction',
            'totalPending',
            'totalCompleted',
            'totalRejected',
            'totalCancelled'
        )
    );
}

    /*
|--------------------------------------------------------------------------
| Create
|--------------------------------------------------------------------------
*/

public function create()
{
    
    $products = Product::where('is_active', true)
        ->orderBy('name')
        ->get();

    return view(
        'pages.stock_transaction.create',
        compact('products')
    );
}

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(StockTransactionRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        if (!$product->is_active) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Produk sudah dinonaktifkan dan tidak dapat digunakan untuk transaksi.'
                );

        }

        if(
            $request->type == 'OUT'
            &&
            $request->quantity > $product->stock
            ){

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Stock tidak mencukupi. Stock tersedia: '.$product->stock
                );

            }

            $transaction = $this->stockTransactionService
            ->createTransaction([

                'product_id'       => $product->id,
                'user_id'          => Auth::id(),

                'type'             => $request->type,
                'quantity'         => $request->quantity,

                // Stock belum berubah
                'stock_before'     => $product->stock,
                'stock_after'      => $product->stock,

                'transaction_date' => now(),

                // Selalu Pending
                'status'           => 'Pending',

                'notes'            => $request->notes,

                // Belum dikonfirmasi
                'confirmed_by'     => null,
                'confirmed_at'     => null,

            ]);

            $this->activityService->log(

                'Stock Transaction',

                'CREATE',

                'Membuat transaksi Stock ' .
                $transaction->type .
                ' ' .
                $product->name .
                ' sebanyak ' .
                $transaction->quantity .
                ' unit',

                $transaction

            );

        return redirect()
            ->route('stock_transactions.index')
            ->with(
                'success',
                'Transaksi berhasil dibuat dan menunggu konfirmasi Staff.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Confirm
    |--------------------------------------------------------------------------
    */

    public function confirm(StockTransaction $transaction)
    {
        if ($transaction->status != 'Pending') {

            return back()->with(
                'error',
                'Transaksi ini sudah diproses.'
            );

        }

        $product = Product::findOrFail(
            $transaction->product_id
        );

        $stockBefore = $product->stock;

        if ($transaction->type == 'IN') {

            $stockAfter =
                $stockBefore + $transaction->quantity;

        } else {

            if ($transaction->quantity > $stockBefore) {

                return back()->with(
                    'error',
                    'Stock tidak mencukupi.'
                );

            }

            $stockAfter =
                $stockBefore - $transaction->quantity;
        }

        $product->update([
            'stock' => $stockAfter
        ]);

        $transaction->update([

            'stock_before' => $stockBefore,
            'stock_after'  => $stockAfter,

            'status'       => 'Completed',

            'confirmed_by' => Auth::id(),

            'confirmed_at' => now(),

        ]);

        $this->activityService->log(

            'Stock Transaction',

            'CONFIRM',

            'Mengkonfirmasi transaksi Stock ' .
            $transaction->type .
            ' ' .
            $product->name .
            ' sebanyak ' .
            $transaction->quantity .
            ' unit',

            $transaction

        );

        return redirect()
            ->route('stock_transactions.index')
            ->with(
                'success',
                'Transaksi berhasil dikonfirmasi.'
            );
    }

   /*
|--------------------------------------------------------------------------
| Reject
|--------------------------------------------------------------------------
*/

public function reject(
    Request $request,
    StockTransaction $transaction
)
{
    $request->validate([

        'rejection_reason' => [
            'required',
            'string',
            'max:500',
        ],

    ]);

    if ($transaction->status != 'Pending') {

        return back()->with(
            'error',
            'Transaksi ini sudah diproses.'
        );

    }

    $transaction->update([

        'status'             => 'Rejected',

        'rejection_reason'   => $request->rejection_reason,

        'confirmed_by'       => Auth::id(),

        'confirmed_at'       => now(),

    ]);

        $this->activityService->log(

        'Stock Transaction',

        'REJECT',

        'Menolak transaksi Stock ' .
        $transaction->type .
        ' ' .
        $transaction->product->name,

        $transaction

    );

    return redirect()
        ->route('stock_transactions.index')
        ->with(
            'success',
            'Transaksi berhasil ditolak.'
        );
}
    /*
    |--------------------------------------------------------------------------
    | Cancel
    |--------------------------------------------------------------------------
    */

    public function cancel(StockTransaction $transaction)
    {
        if ($transaction->status != 'Pending') {

            return back()->with(
                'error',
                'Hanya transaksi Pending yang dapat dibatalkan.'
            );

        }

        $transaction->update([

            'status' => 'Cancelled',

        ]);

        $this->activityService->log(

        'Stock Transaction',

        'CANCEL',

        'Membatalkan transaksi Stock ' .
        $transaction->type .
        ' ' .
        $transaction->product->name,

        $transaction

    );

        return redirect()
            ->route('stock_transactions.index')
            ->with(
                'success',
                'Transaksi berhasil dibatalkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

     public function show(StockTransaction $transaction)
    {
        $transaction->load([
            'product.category',
            'product.supplier',
            'user',
            'confirmedBy',
        ]);

        return view(
            'pages.stock_transaction.show',
            compact('transaction')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(StockTransaction $stockTransaction)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        StockTransactionRequest $request,
        StockTransaction $stockTransaction
    ) {
        //
    }

        /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */

    public function destroy(StockTransaction $stockTransaction)
    {
        //
    }
}