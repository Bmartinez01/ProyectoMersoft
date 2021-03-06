<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(){
        abort_if(Gate::denies('usuario_listar'),403);
        $users=User::paginate(5);
        return view('users.index', compact('users'));
    }


    public function create(){
        abort_if(Gate::denies('usuario_crear'),403);
        $roles = Role::all()->pluck('name','id');
        return view('users.create', compact('roles'));
    }

    public function store(UserCreateRequest $request){
        $user = User::create($request->Only('name','email','telefono','direccion')
    +[
        'password'=> bcrypt($request->input('password')),
    ]);
        $roles = $request->input('roles',[]);
        $user->syncRoles($roles);
        return redirect()->route('users.index')->with('success','Usuario creado correctamente');

    }

    public function show(User $user){
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('usuario_editar'),403);
        $roles = Role::all()->pluck('name','id');
        $user->load('roles');
        return view('users.edit', compact('user','roles'));

    }

    public function update(UserEditRequest $request, user $user){


        $data= $request->only('name', 'email','telefono','direccion','estado');
        $password=$request->input('password');

        if($password)
            $data['password']=bcrypt($password);


        $user->update($data);

        $roles = $request->input('roles',[]);
        $user->syncRoles($roles);
        return redirect()->route('users.index')->with('success','Usuario Editado correctamente');
    }


}
