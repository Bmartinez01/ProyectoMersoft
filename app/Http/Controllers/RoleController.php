<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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
        return view('roles.create');
    }


    public function store(RolCreateRequest $request)
    {
        //
        Role::create($request->all());
        return redirect()->route('roles.index')->with('success','Rol creado correctamente');
    }

        
    public function edit(Role $role)
    {
        return view('roles.edit',compact('role'));

    }


    public function update(RolEditRequest $request, Role $role)
    {
        //
        $datos = $request->all();
        $role->update($datos);
        return redirect()->route('roles.index')->with('success','Rol actualizado correctamente');

    }
}
