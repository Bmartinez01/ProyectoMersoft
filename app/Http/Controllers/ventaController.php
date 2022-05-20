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
        $venta = venta::all();
        $clientes = Cliente::all();
        $productos = [];
        $a = pedido::findOrFail($id);
        if($id != null){
            $productos = Producto::select("productos.*", "venta_detalles.cantidad as cantidad_c")
            ->join("venta_detalles", "productos.id", "=", "venta_detalles.producto")
            ->where("venta_detalles.ventas", $id)
            ->get();
        }

        return view('ventas.show', compact('productos','clientes','venta'));
      
    }
}
