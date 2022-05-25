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
        
        #estado{
            margin-left: 294px;
            border:0;
        }
        #estad{
            margin-left: 145px;
            margin-top:9px;
            border:0;
        }
        #clien{
            border:0;
        }
        #valor{
            border:0;
        }
        
    </style>

@if (count($productos) > 0)

<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info ">
                            <h3 align="center"><strong>Detalle de la venta</strong></h3>
                        </div>
                        <div class="card-body">
                        @foreach ($Venta as $venta)

                            <div class="row">
                                <label for="cliente"  class="col-md-1 col-form-label text-dark control-label asterisco">Cliente:</label>
                                <label for="estado" id="estado" class="col-1 offset-1 col-form-label text-dark control-label asterisco">Estado: </label>

                                <div class="col-sm-3">
                                    <input type="text" id="clien" class="form-control" value="{{$pedido->nombre}} {{$pedido->apellido}}" readonly>
                                    <input type="text" id="estad" class="form-control" value="{{($pedido->estado)}}" readonly >

                                </div>
                                
                            </div>
                            <div class="row offset-md-5">
                                <label for="valor_total" class="col-3 col-form-label control-label asterisco">Valor final: </label>
                                <div class="col-sm-5">
                                <input type="text" id="valor" class="form-control" id="valor_total" value="{{$pedido->valor_total}}" name="valor_total" readonly>
                                </div>
                            </div>
                            <br>
                            
                            <br>
                            <br>
                            @endforeach

                            <div class="table-responsive">
                                <table  id="compras" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                    <thead class="text-white" id="fondo">
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Valor c/u</th>
                                        <th>Sub Total</th>

                                    </thead>
                                    <tbody >
                                    <tr>
                                        @foreach ($productos as $row)
                                            <td>{{ $row->Nombre}}</td>
                                            <td>{{ $row->cantidad_c}}</td>
                                            <td>{{ $row->precio}}</td>
                                            <td>{{ $row->precio * $row->cantidad_c}}</td>

                                        </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>

                           
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
     </div>


@endif    
</body>

</html>
