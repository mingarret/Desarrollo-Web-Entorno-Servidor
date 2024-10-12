<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;

class TestController extends Controller
{
    public function testConnection()
    {
        try {
            DB::connection()->getPdo();
            return 'Conexión exitosa a la base de datos.';
        } catch (Exception $e) {
            return 'No se pudo conectar: ' . $e->getMessage();
        }
    }
}
