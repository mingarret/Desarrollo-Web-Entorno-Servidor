<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelisController;

Route::get('pelis', [PelisController::class, 'index'])->name('pelis.index');
Route::post('pelis/store', [PelisController::class, 'store'])->name('pelis.store');
Route::put('pelis/update/{id}', [PelisController::class, 'update'])->name('pelis.update');
Route::delete('pelis/destroy/{id}', [PelisController::class, 'destroy'])->name('pelis.destroy');
// Mostrar los detalles de una película específica
Route::get('pelis/{id}', [PelisController::class, 'show'])->name('pelis.show');

