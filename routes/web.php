<?php

use Illuminate\Support\Facades\Route;

use App\Models\Category;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryAttributeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\StockMonitoringController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;




Route::middleware('role:admin,manager,staff')->group(function () {


    Route::get(
        '/activities',
        [ActivityController::class,'index']
    )->name('activities.index');


});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    /*
|--------------------------------------------------------------------------
| Activity Log
|--------------------------------------------------------------------------
*/

Route::get(
    '/activities',
    [ActivityController::class,'index']
)
->name('activities.index');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {

        // Category
        Route::resource(
            'categories',
            CategoryController::class
        );

        // Category Attribute
        Route::prefix('categories/{category}')
            ->name('category.attributes.')
            ->group(function () {

                Route::get(
                    '/attributes',
                    [CategoryAttributeController::class, 'index']
                )->name('index');

                Route::post(
                    '/attributes',
                    [CategoryAttributeController::class, 'store']
                )->name('store');

            });

        Route::get(
            '/category-attributes/{category}',
            function (Category $category) {

                return response()->json(
                    $category->categoryAttributes
                );

            }
        )->name('category.attributes.json');

        // Supplier CRUD
        Route::resource(
            'suppliers',
            SupplierController::class
        )->except(['index', 'show']);

            /*
        |--------------------------------------------------------------------------
        | Product Status
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Product Delete (Temporary)
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/products/{product}',
            [ProductController::class, 'destroy']
        )->name('products.destroy');

        // User CRUD
        Route::resource(
            'users',
            UserController::class
        );
    });

    Route::middleware('role:admin,manager')->group(function () {

    Route::patch(
        '/products/{product}/activate',
        [ProductController::class, 'activate']
    )->name('products.activate');

    Route::patch(
        '/products/{product}/deactivate',
        [ProductController::class, 'deactivate']
    )->name('products.deactivate');

    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN + MANAGER + STAFF
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,manager,staff')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Product (Create, Read, Update)
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/products',
            [ProductController::class, 'index']
        )->name('products.index');

        Route::get(
            '/products/create',
            [ProductController::class, 'create']
        )->name('products.create');

        Route::post(
            '/products',
            [ProductController::class, 'store']
        )->name('products.store');

        Route::get(
            '/products/{product}',
            [ProductController::class, 'show']
        )->name('products.show');

        Route::get(
            '/products/{product}/edit',
            [ProductController::class, 'edit']
        )->name('products.edit');

        Route::put(
            '/products/{product}',
            [ProductController::class, 'update']
        )->name('products.update');

        /*
        |--------------------------------------------------------------------------
        | Stock Transaction (Read)
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/stock_transactions',
            [StockTransactionController::class, 'index']
        )->name('stock_transactions.index');

        /*
        |--------------------------------------------------------------------------
        | Stock Monitoring (Read)
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/stock_monitoring',
            [StockMonitoringController::class, 'index']
        )->name('stock.monitoring.index');

        /*
        |--------------------------------------------------------------------------
        | Stock Opname (Read)
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/stock_opname',
            [StockOpnameController::class, 'index']
        )->name('stock.opname.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN + MANAGER + STAFF
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,manager,staff')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Supplier (Read)
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/suppliers',
            [SupplierController::class, 'index']
        )->name('suppliers.index');
    });

        /*
    |--------------------------------------------------------------------------
    | ADMIN + MANAGER
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,manager')->group(function () {

        Route::get(
            '/reports',
            [ReportController::class, 'index']
        )->name('reports.index');

        Route::get(
            '/reports/export/pdf',
            [ReportController::class, 'exportPdf']
        )->name('reports.export.pdf');

    });

    /*
    |--------------------------------------------------------------------------
    | MANAGER ONLY
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:manager')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Stock Transaction
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/stock_transactions/create',
            [StockTransactionController::class, 'create']
        )->name('stock_transactions.create');

        Route::post(
            '/stock_transactions',
            [StockTransactionController::class, 'store']
        )->name('stock_transactions.store');

        Route::patch(
            '/stock_transactions/{transaction}/cancel',
            [StockTransactionController::class, 'cancel']
        )->name('stock_transactions.cancel');

        /*
        |--------------------------------------------------------------------------
        | Stock Opname CRUD
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/stock_opname',
            [StockOpnameController::class, 'store']
        )->name('stock.opname.store');

        Route::get(
            '/stock_opname/{stock_opname}/edit',
            [StockOpnameController::class, 'edit']
        )->name('stock.opname.edit');

        Route::put(
            '/stock_opname/{stock_opname}',
            [StockOpnameController::class, 'update']
        )->name('stock.opname.update');

        Route::delete(
            '/stock_opname/{stock_opname}',
            [StockOpnameController::class, 'destroy']
        )->name('stock.opname.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | STAFF ONLY
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:staff')->group(function () {

        Route::put(
            '/stock_transactions/{transaction}/confirm',
            [StockTransactionController::class, 'confirm']
        )->name('stock_transactions.confirm');

        Route::put(
            '/stock_transactions/{transaction}/reject',
            [StockTransactionController::class, 'reject']
        )->name('stock_transactions.reject');
    });

});

require __DIR__.'/auth.php';