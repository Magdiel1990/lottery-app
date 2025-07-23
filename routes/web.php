<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotteryResultController;

Route::get("/", [LotteryResultController::class,"index"]) -> name("loto.index");

Route::get("/loto/agregar", [LotteryResultController::class,"create"])->name("loto.agregar");

Route::post("/loto/store", [LotteryResultController::class,"store"])->name("loto.store");

Route::get("/loto/editar/{lotteryResult}", [LotteryResultController::class,"edit"])->name("loto.editar");

Route::post("/loto/update", [LotteryResultController::class,"update"])->name("loto.update");
