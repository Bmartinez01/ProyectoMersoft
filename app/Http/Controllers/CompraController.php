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

    // public function create()
    // {

    //     $compras = new Compra;
    //     $proveedores = Proveedore::all();
    //     $productos = Producto::all();
    //     return view('compras.create', compact('compras','proveedores','productos'));

    // }

    public function store(Request $request)
    {
    Compra::create($request->except('cantidad', 'producto', 'valor_unitario'));
    $maximo = DB::select('select max(id) as Max_id from compras') ;
        var_dump($maximo[0]->Max_id);
        // Compra_Detalle::create($request->all());

    // $maximo = DB::select('select max(id) from compras');
        // Compra_Detalle::create($request->except('proveedor','recibo'));

  return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');


}

    public function show($id){
        $proveedores = Proveedore::all();
        $productos = Producto::all();
        $compras = Compra::findOrFail($id);
        return view('compras_detalle.index', compact('compras','proveedores','productos'));
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();
        return back()->with('success', 'Compra anulada correctamente');
    }
}
