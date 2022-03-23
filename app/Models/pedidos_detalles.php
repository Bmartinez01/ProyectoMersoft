<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedidos_detalles extends Model
{
    protected $fillable =
    [
    'pedido',
    'cantidad',
    'producto'
    ];
    use HasFactory;
}
