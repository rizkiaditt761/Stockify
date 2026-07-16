<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryAttributeController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\StockMonitoringController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman awal
Route::get('/', function () {
    return redirect()->route('login');
});

// Semua user harus login
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile (Laravel Breeze)
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');



    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {

        Route::resource('categories', CategoryController::class);

        Route::prefix('categories/{category}')
            ->name('category.attributes.')
            ->group(function () {

                Route::get(
                    'attributes',
                    [CategoryAttributeController::class, 'index']
                )->name('index');

                Route::post(
                    'attributes',
                    [CategoryAttributeController::class, 'store']
                )->name('store');
            });

        Route::resource('suppliers', SupplierController::class);

        Route::resource('products', ProductController::class);
        Route::resource('users', UserController::class)
            ->middleware('role:admin');
    });



    /*
    |--------------------------------------------------------------------------
    | ADMIN + STAFF
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,staff')->group(function () {

        Route::resource(
            'stock_transactions',
            StockTransactionController::class
        );

    });



    /*
    |--------------------------------------------------------------------------
    | ADMIN + MANAGER
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,manager')->group(function () {

        Route::get(
            '/stock-monitoring',
            [StockMonitoringController::class, 'index']
        )->name('stock.monitoring.index');

        Route::resource(
            'stock-opname',
            StockOpnameController::class
        )->names('stock.opname');

        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');

    });

});

require __DIR__.'/auth.php';