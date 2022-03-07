<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedore;
use App\Models\Producto;
use Illuminate\Http\Request;
use DB;

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

    public function create()
    {

        $compras = new Compra;
        $proveedores = Proveedore::all();
        $productos = Producto::all();
        return view('compras.create', compact('compras','proveedores','productos'));

    }

    public function store(Request $request)
    {
    //   $compras = $request->all();
    //   try {
    //     DB::beginTransaction();
    //   $producto = Producto::create([

    //         "nombre"=>$compras["nombre"],
    //         "Precio"=>$this->calcular_precio($compras["producto_id"], $compras["cantidades"])
    //    ]);
    //    DB::commit();
    //    return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');

    //  } catch(\Exception $e){
    //     DB::rollback();
    //  }

    //   return redirect()->route('compras.index')->with('success', 'Compra creada muy mal');
    // }

    // public function calcular_precio($productos, $cantidades){
    //     $precio = 0;
    //     foreach($productos as $key => $row){
    //         $producto = Producto::find($row);
    //         $precio += ($producto->precio * $cantidades[$key]);
    //     }
    //     return $precio;
    // }
    Compra::create($request->all());
  return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');

}

    public function show(){
        $proveedores = Proveedore::all();
        $productos = Producto::all();
        $compras = Compra::all();
        return view('compras.show', compact('compras','proveedores','productos'));
    }
}
