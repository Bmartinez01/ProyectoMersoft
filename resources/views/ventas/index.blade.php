@extends('layouts.main', ['activePage' => 'ventas', 'titlePage' => 'ventas'])
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" >
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
                                    <table  id="Venta" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                        <thead class="text-white" id="fondo">
                                            <th>pedido_id</th>
                                            <th>fecha_venta</th>
                                            <th>fecha_dev</th>
                                            <th>Cliente</th>
                                            <th>valor_inicial</th>
                                            <th>valor_dev</th>
                                            <th>Valor Total</th>
                                            <th class="text-right">Función</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($ventas as $venta)

                                                    <td>{{ $venta->pedido_id}}</td>
                                                    <td>{{ $venta->created_at}}</td>
                                                    <td>{{$venta->updated_at}}</td>
                                                    <td>{{ $venta->cliente }}</td>
                                                    <td>{{ $venta->valor_inicial}}</td>
                                                    <td>{{ $venta->valor_dev}}</td>
                                                    <td>{{ $venta->valor_total}}</td>
                                                    <td class="td-actions text-right">

                                                       
                                                        @can('pedido_ver detalle')
                                                           <a href="#"
                                                            class="btn btn-warning"><span class="material-icons">visibility </span></a>
                                                        @endcan

                                                    </td>


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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#Venta').DataTable( {
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
