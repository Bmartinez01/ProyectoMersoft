<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedidos_detalles extends Model
{
    protected $fillable =
    [
    'pedido',
    'cliente',
    'cantidad',
    'producto',
    'valor_unitario',
    'valor_total',
    'estado'
    ];
    use HasFactory;
}
