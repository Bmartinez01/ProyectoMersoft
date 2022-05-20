<?php

namespace App\Http\Controllers;
use App\Models\pedido;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Estados;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Pedido_detalleController extends Controller
{
    public function create()
    {

        $pedidos = new pedido;
        $clientes = Cliente::all();
        $estados= Estados::all();
        $productos = Producto::all();
        return view('pedidos_detalles.create', compact('pedidos','clientes','productos','estados'));

    }
    





    
}
