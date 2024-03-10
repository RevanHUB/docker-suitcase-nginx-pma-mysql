<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class UsuarioComercio extends Model
{
    use HasFactory, HasRoles;
     /* clase para crear usuarios de tipo comercio */
     protected $table = 'users';
}
