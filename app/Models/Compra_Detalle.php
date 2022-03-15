<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra_Detalle extends Model
{
    protected $fillable =
    [
    'cantidad',
    'producto',
    'valor_unitario',
    'valor_total',
    'estado'
    ];


    use HasFactory;
}
