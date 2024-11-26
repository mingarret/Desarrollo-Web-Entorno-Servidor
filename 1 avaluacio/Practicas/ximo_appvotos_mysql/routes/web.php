<?php

use App\Http\Controllers\ProfileController;
use App\Http\Requests\StoreNoticiaRequest;
use App\Http\Requests\StoreVotoRequest;
use App\Models\Noticia;
use App\Models\Voto;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    $noticias = Noticia::with('user')->withCount('votos')->get();
    return view('welcome')->with('noticias', $noticias);
});


Route::get('/enviar', function () {
    return view('enviar');
});

Route::post('/store', function(StoreNoticiaRequest $storeNoticiaRequest){

    $noticia = new Noticia;

    $noticia->fill($storeNoticiaRequest -> validated());
    $noticia->user_id = Auth::id();

    $noticia -> save();

    return redirect('/');
});

Route::get('/noticia/{noticia}', function (Noticia $noticia) {
    $noticia->load('comentarios'); // Carga los comentarios de la noticia
    return view('show', compact('noticia'));
});


Route::post('/votar', function (StoreVotoRequest $storeVotoRequest) {
    $storeVotoRequest->validated();
    
    $voto = new Voto;
    $voto->noticia_id = $storeVotoRequest->noticia_id;
    $voto->user_id = Auth::id(); // Usa Auth::id() en lugar de Auth::user()->id
    $voto->save();

    return redirect('/');
})->middleware('auth');



// breeze
Route::get('/dashboard', function () {

    return view('dashboard')->with('noticias', Auth::user()->noticias);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


use App\Http\Controllers\ComentarioController;

Route::post('/noticia/{noticia}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::post('/comentarios/{comentario}/reply', [ComentarioController::class, 'reply'])->name('comentarios.reply');



require __DIR__.'/auth.php';