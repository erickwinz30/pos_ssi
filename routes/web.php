<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PosSessionController;
use App\Http\Controllers\PointOfSalesController;
use App\Http\Controllers\Reports\PeriodeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UsersController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('pos-session', PosSessionController::class);

    Route::post('/point-of-sales/store', [PointOfSalesController::class, 'store']);
    Route::post('/point-of-sales/end-session', [PointOfSalesController::class, 'endSession']);
    Route::resource('/point-of-sales', PointOfSalesController::class)->except('store');

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('periode-pdf', [PeriodeController::class, 'downloadPdf'])->name('reports.period.pdf');
        Route::resource('periode', PeriodeController::class)->only(['index']);
    });
});

require __DIR__.'/auth.php';
