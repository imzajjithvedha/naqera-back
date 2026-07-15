<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User routes
        Route::controller(UserController::class)->prefix('users')->name('users.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{user}', 'edit')->name('edit');
            Route::patch('{user}', 'update')->name('update');
            Route::delete('{user}', 'destroy')->name('destroy');
        });
    // User routes

    // Category routes
        Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{category}', 'edit')->name('edit');
            Route::patch('{category}', 'update')->name('update');
            Route::delete('{category}', 'destroy')->name('destroy');
        });
    // Category routes

    // Property routes
        Route::controller(PropertyController::class)->prefix('properties')->name('properties.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{property}', 'edit')->name('edit');
            Route::patch('{property}', 'update')->name('update');
            Route::delete('{property}', 'destroy')->name('destroy');
        });
    // Property routes
});
