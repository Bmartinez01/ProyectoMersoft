@extends('layouts.main', ['activePage' => 'ventas', 'titlePage' => 'Ventas'])
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
                                <h4 class="card-title text-dark"><strong>Ventas</strong></h4>
                                <p class="card-category text-dark">Ventas Registradas</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                               <div id="mensaj" class="alert alert-success" role="success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class="row">


                                </div>
                                <div class="table-responsive">
                                    <table  id="ventas" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                        <thead class="text-white" id="fondo">

                                            <th>#id</th>
                                            <th>#Pedido</th>
                                            <th>Fecha Venta</th>
                                            <th>Cliente</th>
                                            <th>Valor Total</th>

                                            <th class="text-left">Función</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($ventas as $venta)

                                                    <td>{{ $venta->id}}</td>
                                                    <td>{{ $venta->pedido_id}}</td>
                                                    <td>{{ $venta->created_at}}</td>
                                                    <td>{{ $venta->nombre}} {{$venta->apellido}}</td>
                                                    <td>{{ $venta->valor_total}}</td>


                                                    <td class="td-actions text-left">

                                                    @can('venta_ver detalle')
                                                    <a href="{{route('ventas.show', $venta->id)}}"
                                                            class="btn btn-warning"><span class="material-icons">visibility </span></a>

                                                    @endcan
                                                    @can('venta_descargar recibo')
                                                    <a href="{{route('ventas.pdf', $venta->id)}}"

                                                            class="btn btn-outline-danger"><span class="material-icons">picture_as_pdf </span></a>
                                                    </td>
                                                    @endcan


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
    $('#ventas').DataTable( {
        "language": {
            "lengthMenu": "Mostrar "+
                `<select>
                    <option value='5'>5</option>
                    <option value='10'>10</option>
                    <option value='15'>15</option>
                    <option value='20'>20</option>
                    <option value='-1'>Todos</option>
                </select>`+
                " registros por pagina",
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
