<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    protected $fillable =
    [
    'pedido_id',
    'cliente',
    'valor_inicial',
    'valor_dev',
    'valor_total'
    ];
    use HasFactory;
}