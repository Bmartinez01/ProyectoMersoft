<?php

namespace App\Http\Controllers;

use App\Exports\ComprasExport;
use App\Http\Requests\CompraCreateRequest;
use App\Models\Compra;
use App\Models\Compra_Detalle;
use App\Models\Proveedore;
use App\Models\Producto;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CompraController extends Controller
{
    //
    public function index()
    {
        $compras = DB::select("SELECT compras.id, recibo,fecha_compra,proveedores.nombre as nombreprov ,proveedores.apellido as apelliprov, valor_total FROM compras INNER JOIN proveedores ON proveedor = proveedores.id");
        $productos = Producto::all();

        $minimos=DB::Select("SELECT min(fecha_compra) AS fecha_compra FROM compras");
        $maximos=DB::Select("SELECT max(fecha_compra) AS fecha_compra FROM compras");
        
        foreach ($minimos as $minimo){$Fecha_minima=$minimo->fecha_compra;}
        foreach ($maximos as $maximo){$Fecha_maxima=$maximo->fecha_compra;}

        return view('compras.index', compact('compras','productos','Fecha_minima', 'Fecha_maxima'));


    }
    public function pdf(Request $request, $id){
        $compras = DB::select('SELECT recibo, fecha_compra, iva, valor_total, p.nombre, p.apellido FROM compras as c JOIN proveedores as p WHERE c.id = ? AND p.id = c.proveedor', [$id]);
        $productos = [];
        $a = Compra::findOrFail($id);
        if($a > null){
            $productos = Producto::select("productos.*", "compra__detalles.cantidad as cantidad_c","compra__detalles.precio as precios")
            ->join("compra__detalles", "productos.id", "=", "compra__detalles.producto")
            ->where("compra__detalles.compras_id", $id)
            ->get();
            $fecha = date("d")."-".date("m")."-".date("Y");
            $pdf = PDF::loadView('compras.pdf',compact('productos','compras'));
            // return $pdf->download("compra-$fecha.pdf");
            return $pdf->stream();
            // return view('compras.pdf', compact('productos','compras'));
        }

        // $pdf = PDF::loadView('compras.pdf',compact('productos','proveedores','compras'));
        // return $pdf->download('compra.pdf');
        // return $pdf->stream();
        // return view('compras.pdf', compact('productos','proveedores','compras'));
    }

    public function store(CompraCreateRequest $request)
    {
        $input = $request->all();
        $compra = Compra::create([
            "recibo"=>$input["recibo"],
            "iva"=>$input["iva"],
            "fecha_compra"=>$input["fecha_compra"],
            "proveedor"=>$input["proveedor"],
            "valor_total"=>$this->calcular_precio($input["producto_id"], $input["cantidades"], $input["precios"],$input["iva"]),
        ]);

        foreach($input["producto_id"] as $key => $value){
            Compra_Detalle::create([
                "compras_id"=> $compra->id,
                "producto"=>$value,
                "precio"=>$input["precios"][$key],
                "cantidad"=>$input["cantidades"][$key],
            ]);
            $producto = Producto::find($value);
            $producto->update(["Stock"=>$producto->Stock + $input["cantidades"][$key]]);
        }
        // return response()->json($producto);
        return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');
}
public function destroy(Compra $compra)
{

    $compra_p = DB::select('SELECT * FROM compra__detalles WHERE compras_id = ? ', [$compra->id]);

    foreach ($compra_p as $key) {
      $product_upd = DB::update("UPDATE productos SET Stock = Stock - $key->cantidad WHERE id = ?", [$key->producto]);
    }
    $compra->delete();
    return back()->with('success', 'Compra anulada correctamente');
}
    public function calcular_precio($productos,$cantidades,$precios,$iva){
        $precio = 0;
        foreach($productos as $key => $value){
            $producto = Producto::find($value);
            $precio += ($precios[$key] * $cantidades[$key]);
        }
        return $precio + $iva;
    }

    public function show(Request $request, $id){
        $compras = DB::select('SELECT c.recibo, c.fecha_compra, c.iva, c.valor_total, p.nombre, p.apellido FROM compras as c JOIN proveedores as p WHERE c.id = ? AND p.id = c.proveedor', [$id]);
        $productos = [];
        $a = Compra::findOrFail($id);
        if($a != null){
            $productos = Producto::select("productos.*", "compra__detalles.cantidad as cantidad_c","compra__detalles.precio as precios")
            ->join("compra__detalles", "productos.id", "=", "compra__detalles.producto")
            ->where("compra__detalles.compras_id", $id)
            ->get();
            return view('compras.show', compact('productos','compras'));
        }
        else {
            return redirect('compras')->with('error', 'El id de la compra no existe');
        }

        return view('compras.index');
    }
    // public function excel()
    // {
    //     $fecha = date("d")."-".date("m")."-".date("Y") ;
    //     return Excel::download(new ComprasExport, "Compras-$fecha.xlsx");
    // }
    public function excel2(Request $request)
    {
        $method = $request->all();
        $from = $request->input('from');
        $to   = $request->input('to');
        $compras = DB::select("SELECT compras.id, recibo,fecha_compra,proveedores.nombre as nombreprov ,proveedores.apellido as apelliprov, valor_total FROM compras JOIN proveedores ON compras.proveedor = proveedores.id WHERE compras.fecha_compra  BETWEEN '$from' and '$to'");
        $minimos=DB::Select("SELECT min(fecha_compra) AS fecha_compra FROM compras");
        $maximos=DB::Select("SELECT max(fecha_compra) AS fecha_compra FROM compras");
        
        foreach ($minimos as $minimo){$Fecha_minima=$minimo->fecha_compra;}
        foreach ($maximos as $maximo){$Fecha_maxima=$maximo->fecha_compra;}
        return view('compras.index', compact('compras','Fecha_minima', 'Fecha_maxima'));

    }
    public function charts(Request $request){
        DB::statement("SET lc_time_names = 'es_MX'");
        $year = $request->selaño;
        $año = $request->año;
        $año_pro = date("Y");

        if ($year == "" || $año == "" ){
            $year = date("Y");
            $año = date("Y");

        }

        $compras = DB::select("SELECT MonthName(fecha_compra) AS meses, SUM(valor_total) AS suma_compras, Month(fecha_compra) AS mes FROM compras WHERE Year(fecha_compra) = $year GROUP BY mes,MonthName(fecha_compra) ORDER BY mes");
        $compras_años = DB::select("SELECT year(fecha_compra) AS años, SUM(valor_total) AS suma_compras FROM compras WHERE Year(fecha_compra) = $año GROUP BY year(fecha_compra)  ORDER BY year(fecha_compra)");
        $productos_c = DB::select("SELECT  p.Nombre AS nombre,  p.unidad as unidad, SUM(cantidad) AS cantidades FROM  compra__detalles  as c JOIN productos as p WHERE p.id = producto AND Year(c.created_at) = $año_pro GROUP BY p.unidad,p.Nombre,producto ORDER BY cantidades DESC LIMIT 5");
        $data = [];
        foreach ($compras as $compra){
            $data['label1'][] = $compra->meses;
            $data['data1'][] = $compra->suma_compras;
        }
        foreach($compras_años as $compra_año){
            $data['label2'][] = $compra_año->años;
            $data['data2'][] = $compra_año->suma_compras;
        }
        foreach($productos_c as $producto){
            $data['label3'][] = $producto->nombre." ".$producto->unidad;
            $data['data3'][] = $producto->cantidades;

        }


        $data['data'] = json_encode($data);
        // return response()->json($data);
          return view('compras.charts', $data, compact('year','año','año_pro'));
    }
    // public function charts(Request $request){
    //     $year = $request->selaño;
    //     if ($year == ""){
    //          $year = date("Y");
    //         }
    //     DB::statement("SET lc_time_names = 'es_MX'");
    //     $compras = DB::select("SELECT SUM(valor_total) as 'ct' from compras WHERE Year(fecha_compra) = $year UNION SELECT SUM(valor_total) as 'vt' FROM ventas WHERE Year(created_at) = $year");
    //     $data = $compras;
    //     foreach ($compras as $compra){
    //          $data['label'][0] = "Compras Total";
    //          $data['label'][1] = "Ventas Total";
    //          $data['data'][] = $compra->ct;
    //     }
    //       $data['data'] = json_encode($data);
    //       return view('compras.charts', $data);
    //    // return response()->json($compras);
    // }
    public function Excel(){
        date_default_timezone_set("America/Bogota");
        $fecha_actual = date("Y-m-d H:i");


        $Desicion=$_POST['Desicion'];

        $Valores = DB:: select("SELECT if( COUNT(DISTINCT(id))>1,1,0) as CONTADOR FROM compras");
        
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=Compras ". $fecha_actual .".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $tabla = "";

        $tabla .="
        <table>
            <thead>
                <tbody>
                    <tr>
                        <th>Recibo</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Fecha de compra</th>
                        <th>Cantidad</th>
                        <th>Iva</th>
                        <th>Precio</th>
                    </tr>
        ";

        foreach ($Valores as $valores)

        if ($valores->CONTADOR==1){

            if ($Desicion=="Todo"){


                $Compras = DB:: select("select compras.id, compras.recibo, compras.fecha_compra, proveedores.nombre as cliente, compras.iva, compras.valor_total,compra__detalles.cantidad,productos.Nombre as producto,compra__detalles.precio from compra__detalles

                join compras on  (compra__detalles.compras_id = compras.id)
                join productos on (compra__detalles.producto = productos.id)
                join proveedores on (compras.proveedor = proveedores.id)");

                foreach ($Compras as $compras) {
                    $tabla .="
                        <tr>
                            <td>".$compras->recibo."</td>
                            <td>".$compras->cliente."</td>
                            <td>".$compras->producto."</td>
                            <td>".$compras->fecha_compra."</td>
                            <td>".$compras->cantidad."</td>
                            <td>".$compras->iva."</td>
                            <td>".$compras->precio."</td>
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

                $Compras = DB:: select("select compras.id, compras.recibo, compras.fecha_compra, proveedores.nombre as cliente, compras.iva, compras.valor_total,compra__detalles.cantidad,productos.Nombre as producto,compra__detalles.precio from compra__detalles

                join compras on  (compra__detalles.compras_id = compras.id)
                join productos on (compra__detalles.producto = productos.id)
                join proveedores on (compras.proveedor = proveedores.id)
                
                where compras.fecha_compra BETWEEN '".$Fecha_minima."' and '".$Fecha_maxima."'");

                foreach ($Compras as $compras) {
                    $tabla .="
                        <tr>
                            <td>".$compras->recibo."</td>
                            <td>".$compras->cliente."</td>
                            <td>".$compras->producto."</td>
                            <td>".$compras->fecha_compra."</td>
                            <td>".$compras->cantidad."</td>
                            <td>".$compras->iva."</td>
                            <td>".$compras->precio."</td>
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
