<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorCreateRequest;
use App\Http\Requests\ProveedorEditRequest;
use App\Models\Proveedore;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProveedoreController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('proveedore_index'),403);
        $proveedores = Proveedore::paginate();
        $categorias = Categoria::all();
        return view('proveedore.index', compact('proveedores','categorias'));
    }

    
    public function create()
    {
        abort_if(Gate::denies('proveedore_create'),403);
        $proveedores = new Proveedore;
        $categorias = Categoria::all();
        return view('proveedore.create', compact('proveedores','categorias'));
    }

    
    public function store(ProveedorCreateRequest $request)
    {
       
        Proveedore::create($request->all());

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor creado correctamente');
    }

    

    public function edit(Proveedore $proveedore)
    {
        abort_if(Gate::denies('edit_index'),403);
        $categorias = Categoria::all();
        return view('proveedore.edit', compact('proveedore','categorias'));
    }

    
    public function update(ProveedorEditRequest $request, Proveedore $proveedore)
    {
        $datos = $request->all();

        $proveedore->update($datos);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente');
    }

   
}
