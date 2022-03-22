<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable =
    [
    'recibo',
    'fecha_compra',
    'proveedor',
    'valor_total',
    'estado'
    ];

    use HasFactory;
}
