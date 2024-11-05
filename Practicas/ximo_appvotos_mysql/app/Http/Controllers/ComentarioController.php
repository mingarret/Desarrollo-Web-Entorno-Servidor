<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ComentarioController extends Controller
{
    /**
     * Store a newly created comment in the specified Noticia.
     */
    public function store(Request $request, Noticia $noticia)
    {
        $request->validate([
            'cuerpo' => 'required|string|max:1000',
        ]);

        $comentario = new Comentario();
        $comentario->cuerpo = $request->cuerpo;
        $comentario->user_id = Auth::id();

        $noticia->comentarios()->save($comentario);

        return redirect()->back()->with('success', 'Comentario agregado con éxito.');
    }

    /**
     * Store a reply to a specific comment.
     */
    public function reply(Request $request, Comentario $comentario)
{
    // Validación del cuerpo del comentario de respuesta
    $request->validate([
        'cuerpo' => 'required|string|max:1000',
    ]);

    // Creación de la respuesta como un nuevo comentario
    $reply = new Comentario();
    $reply->cuerpo = $request->cuerpo;
    $reply->user_id = Auth::id(); // Asigna el ID del usuario autenticado a la respuesta
    $reply->parent_id = $comentario->id; // Enlace como respuesta al comentario original
    $reply->noticia_id = $comentario->noticia_id; // Asegura que la respuesta esté vinculada a la misma noticia

    // Guarda la respuesta como un comentario anidado
    $comentario->replies()->save($reply);

    // Redirige con un mensaje de éxito
    return redirect()->back()->with('success', 'Respuesta agregada con éxito.');
}

}
