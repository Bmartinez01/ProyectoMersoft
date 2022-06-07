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
            width:100%;
        }
        th,td{
            border:solid 1px black;
            padding:8px;
        }
        thead{
            background-color: rgb(182, 189, 188);
        }
        tr:nth-child(even){
            background-color: rgba(211, 211, 203, 0.4);
        }
        #provee{
            margin-left: 301px;
            border:0;
        }
        #prove{
            margin-left: 151px;
            margin-top: 8px;
            border:0;

        }
        #valor{
            margin-left: 252px;
        }
        #iva{
            margin-left: 2px;
            border:0;
        }
        #reci{
            border:0;
        }
    </style>


@if (count($productos) > 0)
<div class="container">
    <div class="container-fluid ">
        <div class="row ">
        <div class="col-md-12  ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info ">
                            <h3 align="center"><strong>Detalle de la Compra</strong></h3>
                        </div>
                        <br>
                        @foreach ($compras as $compra)
                        <div class="row">

                            <label for="recibo"  class="col-sm-1  ">Recibo:</label>
                            <label for="proveedor" id="provee" class="col-sm-2 ">Proveedor:</label>

                            <div class="col-sm-3">
                                <input type="text" id="reci" class="form-control" value="{{$compra->recibo}}">
                                <input type="text" id="prove" class="form-control" value="{{$compra->nombre}} {{$compra->apellido}}" >

                            </div>


                            <label for="fecha_compra" class="col-sm-1 ">Fecha Compra:</label>
                            <label for="valor_total" id="valor" class="col-sm-2 ">Valor Total:</label>
                            <div class="col-sm-3">
                                <input type="text" id="reci" class="form-control" name="fecha_compra"  value="{{$compra->fecha_compra}}">
                                <input type="text" id="prove" class="form-control" id="valor_total" value="{{$compra->valor_total}}" name="valor_total" step="0.01" >

                            </div>

                            <label for="" class="col-sm-1 ">Iva:</label>
                            <div class="col-sm-3"> @if($compra->iva==null)

                                <input type="text" class="form-control" id="iva" value="0" name="valor_total" >

                            @else
                                <input type="text" class="form-control" id="iva" value="{{$compra->iva}}" name="valor_total" >
                              @endif

                            <br><br><br>
                            </div>
                            <div>
                            @endforeach
                                <table>
                                    <thead>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Valor c/u</th>
                                        <th>Sub Total</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($productos as $row)
                                        <tr>
                                            <td>{{ $row->Nombre}} {{$row->unidad}}</td>
                                            <td>{{ $row->cantidad_c}}</td>
                                            <td>{{ $row->precios}}</td>
                                            <td>{{ $row->precios * $row->cantidad_c}}</td>
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
        </div>
    </div>
</div>
@endif


    </body>

</html>
