<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\BillInController;
use App\Http\Controllers\BillOutController;
use App\Http\Controllers\OpticalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
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

            Route::get('/collaborators', [UserController::class, 'collaborators'])->name('users.collaborators');
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

        Route::prefix('/bills-in')->group(function () {
            Route::get('/', [BillInController::class, 'index'])->name('bills-in.index');
            Route::get('/create', [BillInController::class, 'create'])->name('bills-in.create');
            Route::post('/', [BillInController::class, 'store'])->name('bills-in.store');
            Route::get('/{id}/edit', [BillInController::class, 'edit'])->name('bills-in.edit');
            Route::get('/{id}/delete', [BillInController::class, 'destroy'])->name('bills-in.destroy');
        });

        Route::prefix('/bills-out')->group(function () {
            Route::get('/', [BillOutController::class, 'index'])->name('bills-out.index');
            Route::get('/create', [BillOutController::class, 'create'])->name('bills-out.create');
            Route::post('/', [BillOutController::class, 'store'])->name('bills-out.store');
            Route::get('/{id}/edit', [BillOutController::class, 'edit'])->name('bills-out.edit');
            Route::get('/{id}/delete', [BillOutController::class, 'destroy'])->name('bills-out.destroy');
        });

        Route::prefix('/roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::get('/{id}/delete', [RoleController::class, 'destroy'])->name('roles.destroy');
        });
    });
    // ----- Admin routes end
});
// ----- Logged routes end

require __DIR__ . '/auth.php';
