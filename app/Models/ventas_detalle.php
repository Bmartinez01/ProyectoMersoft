<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ventas_detalle extends Model
{
    protected $fillable =
    [
    'venta_id',
    'cantidad',
    'producto',
    'valor_total',
    'producto_dev',
    'producto_reg',
    'valor_dev',
    'valor_defi'


    ];
    use HasFactory;
}
