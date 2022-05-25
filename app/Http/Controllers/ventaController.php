<?php

namespace App\Http\Controllers;

use App\Exports\ventasExport;
use App\Http\Requests\PedidocrearRequest;
use App\Models\pedido;
use App\Models\venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Estados;
use App\Models\venta_detalles;
use Illuminate\Http\Request;
use DB;
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

        $venta_De=DB::select("SELECT id, venta_id, producto, cantidad from ventas_detalles ");
        $venta=DB::select("SELECT v.id, pedido_id, clientes.nombre, clientes.apellido, valor_total from ventas as v INNER JOIN clientes ON cliente = clientes.id ");
        return view('ventas.show', compact('venta_De', 'venta'));

    }
}
