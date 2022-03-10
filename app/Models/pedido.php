<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{
    protected $fillable =
    [
    'cliente',
    'cantidad',
    'producto',
    'valor_unitario',
    'valor_total',
    'estado'
    ];
    use HasFactory;
}
