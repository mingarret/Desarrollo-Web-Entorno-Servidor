<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelis extends Model
{
    use HasFactory;

    // Solo permite la asignación masiva de estos campos
    protected $fillable = ['name', 'año'];
}
