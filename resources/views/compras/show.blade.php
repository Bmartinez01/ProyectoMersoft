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
                            <h4 class="card-title text-dark"><strong>Compras</strong></h4>
                            <p class="card-category text-dark">Detalle de Compras</p>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                           <div class="alert alert-success" role="success">
                                {{ session('success') }}
                            </div>
                            @endif
                            <div class="card-body">
                                <div class="row">
                                    <label for="recibo" class="col-sm-1 col-form-label control-label asterisco">Recibo</label>
                                    <div class="col-sm-3">
                                    <input type="text" class="form-control" value="0" autofocus>
                                    @if ($errors->has('recibo'))
                                    <span class="error text-danger" for="input-recibo">{{ $errors->first('recibo') }}</span>
                                    @endif
                                </div>
                                <label for="proveedor"  class="col-sm-2 col-form-label offset-3 text-dark control-label asterisco">Proveedor</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="proveedor" autofocus>
                                    @if ($errors->has('proveedor'))
                                    <span class="error text-danger" for="input-proveedor">{{ $errors->first('proveedor') }}</span>
                                    @endif
                            </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        <div class="row">
                            <label for="fecha_compra" class="col-sm-1 col-form-label control-label asterisco">Fecha Compra</label>
                                    <div class="col-sm-3">
                                    <input type="text" class="form-control" name="fecha_compra" placeholder="Ingrese la fecha de la compra" value="{{$compras}}" autofocus>
                                    @if ($errors->has('fecha_compra'))
                                    <span class="error text-danger" for="input-fecha_compra">{{ $errors->first('fecha_compra') }}</span>
                                    @endif
                                </div>
                                <label for="valor_total" class="col-sm-2 offset-3 col-form-label control-label asterisco">Valor Total</label>
                                <div class="col-sm-3">
                                <input type="number" class="form-control" id="valor_total" name="valor_total" step="0.01" readonly>
                                </div>
                    </div>
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
    </div>
</div>
@endif
@endsection
