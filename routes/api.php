<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PurchaseController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(\Tymon\JWTAuth\Http\Middleware\Authenticate::class)->group(function () {
    
    
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'get');
        Route::post('/categories', 'store');
        Route::get('/categories/{id}', 'details');
        Route::patch('/categories/{id}', 'update');
        Route::delete('/categories/{id}', 'destroy');
    });

   
    Route::controller(EventController::class)->group(function () {
        Route::get('/events', 'get');
        Route::post('/events', 'store');
        Route::get('/events/{id}', 'details');
        Route::patch('/events/{id}', 'update');
        Route::delete('/events/{id}', 'destroy');
    });

   
    Route::post('/purchases', [PurchaseController::class, 'store']);
    Route::get('/purchases/{id}', [PurchaseController::class, 'details']);

});