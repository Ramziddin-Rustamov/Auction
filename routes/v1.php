<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\BiddingHistoryController;
use App\Http\Controllers\API\v1\CurrentBidController;
use App\Http\Controllers\API\v1\ProductController;

    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });
    
    Route::resource('bidding-history',BiddingHistoryController::class);
    Route::resource('product',ProductController::class);
    Route::resource('currentBid',CurrentBidController::class);

