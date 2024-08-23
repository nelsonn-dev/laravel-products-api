<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'list')->middleware('can:product_view');
    Route::get('/search', 'search')->middleware('can:product_view');
    Route::get('/by-category/{category_id}', 'getByCategory')->middleware('can:product_view');
    Route::get('/{id}', 'show')->middleware('can:product_view');
    Route::post('/', 'store')->middleware('can:product_create');
    Route::put('/{id}', 'update')->middleware('can:product_update');
    Route::delete('/{id}', 'destroy')->middleware('can:product_delete');
});

Route::middleware('auth:sanctum')->prefix('categories')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'list')->middleware('can:category_view');
    Route::get('/{id}', 'show')->middleware('can:category_view');
    Route::post('/', 'store')->middleware('can:category_create');
    Route::put('/{id}', 'update')->middleware('can:category_update');
    Route::delete('/{id}', 'destroy')->middleware('can:category_delete');
});
