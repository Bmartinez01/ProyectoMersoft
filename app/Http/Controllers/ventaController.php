<?php

namespace App\Http\Controllers;



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
        // $pedidos = DB::select("SELECT pedidos.id,pedidos.created_at,clientes.nombre as nombclient,clientes.apellido as apellclient ,valor_total,estados.Estado as estadoEst,estados.Tipo as tipoEst FROM pedidos INNER JOIN clientes ON cliente = clientes.id   INNER JOIN estados ON pedidos.estado = estados.id ");

        $ventas = DB::select("SELECT pedido_id,ventas.created_at,clientes.nombre, clientes.apellido, valor_total FROM ventas INNER JOIN clientes ON cliente = clientes.id");
        // $productos = Producto::all();
        // $ventas = venta::paginate();
        return view('ventas.index',compact('ventas'));
    }

}
