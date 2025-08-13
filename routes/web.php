<?php

use App\Http\Controllers\AnalisisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LotoLeidsaController;
use App\Http\Controllers\LoteriaController;
use App\Http\Controllers\ConfiguracionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Configuración (solo para admins)
//Route::middleware(['auth', 'admin'])->group(function () {
// Otras rutas de configuración...
//});

Route::prefix('configuracion')->name('configuracion.')->group(function() {
    Route::get('/', [ConfiguracionController::class, 'index'])->name('index');
    Route::post('/', [ConfiguracionController::class, 'update'])->name('update');
});

// Vista individual de resultados por lotería
Route::prefix('loteria')->name('loteria.')->group(function() {
    Route::get('/{id}', [LotoLeidsaController::class, 'show'])->name('show');
    Route::post('/', [LoteriaController::class, 'store'])->name('store');
    Route::get('/editar/{id}', [LoteriaController::class, 'edit'])->name('edit');
    Route::delete('/{loteria}', [LoteriaController::class, 'destroy'])->name('destroy');
    Route::put('/{id}', [LoteriaController::class, 'update'])->name('update');
});

Route::prefix('loto')->name('loto.')->group(function() {
    Route::get("/agregar/{id}", [LotoLeidsaController::class,"create"])->name("agregar");
    Route::post("/store/{id}", [LotoLeidsaController::class,"store"])->name("store");
    Route::get("/editar/{id}", [LotoLeidsaController::class,"edit"])->name("editar");
    Route::put("/update/{id}", [LotoLeidsaController::class,"update"])->name("update");
    Route::delete("/delete/{id}", [LotoLeidsaController::class,"destroy"]) -> name("delete");
});

Route::prefix('loterias/analize')->name('analize.')->group(function() {
    Route::get('/{id}', [AnalisisController::class,'index'])->name('index');
});
