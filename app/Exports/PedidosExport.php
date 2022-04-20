<?php

namespace App\Exports;

use App\Models\Pedido;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class PedidosExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            'Id',
            'Cliente ',
            'Valor Total',
            'Estado ',
            'Fecha de registro',
            'Producto ',
            'Cantidad ',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       /*  $productos = DB::table('pedidos')
        ->join('estados', 'pedidos.estado', '=', 'estados.id')
        ->join('clientes', 'pedidos.cliente', '=', 'clientes.id')
        ->select('pedidos.id', 'clientes.nombre', 'pedidos.valor_total',  'estados.Estado')
        ->get();
        return $productos; */
        // return Pedido::select("id","cliente","valor_total","estado")->get();
        $productos = DB::table('pedidos_detalles')
        ->join('pedidos', 'pedidos_detalles.pedido', '=', 'pedidos.id')
        ->join('productos', 'pedidos_detalles.producto', '=', 'productos.id')
        ->join('estados', 'pedidos.estado', '=', 'estados.id')
        ->join('clientes', 'pedidos.cliente', '=', 'clientes.id')

        ->select('pedidos_detalles.pedido','clientes.nombre','pedidos.valor_total','estados.Estado','pedidos.created_at', 'productos.Nombre',  'pedidos_detalles.cantidad', )
        ->get();
        return $productos;
    }
}
