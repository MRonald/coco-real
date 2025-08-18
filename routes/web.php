<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\OpticalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if (auth()->user()) {
        return redirect()->route('users.index');
    }

    return redirect()->route('login');
});

// ----- Logged routes
Route::middleware('auth')->group(function () {
    // ----- Admin routes
    Route::prefix('/admin')->middleware('can:access_admin')->group(function () {
        Route::prefix('/users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::get('/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
        });

        Route::prefix('/products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/', [ProductController::class, 'store'])->name('products.store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::get('/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
        });

        Route::prefix('/sales')->group(function () {
            Route::get('/', [SaleController::class, 'index'])->name('sales.index');
            Route::get('/create', [SaleController::class, 'create'])->name('sales.create');
            Route::post('/', [SaleController::class, 'store'])->name('sales.store');
            Route::get('/{id}/edit', [SaleController::class, 'edit'])->name('sales.edit');
            Route::get('/{id}/delete', [SaleController::class, 'destroy'])->name('sales.destroy');
        });
    });
    // ----- Admin routes end
});
// ----- Logged routes end

require __DIR__ . '/auth.php';
