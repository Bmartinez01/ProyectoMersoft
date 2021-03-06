<?php

namespace App\Http\Controllers;

use App\Exports\ventasExport;
use App\Http\Requests\PedidocrearRequest;
use App\Models\pedido;
use App\Models\venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Estados;
use App\Models\ventas_detalle;
use Illuminate\Http\Request;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class ventaController extends Controller
{

    public function index()
    {
        $ventas = DB::select("SELECT v.id,pedido_id,v.created_at,clientes.nombre, clientes.apellido, valor_total FROM ventas  as v INNER JOIN clientes ON cliente = clientes.id");
        // $productos = Producto::all();
        // $ventas = venta::paginate();

        return view('ventas.index',compact('ventas'));


    }
    public function show(Request $request, $id){

        // $venta_De=DB::select("SELECT id, venta_id, producto, cantidad from ventas_detalles ");
        // abort_if(Gate::denies('venta_ver detalle'),403);
        $Venta = DB::select('SELECT v.id, v.pedido_id, v.valor_total, c.nombre, c.apellido FROM ventas as v  JOIN clientes as c WHERE v.id = ? AND c.id = v.cliente', [$id] );
        $a = venta::find($id);
        $productos = [];
        if($a != null){
            $productos = Producto::select("productos.*", "ventas_detalles.cantidad as cantidad_c")
            ->join("ventas_detalles", "productos.id", "=", "ventas_detalles.producto")
            ->where("ventas_detalles.venta_id", $id)
            ->get();
        }
        // return response()->json($productos);
        return view('ventas.show', compact('Venta','productos'));

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
        $compras = DB::select("SELECT SUM(valor_total) as 'ct' from compras WHERE Year(fecha_compra) = $año_pro UNION SELECT SUM(valor_total) as 'vt' FROM ventas WHERE Year(created_at) = $año_pro");
        $n = $compras[1]->ct - $compras[0]->ct;
        $ventas = DB::select("SELECT MonthName(created_at) AS meses, SUM(valor_total) AS suma_ventas, Month(created_at) AS mes FROM ventas WHERE Year(created_at) = $year GROUP BY mes,MonthName(created_at) ORDER BY mes");
        $ventas_años = DB::select("SELECT year(created_at) AS años, SUM(valor_total) AS suma_ventas FROM ventas WHERE Year(created_at) = $año GROUP BY year(created_at)  ORDER BY year(created_at)");
        $productos_c = DB::select("SELECT p.Nombre AS nombre, p.unidad , SUM(cantidad) AS cantidades FROM  ventas_detalles  as v JOIN productos as p ON p.id = producto WHERE Year(v.created_at) = $año_pro GROUP BY p.unidad,p.Nombre,producto ORDER BY cantidades DESC LIMIT 5");
        $data = [];
        foreach ($ventas as $venta){
            $data['label1'][] = $venta->meses;
            $data['data1'][] = $venta->suma_ventas;
        }
        foreach($ventas_años as $venta_año){
            $data['label2'][] = $venta_año->años;
            $data['data2'][] = $venta_año->suma_ventas;
        }
        foreach($productos_c as $producto){
            $data['label3'][] = $producto->nombre." ".$producto->unidad;
            $data['data3'][] = $producto->cantidades;

        }

            foreach ($compras as $compra){
                 $data['label'][0] = "Compras Total";
                 $data['label'][1] = "Ventas Total";
                 $data['data'][] = $compra->ct;
            }

        $data['data'] = json_encode($data);
        // return response()->json($data);
          return view('ventas.charts', $data, compact('year','año','año_pro','n'));
    }




    public function pdf(Request $request, $id){
        $Venta = DB::select('SELECT v.id, v.pedido_id, v.valor_total, c.nombre, c.apellido FROM ventas as v  JOIN clientes as c WHERE v.id = ? AND c.id = v.cliente', [$id] );
        $a = venta::find($id);
        $productos = [];
        if($a != null){
            $productos = Producto::select("productos.*", "ventas_detalles.cantidad as cantidad_c")
            ->join("ventas_detalles", "productos.id", "=", "ventas_detalles.producto")
            ->where("ventas_detalles.venta_id", $id)
            ->get();
        }
        $fecha = date("d")."-".date("m")."-".date("Y");
        $pdf = PDF::loadView('ventas.pdf', compact('Venta','productos'));
        return $pdf->download("venta-$fecha.pdf");
        //return $pdf->stream();
        //return view('ventas.pdf', compact('Venta','productos'));

    }
}
