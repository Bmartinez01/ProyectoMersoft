<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra_Detalle extends Model
{
    protected $fillable =
    [
    'compras_id',
    'cantidad',
    'producto',
    'estado'
    ];


    use HasFactory;
}
