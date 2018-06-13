<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id_categoria',
        'codigo',
        'nombre',
        'cantidad',
        'cantidad_res',
        'costo',
        'monto',
    ];
}
