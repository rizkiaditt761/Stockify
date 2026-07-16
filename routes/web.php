<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryAttributeController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\StockMonitoringController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockOpnameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


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

Route::resource('stock_transactions', StockTransactionController::class);

Route::get('/stock-monitoring', 
    [StockMonitoringController::class, 'index']
)->name('stock.monitoring.index');

Route::name('index-practice')->get('/', function () {
    return view('pages.practice.index');
});

Route::get('/stock-opname', [StockOpnameController::class, 'index'])
    ->name('stock.opname.index');
Route::post('/stock-opname', [StockOpnameController::class, 'store'])
    ->name('stock.opname.store');

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::name('practice.')->group(function () {
    Route::name('first')->get('practice/1', function () {
        return view('pages.practice.1');
    });
    Route::name('second')->get('practice/2', function () {
        return view('pages.practice.2');
    });
});
