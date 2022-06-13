<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoCreateRequest;
use App\Http\Requests\ProductoEditRequest;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;

class ProductoController extends Controller

{
    public function index(Request $request)
    {
        abort_if(Gate::denies('producto_listar'),403);
        $productos = DB::select("SELECT productos.id, productos.unidad, productos.Nombre, categorias.nombre  as nombrecat, Stock, precio, productos.estado FROM productos INNER JOIN categorias ON Categorías = categorias.id");
        
        $minimos=DB::Select("SELECT min(date_format(created_at,'%Y-%m-%d')) as fecha_producto from productos ");
        $maximos=DB::Select("SELECT max(date_format(created_at,'%Y-%m-%d')) as fecha_producto from productos ");
        
        foreach ($minimos as $minimo){$Fecha_minima=$minimo->fecha_producto;}
        foreach ($maximos as $maximo){$Fecha_maxima=$maximo->fecha_producto;}

        return view('productos.index', compact('productos','Fecha_minima', 'Fecha_maxima'));
    }

    /* public function excel()
    {
        $fecha = date("d")."-".date("m")."-".date("Y") ;
        return Excel::download(new ProductosExport, "Productos-$fecha.xlsx");
    } */

    public function excel2(Request $request)
    {
        $method = $request->all();
        $from = $request->input('from');
        $to   = $request->input('to');
        $productos = DB::select("SELECT productos.id, productos.unidad, productos.Nombre, categorias.nombre as nombrecat, Stock, precio, productos.estado FROM productos INNER JOIN categorias ON Categorías = categorias.id where productos.created_at BETWEEN '$from 00:00:00' and '$to 23:00:'");

        $minimos=DB::Select("SELECT min(date_format(created_at,'%Y-%m-%d')) as fecha_producto from productos ");
        $maximos=DB::Select("SELECT max(date_format(created_at,'%Y-%m-%d')) as fecha_producto from productos ");
        
        foreach ($minimos as $minimo){$Fecha_minima=$minimo->fecha_producto;}
        foreach ($maximos as $maximo){$Fecha_maxima=$maximo->fecha_producto;}

        return view('productos.index', compact('productos','Fecha_minima', 'Fecha_maxima'));

    }

    public function create()
    {
        abort_if(Gate::denies('producto_crear'),403);
        $productos = new Producto;
        $categorias = Categoria::all();
        return view('productos.create', compact('productos','categorias'));
    }


    public function store(ProductoCreateRequest $request)
    {
     /* $request->validate([

           'nombre' => 'required|min:4|max:20|unique:categorias'
         ]); */


      Producto::create($request->all());
      return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }


    /* public function show(Producto $producto){
        return view('y.show', compact('user'));
    } */

    public function edit(Producto $producto)
    {
        abort_if(Gate::denies('producto_editar'),403);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto','categorias'));
    }
    public function update(ProductoEditRequest $request,Producto $producto)
    {
        $datos = $request->all();
        $producto->update($datos);
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');

    }
    public function Excel(){
        date_default_timezone_set("America/Bogota");
        $fecha_actual = date("Y-m-d H:i");


        $Desicion=$_POST['Desicion'];

        $Valores = DB:: select("SELECT if( COUNT(DISTINCT(id))>1,1,0) as CONTADOR FROM productos");
        
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=Productos ". $fecha_actual .".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $tabla = "";

        $tabla .="
        <table>
            <thead>
                <tbody>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Fecha</th>
                    </tr>
        ";

        foreach ($Valores as $valores)

        if ($valores->CONTADOR==1){

            if ($Desicion=="Todo"){


                $Productos = DB:: select("select productos.id,CONCAT( productos.Nombre, ' ', productos.unidad) AS nombre, categorias.nombre as categoria, productos.Stock, productos.precio, date_format(productos.created_at,'%Y-%m-%d') as created_at from productos
                join categorias on (productos.Categorías = categorias.id)");

                foreach ($Productos as $producto) {
                    $tabla .="
                        <tr>
                            <td>".$producto->id."</td>
                            <td>".$producto->nombre."</td>
                            <td>".$producto->categoria."</td>
                            <td>".$producto->Stock."</td>
                            <td>".$producto->precio."</td>
                            <td>".$producto->created_at."</td>
                        </tr>
                    ";
                }

                $tabla .="
                        </tbody>
                    </thead>
                </table>
                ";
                echo $tabla;
            }
            else{
                $Fecha_maxima=$_POST['Fecha_maxima'];
                $Fecha_minima=$_POST['Fecha_minima'];

                $Productos = DB:: select("select productos.id,CONCAT( productos.Nombre, ' ', productos.unidad) AS nombre, categorias.nombre as Categoria, productos.Stock, productos.precio, date_format(productos.created_at,'%Y-%m-%d') as created_at from productos
                join categorias on (productos.Categorías = categorias.id)
                
                where date_format(productos.created_at,'%Y-%m-%d') BETWEEN '".$Fecha_minima."' and '".$Fecha_maxima."'");

                foreach ($Productos as $producto) {
                    $tabla .="
                    <tr>
                        <td>".$producto->id."</td>
                        <td>".$producto->nombre."</td>
                        <td>".$producto->categoria."</td>
                        <td>".$producto->Stock."</td>
                        <td>".$producto->precio."</td>
                        <td>".$producto->created_at."</td>
                    </tr>
                    ";
                }

                $tabla .="
                        </tbody>
                    </thead>
                </table>
                ";
                echo $tabla;
            }
        }
        else {
            return redirect('compras')
                ->with('Vacio', ' ');
        }
        // return Excel::download(new ventas, 'Ventas '.$fecha_actual.'.csv');
    }
}

