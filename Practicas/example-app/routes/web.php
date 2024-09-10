<?php

use Illuminate\Support\Facades\Route; // Importa la clase Route de Laravel para definir rutas de la aplicación.

// Ruta GET para la URL raíz ('/')
Route::get('/', function () {
    // Retorna un mensaje simple 'welcome' cuando se accede a la raíz del sitio.
    return 'welcome';
});

// Ruta GET para '/Merda'
Route::get('/Merda', function () {
    // Retorna un mensaje personalizado 'welcome Cabro' cuando se accede a '/Merda'.
    return 'welcome Cabro';
});

// Ruta GET para '/hola'
Route::get('/hola', function () {
    $output = ''; // Inicializa una variable $output como una cadena vacía.
    
    // Bucle for que se ejecuta 1000 veces.
    for ($i = 0; $i < 1000; $i++) {
        // En cada iteración, agrega la palabra 'Hola ' a la variable $output.
        $output .= 'Hola ';
    }
    
    // Retorna la cadena $output que contiene 'Hola ' repetido 1000 veces.
    return $output;
});

// Ruta GET para '/adios'
Route::get('/adios', function () {
    // Define un script JavaScript como cadena, que contiene un bucle para escribir 'Adios ' 10,000 veces.
    $script = "<script>
        for (let i = 0; i < 10000; i++) {
            document.write('Adios ');
        }
    </script>";

    // Escapa el script usando htmlspecialchars para mostrarlo como texto sin ejecutarlo en el navegador.
    return htmlspecialchars($script);
});


// GET: Leer datos
Route::get('/productos', function () {
    // Define una ruta GET para '/productos'.
    // Esta ruta se utiliza para obtener una lista de productos.
    // Responde con la cadena 'Lista de productos'.
    return 'Lista de productos';
});

// POST: Crear nuevos datos
Route::post('/productos', function () {
    // Define una ruta POST para '/productos'.
    // Esta ruta se utiliza para crear un nuevo producto.
    // Responde con la cadena 'Producto creado'.
    return 'Producto creado';
});

// PUT: Reemplazar datos existentes
Route::put('/productos/{id}', function ($id) {
    // Define una ruta PUT para '/productos/{id}'.
    // Esta ruta se utiliza para actualizar completamente un producto existente especificado por su ID.
    // El {id} es un parámetro dinámico que representa el ID del producto.
    // Responde con la cadena "Producto {id} actualizado completamente", reemplazando {id} con el valor real del parámetro.
    return "Producto {$id} actualizado completamente";
});

// PATCH: Actualizar parcialmente datos existentes
Route::patch('/productos/{id}', function ($id) {
    // Define una ruta PATCH para '/productos/{id}'.
    // Esta ruta se utiliza para actualizar parcialmente un producto existente especificado por su ID.
    // Similar al método PUT, pero solo actualiza algunos campos en lugar de reemplazar todo el recurso.
    // Responde con la cadena "Producto {id} actualizado parcialmente".
    return "Producto {$id} actualizado parcialmente";
});

// DELETE: Eliminar datos
Route::delete('/productos/{id}', function ($id) {
    // Define una ruta DELETE para '/productos/{id}'.
    // Esta ruta se utiliza para eliminar un producto existente especificado por su ID.
    // Responde con la cadena "Producto {id} eliminado".
    return "Producto {$id} eliminado";
});

// OPTIONS: Consultar opciones disponibles
Route::options('/productos', function () {
    // Define una ruta OPTIONS para '/productos'.
    // Este método se utiliza para solicitar al servidor qué métodos HTTP están disponibles para el recurso '/productos'.
    // Responde con un JSON que indica los métodos disponibles: GET, POST, PUT, PATCH y DELETE.
    return response()->json(['GET', 'POST', 'PUT', 'PATCH', 'DELETE']);
});
