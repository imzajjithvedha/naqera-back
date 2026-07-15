<?php

use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/properties', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('categories', [CategoryController::class, 'categories']);

Route::get('properties', [PropertyController::class, 'properties']);