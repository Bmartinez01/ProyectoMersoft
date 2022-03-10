<?php

namespace App\Http\Controllers;

use App\Models\pedido;
use App\Models\Cliente;
use App\Models\Producto;
use app\Models\pedidos_detalles;
use Illuminate\Http\Request;
use DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = pedido::all();
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('pedidos.index', compact('pedidos','clientes','productos'));
    }
    // public function create()
    // {

    //     $pedidos = new pedido;
    //     $clientes = Cliente::all();
    //     $productos = Producto::all();
    //     return view('pedidos.create', compact('pedidos','clientes','productos'));

    // }
    public function store(Request $request)
    {

        
  return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');
}

}



