@extends('layouts.main', ['activePage' => 'pedidos', 'titlePage' => 'Pedidos'])
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" >
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-info">
                                <h4 class="card-title text-dark"><strong>Pedidos</strong></h4>
                                <p class="card-category text-dark">Pedidos Registrados</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                               <div id="mensaj" class="alert alert-success" role="success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="{{route('pedidos_detalles.create')}}" class="btn btn-sm btn-facebook">Agregar Pedido</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table  id="Pedido" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                        <thead class="text-white" id="fondo">

                                            <th>#Pedido</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Valor Total</th>
                                            <th>Tipo</th>
                                            <th>Estado</th>
                                            <th class="text-right">Función</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($pedidos as $pedido)



                                                    <td>{{ $pedido->id}}</td>
                                                    <td>{{ $pedido->created_at}}</td>
                                                    @foreach ($clientes as $row)
                                                    @if ($pedido->cliente==$row->id)
                                                    <td>{{ $row->nombre}} {{$row->apellido}}</td>
                                                    @endif
                                                    @endforeach
                                                    <td>{{ $pedido->valor_total }}</td>
                                                    @foreach ($estados as $row)
                                                    @if ($pedido->estado==$row->id)
                                                    <td>{{$row->Tipo}}</td>
                                                    <td>{{ $row->Estado}}</td>
                                                    @endif
                                                    @endforeach

                                                    <td>
                                                        <a href="{{ route('pedidos_detalles.pdf', $pedido->id) }}"
                                                        class="btn btn-outline-danger"><span class="material-icons">picture_as_pdf </span></a>
                                                        <a href="{{ route('pedidos_detalles.edit', $pedido->id) }}"
                                                           class="btn btn-warning"><i class="material-icons">edit</i></a>

                                                        <form action="{{route('pedidos.destroy', $pedido->id)}}" method="post" style="display: inline-block;" onsubmit="return confirm('¿Está seguro de cancelar este pedido?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </form></td>
                                                {{-- <td class="td-actions text-right">
                                                @if ($compra->estado==1)
                                                <button type="button" class="btn btn-success btn-sm">
                                                    Activo
                                                </button>

                                                @else
                                                <button type="button" class="btn btn-danger btn-sm">
                                                    Inactivo
                                                </button>

                                                @endif
                                               </td> --}}

                                            </tr>
                                            <!-- javascript init -->

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
    @section('script')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#Pedido').DataTable( {
            "language": {
                "lengthMenu": "Mostrar  _MENU_  registros por pagina",
                "zeroRecords": "No se encontraron datos",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar: ",
                "paginate": {
                    "next":"Siguiente",
                    "previous":"Anterior"
                }
            }
        } );
    } );
    </script>
    @endsection

@endsection
