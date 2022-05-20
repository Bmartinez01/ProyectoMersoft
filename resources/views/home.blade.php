@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Menú')])

@section('content')
  <div class="content">
    <div class="container-fluid  text-center">
      <div class="row">
        @foreach ($usuarios as $usuario)
        @can('usuario_listar')
        <div class="col-md-3" id="left">
            <div class="card">
                <div class="card-header card-header-icon card-header-danger">
                  <div class="card-icon">
                    <h1><i class="material-icons">person</i></h1>
                  </div>
                </div>
                <br>
                <h4 class="">Usuarios registrados</h4>
                <span class="h2 " id="board"> {{$usuario->c}} </span>
            </div>
        </div>
        @endcan
        @endforeach


        <div class="col-md-3" id="left">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                  <div class="card-icon">
                    <h1><i class="material-icons">shopping_basket</i></h1>
                  </div>
                </div>
                @foreach ($compras as $compra)
                <br>
                <h4>Compras registradas</h4>
                <span class="h2"  id="board"> {{$compra->c}} </span>
                @endforeach
            </div>
        </div>

        <div class="col-md-3" id="left">
            <div class="card">
                <div class="card-header card-header-icon card-header-success">
                  <div class="card-icon">
                    <h1><i class="material-icons">settings_accessibility</i></h1>
                  </div>
                </div>
                @foreach ($proveedores as $proveedor)
                <br>
                <h4>Proveedores registrados</h4>
                <span class="h2"  id="board"> {{$proveedor->c}} </span>
                @endforeach
            </div>
        </div>

        <div class="col-md-3" id="left">
            <div class="card">
                <div class="card-header card-header-icon card-header-info">
                  <div class="card-icon">
                    <h1><i class="material-icons">receipt_long</i></h1>
                  </div>
                </div>
                @foreach ($categorias as $categoria)
                <br>
                <h4>Categorìas registradas</h4>
                <span class="h2"  id="board"> {{$categoria->c}} </span>
                @endforeach
            </div>
        </div>

        <div class="col-md-3" id="left">
            <div class="card">
                <div class="card-header card-header-icon card-header-warning">
                  <div class="card-icon">
                    <h1><i class="material-icons">view_in_ar</i></h1>
                  </div>
                </div>
                @foreach ($productos as $producto)
                <br>
                <h4>Productos registrados</h4>
                <span class="h2"  id="board"> {{$producto->c}} </span>
                @endforeach
            </div>
        </div>


        <div class="col-md-3" id="left">
            <div class="card">
                <div class="card-header card-header-icon card-header-secondary">
                  <div class="card-icon">
                    <h1><i class="material-icons">supervisor_account</i></h1>
                  </div>
                </div>
                @foreach ($clientes as $cliente)
                <br>
                <h4>Cientes registrados</h4>
                <span class="h2"  id="board"> {{$cliente->c}} </span>
                @endforeach
            </div>
        </div>
    </div>
    </div>
  </div>
@endsection
