<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Log;

Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);

// For prod test logging purposes only
Route::get('/test-log', function () {
    Log::error('This is a test log error'); 
    return 'Error log created!';
});