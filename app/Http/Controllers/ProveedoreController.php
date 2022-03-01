<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorCreateRequest;
use App\Http\Requests\ProveedorEditRequest;
use App\Models\Proveedore;
use Illuminate\Http\Request;


class ProveedoreController extends Controller
{
    
    public function index()
    {
        $proveedores = Proveedore::paginate(5);
        return view('proveedore.index', compact('proveedores'));
    }

    
    public function create()
    {
        return view('proveedore.create');
    }

    
    public function store(ProveedorCreateRequest $request)
    {
       
        Proveedore::create($request->all());

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor creado correctamente');
    }

    

    public function edit(Proveedore $proveedore)
    {

        return view('proveedore.edit', compact('proveedore'));
    }

    
    public function update(ProveedorEditRequest $request, Proveedore $proveedore)
    {
        $datos = $request->all();

        $proveedore->update($datos);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente');
    }

   
}
