<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group(function () {
Route::get('/user', [\App\Http\Controllers\HomeController::class,"user"]);
Route::get('/menu', [\App\Http\Controllers\HomeController::class,"menu"]);
Route::get('/prices/{id}', [\App\Http\Controllers\HomeController::class,"prices"]);
Route::put('/menu/{id}', [\App\Http\Controllers\HomeController::class,"updateMenu"]);
Route::post('/categories', [\App\Http\Controllers\CategoryController::class,"store"]);
Route::get('/categories', [\App\Http\Controllers\CategoryController::class,"myCategories"]);
Route::get('/availableParentCategories', [\App\Http\Controllers\CategoryController::class,"availableParentCategories"]);
Route::get('/availableItemCategories', [\App\Http\Controllers\CategoryController::class,"availableItemCategories"]);
Route::post('/items', [\App\Http\Controllers\ItemController::class,"store"]);
Route::delete('/items/{id}', [\App\Http\Controllers\ItemController::class,"delete"]);
Route::delete('/categories/{id}', [\App\Http\Controllers\CategoryController::class,"delete"]);
});
