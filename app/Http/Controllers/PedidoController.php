<?php

namespace App\Http\Controllers;

use App\Models\pedido;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Estados;
use App\Models\pedidos_detalles;
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
        $input = $request->all();
        $pedido = pedido::create([
            "cliente"=>$input["cliente"],
            "tipo"=>$input["tipo"],
            "estado"=>$input["estado"],
            "valor_total"=>$this->calcular_precio($input["producto_id"], $input["cantidades"]),

        ]);

        foreach($input["producto_id"] as $key => $value){
            pedidos_detalles::create([
                "pedido"=> $pedido->id,
                "producto"=>$value,
                "cantidad"=>  $input["cantidades"][$key],
            ]);
            $producto = Producto::find($value);
            $producto->update(["Stock"=>$producto->Stock - $input["cantidades"][$key]]);
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');

    // $maximo = DB::select('select max(id) as Max_id from compras') ;
    //     var_dump($maximo[0]->Max_id);

}
    public function calcular_precio($productos,$cantidades){
        $precio = 0;
        foreach($productos as $key => $value){
            $producto = Producto::find($value);
            $precio += ($producto->precio * $cantidades[$key]);
        }
        return $precio;
    }

    public function edit(Request $request, $id){
        $a = pedido::findOrFail($id);
        $productos = [];
        if($id != null){
            $productos = Producto::select("productos.*", "pedidos_detalles.cantidad as cantidad_c")
            ->join("pedidos_detalles", "productos.id", "=", "pedidos_detalles.producto")
            ->where("pedidos_detalles.pedido", $id)
            ->get();
        }

        return view('pedidos.edit', compact('productos'));
    }



public function destroy(pedido $pedido)
{
    $pedido->delete();
    return back()->with('success', 'Pedido cancelado correctamente');
}

}





