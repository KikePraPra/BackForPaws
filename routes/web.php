<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas para cuentas
Route::get('/accounts', [AccountController::class, 'index'])->name('account.index');
Route::get('/accounts/create', [AccountController::class, 'create'])->name('account.create');
Route::post('/accounts', [AccountController::class, 'store'])->name('account.store');
Route::get('/accounts/{account}', [AccountController::class, 'show'])->name('account.show');
Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('account.edit');
Route::put('/accounts/{account}', [AccountController::class, 'update'])->name('account.update');
Route::delete('/accounts/{account}', [AccountController::class, 'destroy'])->name('account.destroy');

// Rutas para reportes
Route::get('/reports', [ReportController::class, 'index'])->name('report.index');
Route::get('/reports/create', [ReportController::class, 'create'])->name('report.create');
Route::post('/reports', [ReportController::class, 'store'])->name('report.store');
Route::get('/reports/{report}', [ReportController::class, 'show'])->name('report.show');
Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('report.edit');
Route::put('/reports/{report}', [ReportController::class, 'update'])->name('report.update');

Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('report.destroy');


Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('report.destroy');

