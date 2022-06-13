<?php

namespace App\Http\Controllers;

use App\Exports\PedidosExport;
use App\Http\Requests\PedidocrearRequest;
use App\Http\Requests\PedidoEditRequest;
use App\Models\pedido;
use App\Models\venta;
use App\Models\ventas_detalle;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Estados;
use App\Models\pedidos_detalles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class PedidoController extends Controller
{
    public function index()
    {

    $pedidos = DB::select("SELECT pedidos.id,pedidos.created_at,clientes.nombre as nombclient,clientes.apellido as apellclient ,valor_total,estados.Estado as estadoEst,estados.Tipo as tipoEst FROM pedidos INNER JOIN clientes ON cliente = clientes.id   INNER JOIN estados ON pedidos.estado = estados.id");
    // $productos = Producto::all();

        $minimos=DB::Select("SELECT min(date_format(created_at,'%Y-%m-%d')) as fecha_pedido from pedidos ");
        $maximos=DB::Select("SELECT max(date_format(created_at,'%Y-%m-%d')) as fecha_pedido from pedidos ");

        foreach ($minimos as $minimo){$Fecha_minima=$minimo->fecha_pedido;}
        foreach ($maximos as $maximo){$Fecha_maxima=$maximo->fecha_pedido;}

        return view('pedidos.index', compact('pedidos','Fecha_minima', 'Fecha_maxima'));
    }



    public function excel2(Request $request)
    {
        $method = $request->all();
        $from = $request->input('from');
        $to   = $request->input('to');
        $pedidos = DB::select("SELECT pedidos.id,pedidos.created_at,clientes.nombre as nombclient,clientes.apellido as apellclient ,valor_total,estados.Estado as estadoEst,estados.Tipo as tipoEst FROM pedidos INNER JOIN clientes ON cliente = clientes.id   INNER JOIN estados ON pedidos.estado = estados.id where pedidos.created_at  BETWEEN '$from 00:00:00' and '$to 23:00:00'");

        $minimos=DB::Select("SELECT min(date_format(created_at,'%Y-%m-%d')) as fecha_pedido from pedidos ");
        $maximos=DB::Select("SELECT max(date_format(created_at,'%Y-%m-%d')) as fecha_pedido from pedidos ");

        foreach ($minimos as $minimo){$Fecha_minima=$minimo->fecha_pedido;}
        foreach ($maximos as $maximo){$Fecha_maxima=$maximo->fecha_pedido;}

        return view('pedidos.index', compact('pedidos','Fecha_minima', 'Fecha_maxima'));

    }

    public function store(PedidocrearRequest $request)
    {
        /* return response()->json($request); */
        $input = $request->all();
        foreach($input["producto_id"] as $key => $value){
            $cantidades = $input["cantidades"][$key];
            $productoo = Producto::find($value);
            if($productoo < $cantidades){
                return redirect()->route('pedidos.index')->with('success', 'Esta vaina esta mala');
                die();
            }
        }

        $pedido = pedido::create([
            "cliente"=>$input["cliente"],
            // "tipo"=>$input["tipo"],
            "estado"=>$input["estado"],
            "valor_total"=>$this->calcular_precio($input["producto_id"], $input["cantidades"]),
        ]);

        $array=[];
        $array[0]=True;
        $datosPe=[];

        foreach($input["producto_id"] as $key => $value){
            $pd = pedidos_detalles::create([
                "pedido"=> $pedido->id,
                "producto"=>$value,
                "cantidad"=>  $input["cantidades"][$key],
            ]);
            $producto = Producto::find($value);
            if($producto->Stock < $input["cantidades"][$key]){
                $array[0]=False;
                // $pedido->delete();
                // $pd->delete();
                // return redirect()->route('pedidos.index')->with('success', 'Esta vaina esta mala');
            }
            else{
                $dic = array("producto"=>$producto->id,"cantidad"=>$pd->cantidad);
                array_push($datosPe, $dic);
                // $producto->update(["Stock"=>$producto->Stock - $input["cantidades"][$key]]);
            }
        }
        if($array[0]==True){
            foreach ($datosPe as $key) {
                $producto = Producto::find($key['producto']);
                $producto->update(["Stock"=>$producto->Stock - $key['producto']]);
            }
            if($input["estado"]==6 || $input["estado"]==1 ){
                // $ventas=DB::insert("INSERT INTO ventas ( cliente, valor_total, pedido_id) Values ($pedido->cliente, $pedido->valor_total, $pedido->id)");
                //$ventas=DB::insert("INSERT INTO ventas ( cliente, valor_total, pedido_id, created_at) select cliente, valor_total, id, created_at  from pedidos where pedidos.id= $pedido->id");
                $ventas=venta::create([
                    "cliente"=>$pedido->cliente,
                    "valor_total"=>$pedido->valor_total,
                    "pedido_id"=>$pedido->id
                ]);
                foreach($datosPe as $p){
                    $ventas_de=ventas_detalle::create([
                        "venta_id"=>$ventas->id,
                        "producto"=>$p['producto'],
                        "cantidad"=>$p['cantidad']
                    ]);
                }
                // return response()->json($ventas_de);
                return redirect()->route('ventas.index',compact('ventas', 'ventas_de'))->with('success', 'Venta creada correctamente');

            }
            else{
                // return response()->json($input);
                return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');
            }
        }
        else{
            $pedido->delete();
            $pd->delete();
            return redirect()->route('pedidos.index')->with('danger', 'No se puede realizar el pedido');
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

        $pedidos = pedido::findOrfail($id);
        $clientes=DB::select("SELECT nombre,apellido FROM clientes WHERE id = $pedidos->cliente");
        $productos = Producto::all();
        $estado= Estados::all();
        $productos2 = [];
        // return response()->json($pedido);
        if($id != null){
            $productos2 = Producto::select("productos.*", "pedidos_detalles.cantidad as cantidad_c")
            ->join("pedidos_detalles", "productos.id", "=", "pedidos_detalles.producto")
            ->where("pedidos_detalles.pedido", $id)
            ->get();
        }

        return view('pedidos_detalles.edit', compact('productos','productos2','clientes','pedidos','estado'));
    }





    public function update(PedidoEditRequest $request, $id )
    {
       $pedidos=Pedido::findOrFail($id);

       $pedido_detalle=pedidos_detalles::all();
       $productox=[];
       $productox=$request->productox;
       $data=$request->all();

       $array = [];
       $array2 = [];
       $p = 0;

       if ($productox != null) {
         /* return response()->json($data); */
         DB::beginTransaction();
        for ($i=0; $i < strlen($productox) ; $i++) {

            if ($productox[$i] != ",") {
                $array2[$p]= $productox[$i];
                $p++;
                continue;
            }
        }
        for ($i=0; $i < count($array2) ; $i++) {
            $array[$i] = intval($array2[$i]);
        }

        $pedido_p = DB::select("SELECT * FROM pedidos_detalles WHERE pedido = $pedidos->id");

        $p=0;
            foreach ($pedido_p as $key) {


                for ($i=0; $i < count($array) ; $i++) {

                    if ($key->producto == $array[$i]) {
                        $consulta=DB::select('SELECT Stock FROM productos WHERE id=?', [$array[$i]]);


                        $pe=$consulta[0]->Stock;
                        if ($pe >=$key->cantidad) {

                            $producto_borrar=DB::DELETE("DELETE FROM pedidos_detalles WHERE producto= $array[$i] and pedido = $id");

                            $producto_edit=DB::UPDATE("UPDATE productos SET Stock = Stock + $key->cantidad WHERE id=?", [$array[$i]]);
                        }
                        else{
                            DB::rollback();
                            return redirect()->route('pedidos.index')->with('success', 'No se pudo editar el pedido');

                        }
                    }
                }
                DB::commit();
            }
       }


       if ($request->producto_id != null) {

           $productos=[];
           $producto2=$request->producto_id;
           $cantidades=[];
           $cantidad2=$request->cantidades;
           /* $precios=[];
           $precio2=$request->precio; */

           for ($i=0; $i < count($producto2); $i++) {

               $productos[$i]=intval($producto2[$i]);
               $cantidades[$i]=intval($cantidad2[$i]);
               /* $precio[$i]=intval($precio2[$i]); */
           }

           for ($i=0; $i < count($productos) ; $i++) {

               $producto_insert=DB::insert('insert into pedidos_detalles(pedido, producto, cantidad) values(?, ?, ?)', [$id, $productos[$i], $cantidades[$i]]);
               $producto_upd= DB::update("UPDATE productos SET Stock = Stock - $cantidades[$i] WHERE id=?", [$productos[$i]]);
           }

       }

       $pedidos->update($data);
    //    return response()->json($pedidos);

       if($pedidos["estado"]==6 || $pedidos["estado"]==1 ){

        // $ventas=DB::insert("INSERT INTO ventas ( cliente, valor_total, pedido_id, created_at) select cliente, valor_total, id, created_at  from pedidos where pedidos.id= $pedidos->id");

        $ventas=venta::create([
            "cliente"=>$pedidos->cliente,
            "valor_total"=>$pedidos->valor_total,
            "pedido_id"=>$pedidos->id
        ]);
        $ventas_de=DB::insert("INSERT INTO ventas_detalles (venta_id, producto, cantidad, created_at) select $ventas->id, producto, cantidad, pd.created_at from pedidos_detalles as pd  where pedido = $pedidos->id");

        // foreach(  $pedidos as $pp){
        //     $ventas_de=ventas_detalle::create([
        //         "venta_id"=>$ventas->id,
        //         "producto"=>$pp['producto'],
        //         "cantidad"=>$pp['cantidad']
        //     ]);
        // }
        return redirect()->route('ventas.index',compact('ventas', 'ventas_de'))->with('success', 'Venta creada correctamente');
    }
    else{
        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente');
    }

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
    public function Excel(){

        abort_if(Gate::denies('pedido_descargar excel'),403);
        date_default_timezone_set("America/Bogota");
        $fecha_actual = date("Y-m-d H:i");


        $Desicion=$_POST['Desicion'];

        $Valores = DB:: select("SELECT if( COUNT(DISTINCT(id))>1,1,0) as CONTADOR FROM compras");

        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=Pedidos ". $fecha_actual .".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $tabla = "";

        $tabla .="
        <table>
            <thead>
                <tbody>
                    <tr>
                        <th>#Pedido</th>
                        <th>Cliente</th>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                    </tr>
        ";

        foreach ($Valores as $valores)

        if ($valores->CONTADOR==1){

            if ($Desicion=="Todo"){


                $Pedidos = DB:: select("select pedidos_detalles.pedido , clientes.nombre as cliente , pedidos.valor_total , estados.Estado , date_format(pedidos.created_at,'%Y-%m-%d') as created_at ,  productos.Nombre as productos ,   pedidos_detalles.cantidad from pedidos_detalles

                join pedidos on (pedidos_detalles.pedido =  pedidos.id)
                join productos on (pedidos_detalles.producto =  productos.id)
                join estados on (pedidos.estado =  estados.id)
                join clientes on (pedidos.cliente =  clientes.id)");

                foreach ($Pedidos as $pedido) {
                    $tabla .="
                        <tr>
                            <td>".$pedido->pedido."</td>
                            <td>".$pedido->cliente."</td>
                            <td>".$pedido->cantidad."</td>
                            <td>".$pedido->productos."</td>
                            <td>".$pedido->valor_total."</td>
                            <td>".$pedido->Estado."</td>
                            <td>".$pedido->created_at."</td>
                        </tr>
                    ";
                }

                $tabla .="
                        </tbody>
                    </thead>
                </table>
                ";
                echo $tabla;
            }
            else{
                $Fecha_maxima=$_POST['Fecha_maxima'];
                $Fecha_minima=$_POST['Fecha_minima'];

                $Pedidos = DB:: select("select pedidos_detalles.pedido , clientes.nombre as cliente , pedidos.valor_total , estados.Estado , date_format(pedidos.created_at,'%Y-%m-%d') as created_at ,  productos.Nombre as productos ,   pedidos_detalles.cantidad from pedidos_detalles

                join pedidos on (pedidos_detalles.pedido =  pedidos.id)
                join productos on (pedidos_detalles.producto =  productos.id)
                join estados on (pedidos.estado =  estados.id)
                join clientes on (pedidos.cliente =  clientes.id)

                where date_format(pedidos.created_at,'%Y-%m-%d') BETWEEN '".$Fecha_minima."' and '".$Fecha_maxima."'");

                foreach ($Pedidos as $pedido) {
                    $tabla .="
                    <tr>
                        <td>".$pedido->pedido."</td>
                        <td>".$pedido->cliente."</td>
                        <td>".$pedido->cantidad."</td>
                        <td>".$pedido->productos."</td>
                        <td>".$pedido->valor_total."</td>
                        <td>".$pedido->Estado."</td>
                        <td>".$pedido->created_at."</td>
                    </tr>
                    ";
                }

                $tabla .="
                        </tbody>
                    </thead>
                </table>
                ";
                echo $tabla;
            }
        }
        else {
            return redirect('compras')
                ->with('Vacio', ' ');
        }
        // return Excel::download(new ventas, 'Ventas '.$fecha_actual.'.csv');
    }
}





