<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', [CategoryController::class, 'list'])
        ->name('list');
Route::get('/create', [CategoryController::class, 'create'])
        ->name('create');
Route::post('/', [CategoryController::class, 'store'])
        ->name('store');
Route::get('/{category}/edit', [CategoryController::class, 'edit'])
        ->name('edit');
Route::patch('/{category}', [CategoryController::class, 'update'])
        ->name('update');
Route::delete('/{category}', [CategoryController::class, 'destroy'])
        ->name('destroy');
