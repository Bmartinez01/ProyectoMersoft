<?php

namespace App\Http\Controllers;

use App\Models\pedido;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Estados;
use app\Models\pedidos_detalles;
use Illuminate\Http\Request;
use DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = pedido::all();
        $clientes = Cliente::all();
        $estados= Estados::all();
        // $productos = Producto::all();
        return view('pedidos.index', compact('pedidos','clientes','estados'));
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
    pedido::create($request->except('cantidad', 'producto', 'valor_unitario'));
        // Compra_Detalle::create($request->all());

    // $maximo = DB::select('select max(id) from compras');
        // Compra_Detalle::create($request->except('proveedor','recibo'));

  return redirect()->route('pedidos.index')->with('success', 'Compra creada correctamente');


}
public function destroy(pedido $pedido)
{
    $pedido->delete();
    return back()->with('success', 'Pedido cancelado correctamente');
}

}





