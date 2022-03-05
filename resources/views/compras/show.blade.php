@extends('layouts.main', ['activePage' => 'compras', 'titlePage' => 'Compras'])
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" >

<div class="row">
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Recibo</th>
                    <th>Fecha Compra</th>
                    <th>Proveedor</th>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Valor c/u</th>
                    <th>Valor Total</th>
                    <th>Funciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)


                                                <tr>

                                                    <td>{{ $compra->id}}</td>
                                                    <td>{{ $compra->recibo}}</td>
                                                    <td>{{ $compra->created_at}}</td>
                                                    @foreach ($proveedores as $row)
                                                    @if ($compra->proveedor==$row->id)
                                                    <td>{{ $row->nombre }}</td>
                                                    @endif
                                                    @endforeach
                                                    <td>{{ $compra->cantidad }}</td>
                                                    @foreach ($productos as $row)
                                                    @if ($compra->producto==$row->id)
                                                    <td>{{ $row->Nombre }}</td>
                                                    @endif
                                                    @endforeach
                                                    @foreach ($productos as $row)
                                                    @if ($compra->producto==$row->id)
                                                    <td>{{$row->precio}}</td>
                                                    @endif
                                                    @endforeach
                                                    <td>{{ $compra->valor_total }}</td>
                                                   <td>
                                                    <a href="{{route('compras.create')}}" onclick="return confirm('Estás seguro que deseas eliminar el registro?');">Eliminar registro</a>
                                                   </td>
                                                    @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
