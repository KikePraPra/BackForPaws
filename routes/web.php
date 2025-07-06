<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdoptionController;

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
// Rutas para adopciones
Route::get('/adoptions', [AdoptionController::class, 'index'])->name('adoption.index');
Route::get('/adoptions/create', [AdoptionController::class, 'create'])->name('adoption.create');
Route::post('/adoptions', [AdoptionController::class, 'store'])->name('adoption.store');
Route::get('/adoptions/{adoption}', [AdoptionController::class, 'show'])->name('adoption.show');
Route::get('/adoptions/{adoption}/edit', [AdoptionController::class, 'edit'])->name('adoption.edit');
Route::put('/adoptions/{adoption}', [AdoptionController::class, 'update'])->name('adoption.update');
Route::delete('/adoptions/{adoption}', [AdoptionController::class, 'destroy'])->name('adoption.destroy');