<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NameController;
use Illuminate\Support\Facades\Log;

Route::get('/names', [NameController::class, 'index']); // Get All Names
Route::post('/add', [NameController::class, 'store']); // Add Name
Route::put('/update/{id}', [NameController::class, 'update']);  // Update Name
Route::delete('/delete/{id}', [NameController::class, 'destroy']);  // Delete Name

// For prod test logging purposes only
Route::get('/test-log', function () {
    Log::error('This is a test log error'); 
    return 'Error log created!';
});
