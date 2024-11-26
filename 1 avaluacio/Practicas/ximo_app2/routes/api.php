<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Ruta para obtener todos los catálogos juntos
Route::get('/productos', [ProductController::class, 'apiIndex']);

// Ruta para obtener productos de Ofertas
Route::get('/productos/ofertas', [ProductController::class, 'apiOfertas']);

// Ruta para obtener productos de Selección
Route::get('/productos/seleccion', [ProductController::class, 'apiSeleccion']);

// Ruta para obtener productos de Top Ventas
Route::get('/productos/top-ventas', [ProductController::class, 'apiTopVentas']);

// Ruta para obtener un producto específico por su ID
Route::get('/productos/{productoid}', [ProductController::class, 'apiVerProducto']);
