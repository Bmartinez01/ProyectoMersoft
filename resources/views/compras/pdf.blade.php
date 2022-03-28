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
            padding:15px;
        }
        thead{
            background-color: #5e5e5e
        }
        tr:nth-child(even){
            background-color: #000000;
        }
        #provee{
            margin-left: 280px;           
        }
        #prove{
            margin-left: 120px;
            margin-top: 8px;           
        }
        #valor{
            margin-left: 225px;           
        }
    </style>
      
            
@if (count($productos) > 0)
@foreach ($compras as $compra )
@foreach ($proveedores as $proveedor )
<div class="container">
    <div class="container-fluid ">
        <div class="row ">
        <div class="col-md-12  ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info ">
                            <h2><strong>Detalle de la Compra</strong></h2>
                        </div>
                        
                        <div class="row">
                           
                            <label for="recibo"  class="col-sm-1 col-form-label control-label ">Recibo</label>
                            <label for="proveedor" id="provee" class="col-sm-2 col-form-label offset-3 text-dark control-label ">Proveedor</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" value="{{$compra->recibo}}">  
                                <input type="text" id="prove" class="form-control" value="{{$proveedor->nombre}} {{$proveedor->apellido}}" >

                            </div>
                            
                            
                            <label for="fecha_compra" class="col-sm-1 col-form-label control-label">Fecha Compra</label>
                            <label for="valor_total" id="valor" class="col-sm-2 offset-3 col-form-label control-label">Valor Total</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="fecha_compra"  value="{{$compra->fecha_compra}}">
                                <input type="text" id="prove" class="form-control" id="valor_total" value="{{$compra->valor_total}}" name="valor_total" step="0.01" >

                            </div>
                           
                            <label for="" class="col-sm-1 offset-3 col-form-label control-label">Iva</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="iva" value="{{$compra->iva}}" name="valor_total" >
                            <br><br><br>
                            </div>
                            <div>
                                <table>
                                    <thead>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Valor c/u</th>
                                        <th>Sub Total</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($productos as $row)
                                            <td>{{ $row->Nombre}}</td>
                                            <td>{{ $row->cantidad_c}}</td>
                                            <td>{{ $row->precios}}</td>
                                            <td>{{ $row->precios * $row->cantidad_c}}</td>
                                        </tr>
                                     @endforeach
                                     @endforeach
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