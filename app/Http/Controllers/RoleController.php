<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RolCreateRequest;
use App\Http\Requests\RolEditRequest;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rol_listar'),403);
        $roles = Role::paginate();
        $permissions = Permission::all();
        return view('roles.index', compact('roles','permissions'));
    }


    public function create()
    {
        //
        abort_if(Gate::denies('rol_crear'),403);
        $permissions = Permission::all()->pluck('name','id');
        return view('roles.create', compact('permissions'));
    }


    public function store(RolCreateRequest $request)
    {
        //
        $role = Role::create($request->only('name'));
        $role->syncPermissions($request->input('permissions',[]));
        return redirect()->route('roles.index')->with('success','Rol creado correctamente');
    }

        
    public function edit(Role $role)
    {
        abort_if(Gate::denies('rol_editar'),403);
        $permissions = Permission::all()->pluck('name','id');
        $role->load('permissions');
        return view('roles.edit',compact('role','permissions'));

    }


    public function update(RolEditRequest $request, Role $role)
    {
        //
        $datos = $request->all();
        $role->update($datos);
        $role->syncPermissions($request->input('permissions',[]));
        return redirect()->route('roles.index')->with('success','Rol actualizado correctamente');

    }
}
