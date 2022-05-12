@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Menú')])

@section('content')
  <div class="content">
    <div class="container-fluid  text-center">
      <div class="row">
        @foreach ($usuarios as $usuario)
        <div class="card col-md-3  bg-danger py-6 " id="left">
            <h1><i class="material-icons">person</i></h1>
                <h4 class="">Usuarios registrados</h4>
             {{-- <input type="text" value="{{$usuario->c}}" disabled> --}}

             <span class="h3 " id="board"> {{$usuario->c}} </span>
            </div>
            @endforeach
            @foreach ($compras as $compra)
            <div class="card col-md-3  offset-1 bg-primary">
                <h1><i class="material-icons">shopping_basket</i></h1>
                    <h4>Compras registradas</h4>
                    <span class="h3"  id="board"> {{$compra->c}} </span>
                </div>
                @endforeach

                @foreach ($proveedores as $proveedor)
        <div class="card col-md-3 offset-1 bg-success">
            <h1><i class="material-icons">settings_accessibility</i></h1>
                <h4>Proveedores registrados</h4>
                <span class="h3"  id="board"> {{$proveedor->c}} </span>
            </div>
            @endforeach
            @foreach ($categorias as $categoria)
            <div class="card col-md-3 align-self bg-info left" id="ling" >
                <h1><i class="material-icons">receipt_long</i></h1>
                    <h4>Categorìas registradas</h4>
                    <span class="h3"  id="board"> {{$categoria->c}} </span>
                </div>
                @endforeach
                @foreach ($productos as $producto)
                <div class="card col-md-3 py-6  offset-1 bg-warning" id="ling">
                    <h1><i class="material-icons">view_in_ar</i></h1>
                        <h4>Productos registrados</h4>
                        <span class="h3"  id="board"> {{$producto->c}} </span>
                    </div>
                    @endforeach
                    @foreach ($clientes as $cliente)
                    <div class="card col-md-3  offset-1 bg-secondary" id="ling">
                        <h1><i class="material-icons">supervisor_account</i></h1>
                            <h4>Cientes registrados</h4>
                            <span class="h3"  id="board"> {{$cliente->c}} </span>
                        </div>
                        @endforeach




    </div>
    </div>
  </div>
@endsection
