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
            margin-left: 294px;
            border:0;
        }
        #clie{
            margin-left: 154px;
            margin-top:9px;
            border:0;
        }
        #pedid{
            border:0;
        }
        #valor{
            border:0;
        }

    </style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h3 align="center">Recibo de venta</h3>
                        </div>
                        <div class="card-body">
                        @foreach ($Venta as $venta)

                            <div class="row">
                            <label for="pedido" > #Pedido :</label>
                            <label for="cliente" id="cliente">Cliente :</label>

                            <div class="col-sm-3">
                                <input type="text" id="pedid" class="form-control" value="{{$venta->pedido_id}}" readonly>
                                <input type="text" id="clie" class="form-control" value="{{$venta->nombre}} {{$venta->apellido}}" readonly>
                            </div>
                            <div class="row offset-md-6">
                                <label for="valor_total"  class="col-2 text-dark col-form-label ">Valor final :</label>
                                <div class="col-sm-3">
                                <input type="text" id="valor" class="form-control" id="valor_total" value="{{$venta->valor_total}}" name="valor_total" readonly>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="table-responsive">
                                <table  id="compras" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                    <thead class="text-white" id="fondo">
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Valor c/u</th>
                                        <th>Sub Total</th>

                                    </thead>
                                    <tbody >
                                    @foreach ($productos as $row)
                                        <tr>

                                            <td>{{ $row->Nombre}} {{$row->unidad}}</td>
                                            <td>{{ $row->cantidad_c}}</td>
                                            <td>{{ $row->precio}}</td>
                                            <td>{{ $row->precio * $row->cantidad_c}}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </div>
</div>
</body>

</html>
