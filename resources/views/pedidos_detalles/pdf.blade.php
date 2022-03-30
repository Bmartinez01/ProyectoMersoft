<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head >
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title >{{ __('MERSOFT') }}</title>
    </head>
    <body class="{{ $class ?? '' }}">

    <style>
        table{
            text-align:center;
            border-collapse:collapse;
            width:95%;
        }
        th,td{
            border:solid 1px rgba(50, 51, 51, 0.459);
            padding:7px;
        }
        thead{
            background-color: rgb(182, 189, 188);
        }
        
        #cliente{
            margin-left: 271px;
        }
        #client{
            margin-left: 181px;
            margin-top: 8px;
        }
        #tipo{
            margin-left: 336px;
        }
        
    </style>


    @if (count($productos) > 0)
@foreach ($pedido as $pedido )
@foreach ($clientes as $cliente)


<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <form action="{{route('pedidos.update', $pedido->id)}}" method="post" class="form-horizontal">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h3 class="card-title text-dark" align="center"><strong>Pedido</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label for="fecha" class="col-md-1 col-form-label text-dark ">Fecha del Pedido:</label>
                                <label for="cliente" id="cliente" class="col-md-1 col-form-label text-dark control-label asterisco">Cliente:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="{{$pedido->created_at}} " autofocus>
                                    <input type="text" id="client" class="form-control" value="{{$cliente->nombre}} {{$cliente->apellido}}" readonly autofocus>
                                    
                                </div>
                            </div>    
                                    
                            <div class="row">
                                <label for="estado" id="estado" class="col-1 offset-1 col-form-label text-dark control-label asterisco">Estado:</label>
                                <label for="estado" id="tipo" class="col-1 col-form-label text-dark control-label asterisco">Tipo:</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="estado" id="estado" >
                                        @foreach ( $estado as $row )
                                        <option @if ($row->id==$pedido->estado)
                                            selected="true"
                                        @endif

                                         value="{{$row->id}}">{{$row->Estado}}</option>
                                        @endforeach

                                    </select>
                                    <select id="client" class="form-control" name="tipo" id="tipo">
                                        @foreach ( $estado as $row )
                                        <option @if ($row->id==$pedido->tipo)
                                            selected="true"
                                        @endif

                                         value="{{$row->id}}">{{$row->Tipo}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>                              
                            <div class="row">
                            <label for="valor_total" class="col-3 col-form-label control-label asterisco">Valor total: </label>

                                <div class="col-sm-3">
                                    
                                    <input type="text" class="form-control" id="valor_total" value="{{$pedido->valor_total}}" name="valor_total" readonly>

                                    
                                </div>
                            </div>
                            
                            <br><br>                           
                            <div class="table-responsive">
                                <table  id="compras">
                                    <thead class="text-white" id="fondo">
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Valor c/u</th>
                                        <th>Sub Total</th>
                                    </thead>
                                    <tbody id="tblProductos">
                                        @foreach ($productos as $row)
                                        <tr>
                                            <td>{{ $row->Nombre}}</td>
                                            <td>{{ $row->cantidad_c}}</td>
                                            <td>{{ $row->precio}}</td>
                                            <td>{{ $row->precio * $row->cantidad_c}}</td>
                                            
                                        </tr>
                                        @endforeach
                                        @endforeach

                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
     </div>


@endif
</body>

</html>
