@extends('layouts.main', ['activePage' => 'compras', 'titlePage' => 'Compras'])
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" >
@endsection
@section('content')
@if (count($productos) > 0)
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Compras</h4>
                            <p class="card-category text-dark" style="font-size:17px">Detalle de Compras</p>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                           <div class="alert alert-success" role="success">
                                {{ session('success') }}
                            </div>
                            @endif
                            @foreach ($compras as $compra)
                            <div class="card-body">

                                <div class="row">
                                    <label for="recibo" class="col-sm-1 col-form-label control-label ">Recibo</label>
                                    <div class="col-sm-3">

                                    <input type="text" class="form-control" value="{{$compra->recibo}}" readonly>

                                </div>

                                <label for="proveedor"  class="col-sm-2 col-form-label offset-3 text-dark control-label ">Proveedor</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="{{$compra->nombre}} {{$compra->apellido}}" readonly>
                            </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        <div class="row">
                            <label for="fecha_compra" class="col-sm-1 col-form-label control-label">Fecha Compra</label>
                                    <div class="col-sm-3">
                                    <input type="text" class="form-control" name="fecha_compra" readonly value="{{$compra->fecha_compra}}">
                                </div>
                                <label for="" class="col-sm-1 offset-4 col-form-label control-label">Iva</label>
                                <div class="col-sm-3">
                                <input type="number" class="form-control" id="iva" value="{{$compra->iva}}" name="valor_total" readonly>
                              </div>
                                <label for="valor_total" class="col-sm-1 offset-4 col-form-label control-label">Valor Total</label>
                                <div class="col-sm-3">
                                <input type="number" class="form-control" id="valor_total" value="{{$compra->valor_total}}" name="valor_total" step="0.01" readonly>


                            </div>

                    </div>
                    @endforeach
                            <div class="table-responsive">
                                <table  id="compras" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                    <thead class="text-white" id="fondo">
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

                                    </tbody>
                                </table>
                                <div class="card-footer ml-auto mr-auto col-md-3">
                                    <div class="">
                                        <a href="{{route('compras.index')}}" class="btn btn-facebook">Regresar</a>
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
</div>
@endif
@endsection
