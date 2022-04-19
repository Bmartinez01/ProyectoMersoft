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
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $compras = DB::table('compras')
        ->join('proveedores', 'compras.proveedor', '=', 'proveedores.id')
        ->select('compras.id', 'compras.recibo', 'compras.fecha_compra', 'proveedores.nombre', 'compras.iva', 'compras.valor_total',)
        ->get();
        return $compras;
    }
}
