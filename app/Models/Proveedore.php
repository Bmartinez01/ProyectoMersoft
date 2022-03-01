<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Proveedore extends Model
{
      
    protected $fillable = 
    [
    'nit_empresa',
    'nombre',
    'apellido',
    'empresa',
    'categoria_id',
    'direccion',
    'telefono',
    'email',
    'estado'
    ];

    use HasFactory;

}
