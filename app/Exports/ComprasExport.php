<?php

namespace App\Exports;

use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ComprasExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            'Id',
            'Recibo',
            'Fecha compra',
            'Proveedor',
            'Iva',
            'Valor_total',
            'Cantidad',
            'Producto',
            'Precio',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        /* $compras = DB::table('compras')
        ->join('proveedores', 'compras.proveedor', '=', 'proveedores.id')
        ->select('compras.id', 'compras.recibo', 'compras.fecha_compra', 'proveedores.nombre', 'compras.iva', 'compras.valor_total',)
        ->get();
        return $compras; */
        $compras = DB::table('compra__detalles')
        ->join('compras', 'compra__detalles.compras_id', '=', 'compras.id')
        ->join('productos', 'compra__detalles.producto', '=', 'productos.id')
        ->join('proveedores', 'compras.proveedor', '=', 'proveedores.id')
        ->select('compras.id', 'compras.recibo', 'compras.fecha_compra', 'proveedores.nombre', 'compras.iva', 'compras.valor_total','compra__detalles.cantidad','productos.Nombre','compra__detalles.precio')
        ->get();
        return $compras;
    }
}
