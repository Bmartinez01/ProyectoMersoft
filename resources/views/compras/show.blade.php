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
