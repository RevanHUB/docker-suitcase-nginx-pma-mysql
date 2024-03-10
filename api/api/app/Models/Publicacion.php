<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';

    protected $fillable = [
        'titulo', 'descripcion', 'imagen', 'fecha_publicacion', 'fecha_inicio', 'fecha_fin', 'activo', 'id_tipo'
    ];
}
