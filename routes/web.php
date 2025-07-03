<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/', [AccountController::class, 'index'])->name('account.index');
    Route::get('/create', [AccountController::class, 'create'])->name('account.create');
    Route::post('/', [AccountController::class, 'store'])->name('account.store');
    Route::get('/{account}', [AccountController::class, 'show'])->name('account.show');
    Route::get('/{account}/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/{account}', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/{account}', [AccountController::class, 'destroy'])->name('account.destroy');