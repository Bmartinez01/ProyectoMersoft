<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoCreateRequest;
use App\Http\Requests\ProductoEditRequest;
use App\Models\Producto;
use Illuminate\Http\Request;


class ProductoController extends Controller

{
    public function index()
    {
        $productos = Producto::paginate();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {

        return view('productos.create');
    }

   
    public function store(ProductoCreateRequest $request)
    {
     /* $request->validate([

           'nombre' => 'required|min:4|max:20|unique:categorias'
         ]); */
    
        
      Producto::create($request->all());
      return redirect()->route('productos.index')->with('success', 'Categoria creada correctamente');
    }


    public function show(Producto $producto){
        return view('y.show', compact('user'));
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));

    }
    public function update(ProductoEditRequest $request,Producto $producto)
    {
        $datos = $request->all();
        $producto->update($datos);
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');

    }
}

