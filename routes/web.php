<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\OpticalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
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
Route::middleware(['auth'])->group(function() {
    Route::resource('people', PeopleController::class);

    Route::get('/people/search', [PeopleController::class, 'search'])->name('people.search');
});
    Route::prefix('/admin')->middleware('can:access_admin')->group(function () {
        Route::prefix('/users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::get('/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });
    // ----- Admin routes end
});
// ----- Logged routes end

require __DIR__ . '/auth.php';
