<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

// Ruta para listar los comentarios
Route::get('/comments', [CommentController::class, 'index']);

// Ruta para mostrar el formulario de creación de un nuevo comentario
Route::get('/comments/create', [CommentController::class, 'create']);

// Ruta para almacenar un nuevo comentario
Route::post('/comments', [CommentController::class, 'store']);

// Ruta para mostrar un comentario específico
Route::get('/comments/{commentid}', [CommentController::class, 'show']);

// Ruta para mostrar el formulario de edición de un comentario existente
Route::get('/comments/{commentid}/edit', [CommentController::class, 'edit']);

// Ruta para actualizar un comentario existente
Route::patch('/comments/{commentid}', [CommentController::class, 'update']);

// Ruta para eliminar un comentario
Route::delete('/comments/{commentid}', [CommentController::class, 'destroy']);


/*
//Actualizaremos las rutas despues de que en el cointrolador actualicemos los metodos para utilizar Eloquent

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

// Ruta para listar los comentarios
Route::get('/comments', [CommentController::class, 'index']);

// Ruta para mostrar el formulario de creación
Route::get('/comments/create', [CommentController::class, 'create'])->middleware('auth');

// Ruta para guardar un nuevo comentario
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');

// Ruta para mostrar un comentario específico
Route::get('/comments/{id}', [CommentController::class, 'show']);

// Ruta para mostrar el formulario de edición
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->middleware('auth');

// Ruta para actualizar un comentario existente
Route::patch('/comments/{id}', [CommentController::class, 'update'])->middleware('auth');

// Ruta para eliminar un comentario
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->middleware('auth');
*/
