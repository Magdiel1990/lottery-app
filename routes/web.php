<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotteryResultController;

Route::get("/", [LotteryResultController::class,"index"]);

Route::get("/agregar", [LotteryResultController::class,"create"])->name("resultados.agregar");
