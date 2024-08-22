<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('product')->controller(ProductController::class)->group(function () {
    Route::get('/', 'list');
    Route::get('/{product}', 'show');
    Route::post('/', 'store');
    Route::put('/{product}', 'update');
    Route::delete('/{product}', 'destroy');
});
