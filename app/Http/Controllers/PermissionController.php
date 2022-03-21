<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionEditRequest;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('permiso_listar'),403);
        $permissions = Permission::paginate();
        return view('permissions.index', compact('permissions'));
    }


    public function create()
    {
        //
        abort_if(Gate::denies('permiso_crear'),403);
        return view('permissions.create');
    }


    public function store(PermissionCreateRequest $request)
    {
        //
        Permission::create($request->all());
        return redirect()->route('permissions.index')->with('success','Permiso creado correctamente');
    }

        
    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permiso_editar'),403);
        return view('permissions.edit',compact('permission'));

    }


    public function update(PermissionEditRequest $request, Permission $permission)
    {
        //
        $datos = $request->all();
        $permission->update($datos);
        return redirect()->route('permissions.index')->with('success','Permiso actualizado correctamente');

    }
  
}
