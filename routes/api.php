<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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


Route::group(["middleware" => "auth:sanctum"],function(){
    Route::post("/logout",[UserController::class,"LogOut"]);
    Route::delete("/delete/{id}",[ProductController::class,"DeleteProduct"]);
    Route::post("/adding-product",[ProductController::class,"AddingProducts"]);
});

Route::post("/register",[UserController::class,"Register"]);
Route::post("/login",[UserController::class,"Login"]);
Route::post("/session",[UserController::class,"session"]);
