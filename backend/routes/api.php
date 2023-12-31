<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/testtoken", [AuthController::class, "tokenTest"]);
});


Route::post('/event/create', [\App\Http\Controllers\EventController::class, 'store']);
Route::get('/event/events', [\App\Http\Controllers\EventController::class, 'index']);
Route::get('/event/{id}', [\App\Http\Controllers\EventController::class, 'show']);
Route::put('/event/update/{id}', [\App\Http\Controllers\EventController::class, 'update']);
Route::delete('/event/destroy', [\App\Http\Controllers\EventController::class, 'destroy']);

Route::post('/checkout', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name("checkout");
Route::get('/success', [\App\Http\Controllers\PaymentController::class, 'success'])->name("checkout.success");
Route::get('/cancel', [\App\Http\Controllers\PaymentController::class, 'cancel'])->name("checkout.cancel");

//Route::get("/testtoken", [AuthController::class, "tokenTest"])->middleware(['auth:sanctum']);


