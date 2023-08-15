<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/testtoken", [AuthController::class, "tokenTest"]);
});

//Route::get("/testtoken", [AuthController::class, "tokenTest"])->middleware(['auth:sanctum']);


