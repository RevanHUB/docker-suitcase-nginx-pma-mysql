<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
    use HasFactory;
    protected $fillable = [
        'apellidos', 'sexo', 'edad', 'fecha_nacimiento', 'id_usuario'
    ];
    protected $table = 'particulares';
}
