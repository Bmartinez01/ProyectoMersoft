<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Compra;
use App\Models\Proveedore;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Role;
use DB;
use Illuminate\Http\Request;

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
}
