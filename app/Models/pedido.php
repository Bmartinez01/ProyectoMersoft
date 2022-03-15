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
    'valor_total',
    'tipo',
    'estado'
    ];
    use HasFactory;
}
