<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\BreweriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login'])->name('api.login');

route::get('/breweries', [BreweriesController::class, 'index'])->name('api.breweries.all')->middleware('auth:sanctum');