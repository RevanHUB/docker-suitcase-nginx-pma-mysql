<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtiquetaPublicacion extends Model
{
    use HasFactory;
    protected $table = 'etiquetas_publicaciones';
    protected $fillable = [
        'id_publicacion',
        'id_etiqueta'
    ];
}
