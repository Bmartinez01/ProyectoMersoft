<?php

namespace App\Http\Controllers;

use App\Exports\PedidosExport;
use App\Http\Requests\PedidocrearRequest;
use App\Models\pedido;
use App\Models\venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Estados;
use App\Models\pedidos_detalles;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class PedidoController extends Controller
{
    public function index()
    {
        
        $pedidos = DB::select("SELECT pedidos.id,pedidos.created_at,clientes.nombre as nombclient,clientes.apellido as apellclient ,valor_total,estados.Estado as estadoEst,estados.Tipo as tipoEst FROM pedidos INNER JOIN clientes ON cliente = clientes.id   INNER JOIN estados ON pedidos.estado = estados.id ");
        // $productos = Producto::all();
        return view('pedidos.index', compact('pedidos'));
    }
    // public function create()
    // {

    //     $pedidos = new pedido;
    //     $clientes = Cliente::all();
    //     $productos = Producto::all();
    //     return view('pedidos.create', compact('pedidos','clientes','productos'));

    // }

    public function excel()
    {
        $fecha = date("d")."-".date("m").date("Y") ;
        return Excel::download(new PedidosExport, "Pedidos-$fecha.xlsx");
    }
    public function excel2(Request $request)
    {
        $method = $request->all();
        $from = $request->input('from');
        $to   = $request->input('to');
        $pedidos = DB::select("SELECT pedidos.id,pedidos.created_at,clientes.nombre as nombclient,clientes.apellido as apellclient ,valor_total,estados.Estado as estadoEst,estados.Tipo as tipoEst FROM pedidos INNER JOIN clientes ON cliente = clientes.id   INNER JOIN estados ON pedidos.estado = estados.id where pedidos.created_at  BETWEEN '$from 00:00:00' and '$to 23:00:00'");

        return view('pedidos.index', compact('pedidos'));

    }

    public function store(PedidocrearRequest $request)
    {

        $input = $request->all();
        $pedido = pedido::create([
            "cliente"=>$input["cliente"],
            // "tipo"=>$input["tipo"],
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
        
    // $maximo = DB::select('select max(id) as Max_id from compras') ;
    //     var_dump($maximo[0]->Max_id);
    // if($input=='vendido'|| $input=='venta directa'){
    //     $ventas=DB::select('INSERT INTO ventas (pedido_id, cliente, valor_total) select id, cliente, valor_total from  pedidos ');
    //     return redirect()->route('ventas.index',compact('ventas'))->with('success', 'Venta creado correctamente');
    // }
        return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');
       


}
    public function calcular_precio($productos,$cantidades){
        $precio = 0;
        foreach($productos as $key => $value){
            $producto = Producto::find($value);
            $precio += ($producto->precio * $cantidades[$key]);
        }
        return $precio;
    }

    public function update(Request $request,pedido $pedido)
    {
        $datos = $request->except('cantidad','producto','valor_total');
        $pedido->update($datos);
        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente');

    }

    public function destroy(pedido $pedido)
    {
        $pedido->delete();
        return back()->with('success', 'Pedido cancelado correctamente');
    }

}





