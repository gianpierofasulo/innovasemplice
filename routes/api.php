<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BreweriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);

route::get('/breweries', [BreweriesController::class, 'index'])->middleware('auth:sanctum');


//route::get('/breweries', [BreweriesController::class, 'index']);
