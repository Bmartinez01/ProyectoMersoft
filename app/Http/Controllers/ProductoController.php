<?php

namespace App\Http\Controllers;

use App\Exports\ProductosExport;
use App\Http\Requests\ProductoCreateRequest;
use App\Http\Requests\ProductoEditRequest;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use phpDocumentor\Reflection\PseudoTypes\True_;

class ProductoController extends Controller

{
    public function index(Request $request)
    {
        abort_if(Gate::denies('producto_listar'),403);
        $productos = DB::select("SELECT productos.id, productos.Nombre, categorias.nombre as nombrecat, Stock, precio, productos.estado FROM productos INNER JOIN categorias ON Categorías = categorias.id");

        return view('productos.index', compact('productos'));
    }

    public function excel()
    {
        $fecha = date("d")."-".date("m")."-".date("Y") ;
        return Excel::download(new ProductosExport, "Productos-$fecha.xlsx");
    }

    public function excel2(Request $request)
    {
        $method = $request->all();
        $from = $request->input('from');
        $to   = $request->input('to');
        $productos = DB::select("SELECT productos.id, Código, productos.Nombre, categorias.nombre as nombrecat, Stock, precio, productos.estado FROM productos INNER JOIN categorias ON Categorías = categorias.id WHERE productos.created_at BETWEEN '$from 00:00:00' AND '$to 23:00:00'");

        return view('productos.index', compact('productos'));

    }

    public function create()
    {
        abort_if(Gate::denies('producto_crear'),403);
        $productos = new Producto;
        $categorias = Categoria::all();
        return view('productos.create', compact('productos','categorias'));
    }


    public function store(ProductoCreateRequest $request)
    {
     /* $request->validate([

           'nombre' => 'required|min:4|max:20|unique:categorias'
         ]); */


      Producto::create($request->all());
      return redirect()->route('productos.index')->with('success', 'Poducto creada correctamente');
    }


    /* public function show(Producto $producto){
        return view('y.show', compact('user'));
    } */

    public function edit(Producto $producto)
    {
        abort_if(Gate::denies('producto_editar'),403);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto','categorias'));
    }
    public function update(ProductoEditRequest $request,Producto $producto)
    {
        $datos = $request->all();
        $producto->update($datos);
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');

    }
    public function search()
    {

    }
}

