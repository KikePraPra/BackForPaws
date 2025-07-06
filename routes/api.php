<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\controllers\AccountController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdoptionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/v1/account/all', [AccountController::class, 'all']);

Route::get('/v1/report/all', [ReportController::class, 'all']);

Route::get('/v1/adoption/all', [AdoptionController::class, 'all']);