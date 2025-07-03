<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/', [AccountController::class, 'index'])->name('account.index');
    Route::get('/create', [AccountController::class, 'create'])->name('account.create');
    Route::post('/', [AccountController::class, 'store'])->name('account.store');