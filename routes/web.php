<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoteriaController;
use App\Http\Controllers\LotoLeidsaController;

Route::get("/", [LoteriaController::class,"index"]) -> name("index");

Route::prefix('loto')->name('loto.')->group(function() {
    Route::get("/", [LotoLeidsaController::class,"index"]) -> name("index");
    Route::get("/agregar", [LotoLeidsaController::class,"create"])->name("agregar");
    Route::post("/store", [LotoLeidsaController::class,"store"])->name("store");
    Route::get("/editar/{lotteryResult}", [LotoLeidsaController::class,"edit"])->name("editar");
    Route::put("/update/{lotteryResult}", [LotoLeidsaController::class,"update"])->name("update");
    Route::delete("/delete/{lotteryResult}", [LotoLeidsaController::class,"destroy"]) -> name("delete");
});
