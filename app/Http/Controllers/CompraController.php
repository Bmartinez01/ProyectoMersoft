<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompraCreateRequest;
use App\Models\Compra;
use App\Models\Compra_Detalle;
use App\Models\Proveedore;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    //
    public function index()
    {
        $compras = Compra::all();
        $proveedores = Proveedore::all();
        $productos = Producto::all();
        return view('compras.index', compact('compras','proveedores','productos'));
    }

    public function store(CompraCreateRequest $request)
    {
        $input = $request->all();
        $compra = Compra::create([
            "recibo"=>$input["recibo"],
            "fecha_compra"=>$input["fecha_compra"],
            "proveedor"=>$input["proveedor"],
            "valor_total"=>$this->calcular_precio($input["producto_id"], $input["cantidades"]),

        ]);

        foreach($input["producto_id"] as $key => $value){
            Compra_Detalle::create([
                "compras_id"=> $compra->id,
                "producto"=>$value,
                "cantidad"=>  $input["cantidades"][$key],
            ]);
            $producto = Producto::find($value);
            $producto->update(["Stock"=>$producto->Stock + $input["cantidades"][$key]]);
        }

        return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');

}
    public function calcular_precio($productos,$cantidades){
        $precio = 0;
        foreach($productos as $key => $value){
            $producto = Producto::find($value);
            $precio += ($producto->precio * $cantidades[$key]);
        }
        return $precio;
    }

    public function show(Request $request, $id){
        $a = Compra::findOrFail($id);
        $compras = Compra::all();
        $proveedores = Proveedore::all();
        $productos = [];
        if($id != null){
            $productos = Producto::select("productos.*", "compra__detalles.cantidad as cantidad_c")
            ->join("compra__detalles", "productos.id", "=", "compra__detalles.producto")
            ->where("compra__detalles.compras_id", $id)
            ->get();
        }

        return view('compras.show', compact('productos','proveedores','compras'));
    }

    public function destroy(Compra $compra)
    {
        $compra_detalle = Compra_Detalle::all();
        $compra->delete();
        foreach($compra_detalle as $row){
        if($compra){
            $producto = Producto::find($id);
            $producto->update(["Stock"=>$producto->Stock - $row->cantidad]);
        }
    }

        return back()->with('success', 'Compra anulada correctamente');
    }
}
