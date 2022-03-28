<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompraCreateRequest;
use App\Models\Compra;
use App\Models\Compra_Detalle;
use App\Models\Proveedore;
use App\Models\Producto;
use Illuminate\Http\Request;
use PDF;
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
    public function pdf(Request $request, $id){
        $a = Compra::findOrFail($id);
        $compras = Compra::all();
        $proveedores = Proveedore::all();
        $productos = [];
        if($id != null){
            $productos = Producto::select("productos.*", "compra__detalles.cantidad as cantidad_c","compra__detalles.precio as precios")
            ->join("compra__detalles", "productos.id", "=", "compra__detalles.producto")
            ->where("compra__detalles.compras_id", $id)
            ->get();
        }

        $pdf = PDF::loadView('compras.pdf',compact('productos','proveedores','compras'));
        // return $pdf->download('compra.pdf');
        return $pdf->stream();
        // return view('compras.pdf', compact('productos','proveedores','compras'));
    }

    public function store(CompraCreateRequest $request)
    {
        $input = $request->all();
        $compra = Compra::create([
            "recibo"=>$input["recibo"],
            "iva"=>$input["iva"],
            "fecha_compra"=>$input["fecha_compra"],
            "proveedor"=>$input["proveedor"],
            "valor_total"=>$this->calcular_precio($input["producto_id"], $input["cantidades"], $input["precios"],$input["iva"]),
        ]);

        foreach($input["producto_id"] as $key => $value){
            Compra_Detalle::create([
                "compras_id"=> $compra->id,
                "producto"=>$value,
                "precio"=>$input["precios"][$key],
                "cantidad"=>$input["cantidades"][$key],
            ]);
            $producto = Producto::find($value);
            $producto->update(["Stock"=>$producto->Stock + $input["cantidades"][$key]]);
        }

        return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');
            // return response()->json($input);
}
    public function calcular_precio($productos,$cantidades,$precios,$iva){
        $precio = 0;
        foreach($productos as $key => $value){
            $producto = Producto::find($value);
            $precio += ($precios[$key] * $cantidades[$key]);
        }
        return $precio + $iva;
    }

    public function show(Request $request, $id){
        $a = Compra::findOrFail($id);
        $compras = Compra::all();
        $proveedores = Proveedore::all();
        $productos = [];
        if($id != null){
            $productos = Producto::select("productos.*", "compra__detalles.cantidad as cantidad_c","compra__detalles.precio as precios")
            ->join("compra__detalles", "productos.id", "=", "compra__detalles.producto")
            ->where("compra__detalles.compras_id", $id)
            ->get();
        }

        return view('compras.show', compact('productos','proveedores','compras'));
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();
        return back()->with('success', 'Compra anulada correctamente');
    }
}
