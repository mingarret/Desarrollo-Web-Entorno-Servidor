<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticiaRequest;
use App\Http\Requests\UpdateNoticiaRequest;
use App\Models\Noticia;

class NoticiaController extends Controller
{
    public function index()
{
    $noticias = Noticia::paginate(15);
    return view('noticias.index', compact('noticias'));
}

public function search($term)
{
    $noticias = Noticia::where('titulo', 'like', '%' . $term . '%')
                        ->orWhere('resumen', 'like', '%' . $term . '%')
                        ->orWhere('cuerpo', 'like', '%' . $term . '%')
                        ->paginate(15);

    return view('noticias.index', compact('noticias'));
}


public function view($id)
{
    $noticia = Noticia::findOrFail($id);
    return view('noticias.view', compact('noticia'));
}
}