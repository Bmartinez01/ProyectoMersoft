<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompraCreateRequest;
use App\Models\Compra;
use App\Models\Compra_Detalle;
use App\Models\Proveedore;
use App\Models\Producto;
class Compra_DetalleController extends Controller
{
    //
    public function create()
    {
        $compras_detalle = new Compra_Detalle;
        $compras = Compra::all();
        $proveedores = Proveedore::all();
        $productos = Producto::all();
        return view('compras_detalle.create', compact('compras','compras_detalle','proveedores','productos'));

    }

    public function index()
    {
        $compras = Compra::all();
        $proveedores = Proveedore::all();
        $productos = Producto::all();
        return view('compras_detalle.index', compact('compras','proveedores','productos'));

    }


}
