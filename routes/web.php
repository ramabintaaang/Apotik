<?php

use App\Models\Supplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockObatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['role:owner']], function () {
    route::get('supplier', [SupplierController::class, 'index'])->name('getSupplier');
    // route::post('storeSupplier', [SupplierController::class, 'store'])->name('storeSupplier');
    // route::post('editSupplier', [SupplierController::class, 'edit'])->name('editSupplier');
    // route::post('updateSupplier', [SupplierController::class, 'update'])->name('updateSupplier');
    // route::post('deleteSupplier', [SupplierController::class, 'delete'])->name('deleteSupplier');
    // route::get('supplier', [SupplierController::class, 'index'])->name('getSupplier');

    ///API Supplier
    Route::get('api/supplier', [SupplierController::class, 'fetchSupplier'])->name('fetchSupplier');
    Route::get('api/supplier/{id}', [SupplierController::class, 'detailSupplier'])->name('detailSupplier');
    Route::post('api/addSupplier', [SupplierController::class, 'addSupplier'])->name('addSupplier');
    Route::post('api/updateSupplier/{id}', [SupplierController::class, 'updateSupplier'])->name('updateSupplier');
    Route::delete('api/deleteSupplier/{id}', [SupplierController::class, 'deleteSupplier'])->name('deleteSupplier');;

    route::get('obat', [ObatController::class, 'index'])->name('getObat');
    route::post('storeObat', [ObatController::class, 'store'])->name('storeObat');
    route::post('editObat', [ObatController::class, 'edit'])->name('editObat');
    route::post('updateObat', [ObatController::class, 'update'])->name('updateObat');
    route::post('deleteObat', [ObatController::class, 'delete'])->name('deleteObat');


    route::get('getNamaObat', [StockObatController::class, 'getNamaObat'])->name('getNamaObat');
    route::get('stockObat', [StockObatController::class, 'index'])->name('getStockObat');
    // route::post('storeStokeObat', [StockObatController::class, 'store'])->name('storeStokeObat');
    // route::post('editStokeObat', [StockObatController::class, 'edit'])->name('editStokeObat');
    // route::post('updateStokeObat', [StockObatController::class, 'update'])->name('updateStokeObat');
    // route::post('deleteStokeObat', [StockObatController::class, 'delete'])->name('deleteStokeObat');
});

require __DIR__ . '/auth.php';
