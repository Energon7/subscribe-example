<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscribeController;
use Illuminate\Support\Facades\Route;


Route::post('/create_post',[PostController::class, 'store']);
Route::post('/subscribe', [SubscribeController::class, 'subscribe']);
