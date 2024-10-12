<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CommentController extends Controller
{
    public $comentarios;

    // Constructor para inicializar comentarios desde la sesión
    public function __construct()
    {
        // Carga los comentarios de la sesión o establece un array vacío si no existen
        $this->comentarios = session('comentarios', ["1 comentario", "2 comentario"]);
    }

    // Muestra los comentarios desde la sesión
    public function index()
    {
    $html = "<h1>Comentarios</h1><ul>";
    foreach ($this->comentarios as $index => $comentario) {
        $html .= "<li><a href='/comments/{$index}'>{$comentario}</a></li>";
    }
    $html .= "</ul>";

    return $html;
    }

    // Formulario para crear comentarios
    function create()
    {
    return "
        <form method='POST' action='/comments'>
            <input type='hidden' name='_token' value='" . csrf_token() . "'>
            <input type='text' name='comment'>
            <input type='submit' value='Enviar'>
        </form>";
    }

    // Almacena el comentario en la sesión
    public function store(Request $request)
        {
        // Agregar el comentario
        array_push($this->comentarios, $request->input('comment'));

        // Guardar los comentarios en la sesión
        session(['comentarios' => $this->comentarios]);

        // Redirigir al método index para mostrar los comentarios en HTML
        return redirect()->action([CommentController::class, 'index']);
        }

    // Buscar por id  
    function show(string $commentid)
        {  
            return $this->comentarios[$commentid];     
        }


    //Editar un comentario
    public function edit(int $commentid)
    {
        // Verifica si el índice del comentario existe
        if (!isset($this->comentarios[$commentid])) {
            return "Comentario no encontrado.";
        }

        // Devuelve el formulario HTML para editar el comentario
        return "
            <form method='POST' action='/comments/{$commentid}'>
                <input type='hidden' name='_method' value='PATCH'>
                <input type='hidden' name='_token' value='" . csrf_token() . "'>
                <input type='text' name='comment' value='{$this->comentarios[$commentid]}'>
                <input type='submit' value='Actualizar'>
            </form>
        ";
    }

    //Para que muestre la actualizacion
    public function update(Request $request, int $commentid)
    {
        // Verifica si el índice del comentario existe
        if (!isset($this->comentarios[$commentid])) {
            return "Comentario no encontrado.";
        }

        // Actualizar el comentario en el array temporal
        $this->comentarios[$commentid] = $request->input('comment');

        // Guardar los comentarios en la sesión
        session(['comentarios' => $this->comentarios]);

        // Redirigir al método index para mostrar los comentarios en HTML
        return redirect()->action([CommentController::class, 'index']);
    }

    //Para que elimine un comentario
    public function destroy(int $commentid)
        {
        // Eliminar el comentario en la posición dada
        unset($this->comentarios[$commentid]);

        // Re-indexar el array para mantener los índices consecutivos
        $this->comentarios = array_values($this->comentarios);

        // Actualizar los comentarios en la sesión
        session(['comentarios' => $this->comentarios]);

        // Devolver el array actualizado de comentarios
        return redirect()->action([CommentController::class, 'index']);
        }

}