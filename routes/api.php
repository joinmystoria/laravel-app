<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\CustomerController;

Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);
