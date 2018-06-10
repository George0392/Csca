<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'id_order',
        'id_producto',
        'cantidad',
        'completada',
    ];
}
