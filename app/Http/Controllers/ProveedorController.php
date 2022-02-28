<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Requests\ProveedorCreateRequest;
use App\Http\Requests\ProveedorEditRequest;

class ProveedorController extends Controller
{
    //
    public function index()
    {
        $proveedores = Proveedor::paginate();
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(ProveedorCreateRequest $request)
    {
     /* $request->validate([

           'nombre' => 'required|min:4|max:20|unique:categorias'
         ]); */
    
        
      Proveedor::create($request->all());
      return redirect()->route('proveedores.index')->with('success', 'Proveedor creado correctamente');
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));

    }
    public function update(ProveedorEditRequest $request,Proveedor $proveedor)
    {
        $datos = $request->all();
        $proveedor->update($datos);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente');

    }
}
