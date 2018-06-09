<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'nombre', 'telefono', 'email', 'direccion', 'inicio', 'nacimiento',
    ];
}