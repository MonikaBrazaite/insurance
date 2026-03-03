<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;

Route::get('/', function () {
    return redirect()->route('owners.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');
Route::get('/owners/create', [OwnerController::class, 'create'])->name('owners.create');
Route::post('/owners', [OwnerController::class, 'store'])->name('owners.store');
Route::get('/owners/{owner}/edit', [OwnerController::class, 'edit'])->name('owners.edit');
Route::put('/owners/{owner}', [OwnerController::class, 'update'])->name('owners.update');
Route::delete('/owners/{owner}', [OwnerController::class, 'destroy'])->name('owners.destroy');
