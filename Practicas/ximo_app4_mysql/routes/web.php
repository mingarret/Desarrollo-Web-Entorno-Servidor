<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\TestController;

Route::get('/test-db', [TestController::class, 'testConnection']);
Route::get('/', [NoticiaController::class, 'index']);
Route::get('/search/{term}', [NoticiaController::class, 'search']);
Route::get('/view/{id}', [NoticiaController::class, 'view']);
