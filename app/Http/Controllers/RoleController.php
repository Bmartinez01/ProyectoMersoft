<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RolCreateRequest;
use App\Http\Requests\RolEditRequest;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate();
        return view('roles.index', compact('roles'));
    }


    public function create()
    {
        //
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
