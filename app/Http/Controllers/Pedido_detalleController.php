<?php

namespace App\Http\Controllers;
use App\Models\pedido;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Estados;
use PDF;
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
    public function pdf(Request $request, $id){
        $a = pedido::findOrFail($id);
        $pedido = pedido::all();
        $clientes = Cliente::all();
        $estado= Estados::all();
        $productos = [];
        if($id != null){
            $productos = Producto::select("productos.*", "pedidos_detalles.cantidad as cantidad_c")
            ->join("pedidos_detalles", "productos.id", "=", "pedidos_detalles.producto")
            ->where("pedidos_detalles.pedido", $id)
            ->get();
        }
        $pdf = PDF::loadView('pedidos_detalles.pdf',compact('productos','clientes','pedido','estado'));
        // // return $pdf->download('pedido.pdf');
        return $pdf->stream();
        // return view('pedidos_detalles.pdf', compact('productos','clientes','pedido','estado'));
    }

    public function edit(Request $request, $id){
        $pedidos = DB::select('SELECT estado, tipo, valor_total, c.nombre, c.apellido FROM pedidos as p JOIN clientes as c WHERE p.id = ?', [$id]);
        $a = pedido::find($id);
        $productos = [];
        if($a != null){
            $productos = Producto::select("productos.*", "pedidos_detalles.cantidad as cantidad_c")
            ->join("pedidos_detalles", "productos.id", "=", "pedidos_detalles.producto")
            ->where("pedidos_detalles.pedido", $id)
            ->get();
        }

        return view('pedidos_detalles.edit', compact('productos','pedidos'));
    }

}
