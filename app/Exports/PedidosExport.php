<?php

namespace App\Exports;

use App\Models\Pedido;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PedidosExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            'Id',
            'Cliente ',
            'Valor total',
            'Estado ',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pedido::select("id","cliente","valor_total","estado")->get();
    }
}
