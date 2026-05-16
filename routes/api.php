<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\CarController;

Route::prefix('v1')->name('api.')->group(function () {
    Route::apiResource('owners', OwnerController::class);
    Route::apiResource('cars', CarController::class);
});
