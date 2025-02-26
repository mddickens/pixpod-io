<?php

use App\Http\Controllers\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/orders/{id?}', [OrdersController::class, 'get']);
Route::post('/orders', [OrdersController::class, 'post']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
