<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::get('/ofertas', [ProductController::class, 'ofertas']);
Route::get('/seleccion', [ProductController::class, 'seleccion']);
Route::get('/top-ventas', [ProductController::class, 'topVentas']);
Route::get('/producto/{productoid}', [ProductController::class, 'verProducto']);

