<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LotoLeidsaController;
use App\Http\Controllers\LoteriaController;
use App\Http\Controllers\ConfiguracionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Configuración (solo para admins)
//Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
// Otras rutas de configuración...
//});

Route::post('/configuracion', [ConfiguracionController::class, 'update'])->name('configuracion.update');


// Vista individual de resultados por lotería
Route::get('/loteria/{id}', [LoteriaController::class, 'show'])->name('loterias.show');
Route::post('/loteria', [LoteriaController::class, 'store'])->name('loterias.store');
Route::get('/loteria/editar/{id}', [LoteriaController::class, 'edit'])->name('loterias.edit');
//Route::post('/loteria/update', [LoteriaController::class, 'update'])->name('loterias.update');
Route::delete('/loteria/{loteria}', [LoteriaController::class, 'destroy'])->name('loterias.destroy');
Route::put('/loterias/{id}', [LoteriaController::class, 'update'])->name('loterias.update');


Route::prefix('loto')->name('loto.')->group(function() {
    Route::get("/", [LotoLeidsaController::class,"index"]) -> name("index");
    Route::get("/agregar", [LotoLeidsaController::class,"create"])->name("agregar");
    Route::post("/store", [LotoLeidsaController::class,"store"])->name("store");
    Route::get("/editar/{lotteryResult}", [LotoLeidsaController::class,"edit"])->name("editar");
    Route::put("/update/{lotteryResult}", [LotoLeidsaController::class,"update"])->name("update");
    Route::delete("/delete/{lotteryResult}", [LotoLeidsaController::class,"destroy"]) -> name("delete");
});
