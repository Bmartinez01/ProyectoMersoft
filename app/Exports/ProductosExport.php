<?php

namespace App\Exports;

use App\Models\Producto;
use App\Models\Categoria;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ProductosExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            'Id ',
            'Código ',
            'Nombre',
            'Categorías ',
            'Stock ',
            'Precio',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Producto::select("id","Código","Nombre","Categorías","Stock","precio")
        // ->join("categorias")
        // ->on ("productos.Categorías","=","categorias.id") 
        ->get();
        //$return = DB::select('SELECT p.id, p.Código, p.Nombre,c.nombre, p.Stock, p.precio, p.estado FROM productos as p JOIN categorias as c') ->get();

        
    }
}
