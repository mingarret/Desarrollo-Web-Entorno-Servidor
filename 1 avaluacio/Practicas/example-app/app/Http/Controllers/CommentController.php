<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Método para listar todos los comentarios
    public function index()
    {
    // Recupera los comentarios de la sesión
    $comments = session('comments', []);
    // Retorna la vista con los comentarios
    return view('comments.index', ['comments' => $comments]);
    }

    // Método para mostrar el formulario de creación de un comentario
    public function create()
    {
        return view('comments.create'); // Suponiendo que existe una vista llamada 'create'
    }

    // Método para almacenar un nuevo comentario
    public function store(Request $request)
{
    // Obtiene el comentario del request y lo añade a la sesión
    $comment = $request->input('comment');
    $comments = session('comments', []);
    $comments[] = $comment;
    session(['comments' => $comments]);
    return redirect('/comments');
}


    // Método para mostrar un comentario específico
    public function show($commentid)
    {
        $comments = session('comments', []);
        if (!isset($comments[$commentid])) {
            return response()->json(['error' => 'Comentario no encontrado'], 404);
        }
        return response()->json($comments[$commentid]);
    }

    // Método para mostrar el formulario de edición de un comentario
    public function edit($commentid)
    {
        $comments = session('comments', []);
        if (!isset($comments[$commentid])) {
            return response()->json(['error' => 'Comentario no encontrado'], 404);
        }
        return view('comments.edit', ['comment' => $comments[$commentid], 'commentid' => $commentid]);
    }

    // Método para actualizar un comentario
    public function update(Request $request, $commentid)
    {
        $comments = session('comments', []);
        if (!isset($comments[$commentid])) {
            return response()->json(['error' => 'Comentario no encontrado'], 404);
        }
        $comments[$commentid] = $request->input('comment');
        session(['comments' => $comments]);
        return response()->json($comments);
    }

    // Método para eliminar un comentario
    public function destroy($commentid)
    {
        $comments = session('comments', []);
        if (!isset($comments[$commentid])) {
            return response()->json(['error' => 'Comentario no encontrado'], 404);
        }
        unset($comments[$commentid]);
        session(['comments' => $comments]);
        return response()->json($comments);
    }
}


/*

// Actualizar el controlador para utiliza eloquent, actualizar los métodos del controlador para interactuar con la base de datos en lugar de la sesión.
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Listar todos los comentarios
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', ['comments' => $comments]);
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('comments.create');
    }

    // Guardar un nuevo comentario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'comment' => $validated['comment'],
        ]);

        return redirect('/comments')->with('success', 'Comment added successfully!');
    }

    // Mostrar un comentario específico
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.show', ['comment' => $comment]);
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', ['comment' => $comment]);
    }

    // Actualizar un comentario existente
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update([
            'comment' => $validated['comment'],
        ]);

        return redirect('/comments')->with('success', 'Comment updated successfully!');
    }

    // Eliminar un comentario
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect('/comments')->with('success', 'Comment deleted successfully!');
    }
}
*/