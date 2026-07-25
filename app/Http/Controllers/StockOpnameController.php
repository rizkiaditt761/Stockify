<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockOpname;
use App\Services\Activity\ActivityService;
use App\Services\StockOpname\StockOpnameService;

class StockOpnameController extends Controller
{
    protected $stockOpnameService;
    protected $activityService;


    public function __construct(
        StockOpnameService $stockOpnameService,
        ActivityService $activityService
    ) {

        $this->stockOpnameService = $stockOpnameService;
        $this->activityService = $activityService;

    }



    /**
     * Display Stock Opname
     */
    public function index(Request $request)
    {

        $products = $this->stockOpnameService->getProducts();



        /*
        |--------------------------------------------------------------------------
        | Riwayat Stock Opname
        |--------------------------------------------------------------------------
        */

        $query = StockOpname::with('product');



        // Filter tanggal awal

        if ($request->start_date) {

            $query->whereDate(
                'created_at',
                '>=',
                $request->start_date
            );

        }



        // Filter tanggal akhir

        if ($request->end_date) {

            $query->whereDate(
                'created_at',
                '<=',
                $request->end_date
            );

        }



        $opnames = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();





        /*
        |--------------------------------------------------------------------------
        | Summary Stock Opname
        |--------------------------------------------------------------------------
        */

        $summaryQuery = StockOpname::query();



        // Apply filter tanggal untuk summary

        if ($request->start_date) {

            $summaryQuery->whereDate(
                'created_at',
                '>=',
                $request->start_date
            );

        }



        if ($request->end_date) {

            $summaryQuery->whereDate(
                'created_at',
                '<=',
                $request->end_date
            );

        }





        // Total opname

        $totalOpname = (clone $summaryQuery)
            ->count();




        // Jumlah stok bertambah

        $totalIncrease = (clone $summaryQuery)
            ->where(
                'difference',
                '>',
                0
            )
            ->count();





        // Jumlah stok berkurang

        $totalDecrease = (clone $summaryQuery)
            ->where(
                'difference',
                '<',
                0
            )
            ->count();





        // Total selisih

        $totalDifference = (clone $summaryQuery)
            ->sum('difference');






        return view(
            'pages.stock_opname.index',
            compact(
                'products',
                'opnames',
                'totalOpname',
                'totalIncrease',
                'totalDecrease',
                'totalDifference'
            )
        );

    }





    /**
     * Store Stock Opname
     */
    public function store(Request $request)
    {

        $request->validate([

            'product_id'     => 'required',

            'physical_stock' => 'required|integer|min:0',

            'note'           => 'nullable',

        ]);




        $opname = $this->stockOpnameService->store(
            $request->all()
        );






        $this->activityService->log(

            'Stock Opname',

            'CREATE',

            'Melakukan Stock Opname pada produk ' .
            $opname->product->name .
            ' (Stock Sistem: ' .
            $opname->system_stock .
            ', Stock Fisik: ' .
            $opname->physical_stock .
            ')',

            $opname

        );







        return redirect()
            ->back()
            ->with(
                'success',
                'Stock opname berhasil disimpan.'
            );

    }

}