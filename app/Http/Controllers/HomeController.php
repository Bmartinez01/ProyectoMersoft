<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuarios=DB::select('SELECT count(*) as c FROM users ');
        $compras=DB::select('SELECT count(*) as c FROM compras ');
        $proveedores=DB::select('SELECT count(*) as c FROM proveedores ');
        $categorias=DB::select('SELECT count(*) as c FROM categorias ');
        $productos=DB::select('SELECT count(*) as c FROM productos ');
        $clientes=DB::select('SELECT count(*) as c FROM clientes ');
        return view('home', compact('usuarios','compras','proveedores','categorias','productos','clientes'));
    }
    // public function show(User $user){

    // }
    // public function update(UserEditRequest $request, User $user){
    //     $data= $request->only("name", "email","telefono","direccion");

    //     $user->update($data);
    //     return response()->json($data);

    //     return redirect()->route('homes',compact('users'))->with('success','Usuario Editado correctamente');
    // }
}
