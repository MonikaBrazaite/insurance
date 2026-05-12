<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\CarController;

Route::apiResource('owners', OwnerController::class);
Route::apiResource('cars', CarController::class);
