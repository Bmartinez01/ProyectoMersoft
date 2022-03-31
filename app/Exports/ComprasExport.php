<?php

namespace App\Exports;

use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
        return Compra::select("id","recibo","fecha_compra","proveedor","iva","valor_total")->get();
    }
}
