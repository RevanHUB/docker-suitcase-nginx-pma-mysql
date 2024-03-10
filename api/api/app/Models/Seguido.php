<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguido extends Model
{
    use HasFactory;
    protected $table = 'seguidos';

    protected $fillable = [
        'id_seguidor', 'id_seguido'
    ];
}
