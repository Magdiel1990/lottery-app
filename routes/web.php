<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoteriaController;
use App\Http\Controllers\LotoLeidsaController;

Route::get("/", [LoteriaController::class,"index"]) -> name("index");

Route::get("/loto", [LotoLeidsaController::class,"index"]) -> name("loto.index");

Route::get("/loto/agregar", [LotoLeidsaController::class,"create"])->name("loto.agregar");

Route::post("/loto/store", [LotoLeidsaController::class,"store"])->name("loto.store");

Route::get("/loto/editar/{lotteryResult}", [LotoLeidsaController::class,"edit"])->name("loto.editar");

Route::put("/loto/update/{lotteryResult}", [LotoLeidsaController::class,"update"])->name("loto.update");

Route::delete("/loto/delete/{lotteryResult}", [LotoLeidsaController::class,"destroy"]) -> name("loto.delete");
