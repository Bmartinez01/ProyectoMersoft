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
use PDF;


class PedidoController extends Controller
{
    public function index()
    {

    $pedidos = DB::select("SELECT pedidos.id,pedidos.created_at,clientes.nombre as nombclient,clientes.apellido as apellclient ,valor_total,estados.Estado as estadoEst,estados.Tipo as tipoEst FROM pedidos INNER JOIN clientes ON cliente = clientes.id   INNER JOIN estados ON pedidos.estado = estados.id ");
    // $productos = Producto::all();


        return view('pedidos.index', compact('pedidos'));
    }


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
        /* return response()->json($request); */

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
        if($input["estado"]==6 || $input["estado"]==1 ){

            $ventas=DB::insert("INSERT INTO ventas (cliente, valor_total, pedido_id, created_at) select cliente, valor_total, id, created_at  from pedidos where pedidos.id= $pedido->id");
            return redirect()->route('ventas.index',compact('ventas'))->with('success', 'Venta creada correctamente');
        }
            else{
                // return response()->json($input);
                return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');
            }




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

        $pedido = pedido::all();
        $clientes = Cliente::all();
        $estado= Estados::all();
        $productos = [];
        $a = pedido::findOrFail($id);
        if($id != null){
            $productos = Producto::select("productos.*", "pedidos_detalles.cantidad as cantidad_c")
            ->join("pedidos_detalles", "productos.id", "=", "pedidos_detalles.producto")
            ->where("pedidos_detalles.pedido", $id)
            ->get();
        }

        return view('pedidos_detalles.edit', compact('productos','clientes','pedido','estado'));
    }





    public function update(Request $request,pedido $pedido, )
    {
       $pedido=Pedido::all();


       $pedido_detalle=pedidos_detalles::all();
       $productos=[];
       $productos=$request->productos;
       $data=$request->all();

       $array = [];
       $array2 = [];
       $p = 0;

       if ($productos != null) {
        for ($i=0; $i < strien($productos) ; $i++) {

            if ($porductos[$i] != ",") {
                $array2[$p]= $productos[$i];
                $p++;
                continue;
            }
        }

        for ($i=0; $i < count($array2) ; $i++) {
            $array[$i] = intval($array2[$i]);
        }


        $pedido_p = DB::select('SELECT*FROM pedidos_detalles WHERE pedido =?', [$pedido->$id]);
        $p=0;

        foreach ($pedido_p as $key) {
            for ($i=0; $i < count($array) ; $i++) {
                if ($key->producto == $array[$i]) {
                    $consulta=DB::select('SELECT Stock FROM productos WHERE id=?', [$array[$i]]);
                    $pe=$consulta[0]->Stock;
                    if ($pe >=$key->Stock) {
                        $producto_borrar=DB::DELETE("DELETE FROM pedidos_detalles WHERE producto= $array[$i] and pedido = $id");
                        $producto_edit=DB::UPDATE("UPDATE productos SET Stock = Stock + $key->Stock WHERE id=?", [$array[$i]]);
                    }
                }
            }
        }

       }

       if ($request->producto != null) {
           $productos=[];
           $producto2=$request->producto;

           $Stock=[];
           $Stock2=$request->Stock;

           $precio=[];
           $precio2=$request->precio;

           for ($i=0; $i < count($producto2); $i++) {
               $productos[$i]=intval($producto2[$i]);
               $Stock[$i]=intval($Stock2[$i]);
               $precio[$i]=intval($precio2[$i]);
           }

           for ($i=0; $i < count($producto) ; $i++) {
               $producto_insert=DB::insert("INSERT INTO pedidos_detalles(pedido, producto, cantidad) values(?, ?, ?)", $id, [$productos[$i]], [$Stock[$i]]);
               $producto_upd= DB::update("UPDATE productos SET Stock = Stock + $Stock[$i] WHERE id=?", [$productos[$i]]);
           }

       }

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente');

    }




    public function show(Request $request, $id){
        $pedido = DB::select('SELECT e.estado, valor_total, c.nombre, c.apellido FROM pedidos as p JOIN estados as e ON e.id = p.estado JOIN clientes as c WHERE p.id = ? AND c.id = p.cliente', [$id] );
        $a = pedido::find($id);
        $estado= Estados::all();
        $productos = [];
        if($a != null){
            $productos = Producto::select("productos.*", "pedidos_detalles.cantidad as cantidad_c")
            ->join("pedidos_detalles", "productos.id", "=", "pedidos_detalles.producto")
            ->where("pedidos_detalles.pedido", $id)
            ->get();
        }

        return view('pedidos_detalles.show', compact('productos','pedido','estado'));
    }
    public function pdf(Request $request, $id){
        $pedido = DB::select('SELECT e.estado, valor_total, c.nombre, c.apellido FROM pedidos as p JOIN estados as e ON e.id = p.estado JOIN clientes as c WHERE p.id = ? AND c.id = p.cliente', [$id] );
        $a = pedido::find($id);
        $estado= Estados::all();
        $productos = [];
        if($a != null){
            $productos = Producto::select("productos.*", "pedidos_detalles.cantidad as cantidad_c")
            ->join("pedidos_detalles", "productos.id", "=", "pedidos_detalles.producto")
            ->where("pedidos_detalles.pedido", $id)
            ->get();
        }
        $fecha = date("d")."-".date("m")."-".date("Y");
        $pdf = PDF::loadView('pedidos_detalles.pdf',compact('productos','pedido','estado'));
        // // return $pdf->download("pedido-$fecha.pdf");
        return $pdf->stream();
        // return view('pedidos_detalles.pdf', compact('productos','clientes','pedido','estado'));

    }

    public function destroy(pedido $pedido)
    {
        $pedido_p = DB::select('SELECT * FROM pedidos_detalles WHERE pedido = ? ', [$pedido->id]);

    foreach ($pedido_p as $key) {
      $product_upd = DB::update("UPDATE productos SET Stock = Stock + $key->cantidad WHERE id = ?", [$key->producto]);
    }
        $pedido->delete();
        return back()->with('success', 'Pedido cancelado correctamente');
    }

}





