<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Log;  // Make sure to include Log facade

Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);

// Add your test log route
Route::get('/test-log', function () {
    Log::error('This is a test log error'); // This will create an error log
    return 'Error log created!';
});