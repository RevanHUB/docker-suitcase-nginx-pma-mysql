<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayuntamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_token',
        'id_usuario'
    ];
}
