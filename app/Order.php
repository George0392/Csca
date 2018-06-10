<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id_empleado','id_cliente','monto','deHoy',
    ];
}
