<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Models\Supplier;

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
    // route::get('api/supplier', [SupplierController::class, 'index'])->name('apiSupplier');
});

require __DIR__ . '/auth.php';
