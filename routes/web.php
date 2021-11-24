<?php

use App\Models\Supplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;

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
    route::post('storeSupplier', [SupplierController::class, 'store'])->name('storeSupplier');
    route::post('editSupplier', [SupplierController::class, 'edit'])->name('editSupplier');
    route::post('updateSupplier', [SupplierController::class, 'update'])->name('updateSupplier');
    route::post('deleteSupplier', [SupplierController::class, 'delete'])->name('deleteSupplier');
    route::get('supplier', [SupplierController::class, 'index'])->name('getSupplier');

    route::get('obat', [ObatController::class, 'index'])->name('getObat');
    route::post('storeObat', [ObatController::class, 'store'])->name('storeObat');
    route::post('editObat', [ObatController::class, 'edit'])->name('editObat');
    route::post('updateObat', [ObatController::class, 'update'])->name('updateObat');
    route::post('deleteObat', [ObatController::class, 'delete'])->name('deleteObat');
});

require __DIR__ . '/auth.php';
