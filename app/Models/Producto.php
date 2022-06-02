<?php

namespace App\Models;
use App\Http\Requests\ProductoCreateRequest;
use App\Http\Requests\ProductoEditRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable =
    [

    'Nombre',
    'Categorías',
    'Stock',
    'unidad',
    'Precio',
    'estado'
    ];

    use HasFactory;
}
