<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comentario extends Model
{
    // Campos rellenables
    protected $fillable = ['cuerpo', 'user_id', 'noticia_id', 'parent_id'];

    /**
     * Relación con el usuario que hizo el comentario.
     */
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con la noticia asociada.
     */
    public function noticia(): BelongsTo
    {
        return $this->belongsTo(Noticia::class);
    }

    /**
     * Obtener el comentario padre si es una respuesta.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comentario::class, 'parent_id');
    }

    /**
     * Obtener las respuestas de este comentario.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comentario::class, 'parent_id');
    }
}
