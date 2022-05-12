@extends('layouts.main', ['activePage' => 'pedidos', 'titlePage' => 'Pedidos'])
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
                                <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Pedidos</h4>
                                <p class="card-category text-dark" style="font-size:17px">Pedidos Registrados</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                               <div id="mensaj" class="alert alert-success" role="success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class="row">
                                <div class="col-4 text-left mb-3">
                                    {{-- @can('pedido_descargar excel')
                                        <a href="{{route('pedidos.excel')}}" title="Descargar Excel" class="btn btn-sm btn-success" ><i class="material-icons">downloading</i>  Excel</a>
                                    @endcan --}}
                                    </div>
                                    <div class="col-6 text-left mb-3">
                                    <form action="{{route('pedidos.excel2')}}" method="POST">
                                        @csrf
                                        <div class="container">
                                            <div class="row">
                                                <label for="from" class="col-form-label">Desde</label>
                                                <div class="col-md-2">
                                                    <input type="date" class="form-control input-sm" id="from" name="from"  max="<?= date('Y-m-d'); ?>">
                                                </div>
                                                <label for="from" class="col-form-label">Hasta</label>
                                                <div class="col-md-2">
                                                    <input type="date" class="form-control input-sm" id="to" name="to"  max="<?= date('Y-m-d'); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-outline-dark btn-sm" name="search" ><i class="material-icons">search</i></button>
                                                    <a href="{{route('pedidos.index')}}" class="btn btn-sm btn-warning">Regresar</a>

                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="col-12 text-right">
                                    @can('pedido_crear')
                                        <a href="{{route('pedidos_detalles.create')}}" class="btn btn-sm btn-facebook">Agregar Pedido</a>
                                    @endcan
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
                                                    <td>{{ $pedido->nombclient}} {{$pedido->apellclient}}</td>
                                                    <td>{{ $pedido->valor_total }}</td>
                                                    <td>{{ $pedido->tipoEst}}</td>
                                                    <td>{{ $pedido->estadoEst}}</td>
                                                    <td class="td-actions text-right">
                                                        @can('pedido_descargar pdf')
                                                        <a href="{{ route('pedidos_detalles.pdf', $pedido->id) }}"
                                                        class="btn btn-outline-danger"><span class="material-icons">picture_as_pdf </span></a>
                                                        @endcan
                                                        @can('pedido_editar')
                                                        <a href="{{ route('pedidos.edit', $pedido->id) }}"
                                                           class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                        @endcan
                                                        @can('pedido_ver detalle')
                                                           <a href="{{route('pedidos.show', $pedido->id)}}"
                                                            class="btn btn-warning"><span class="material-icons">visibility </span></a>
                                                        @endcan
                                                        @can('pedido_cancelar')
                                                        <form action="{{route('pedidos.destroy', $pedido->id)}}" method="post" style="display: inline-block;" onsubmit="return confirm('¿Está seguro de cancelar este pedido?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        </form>
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
    function gettime()
    {
        var date = new Date();
        // var newdate = (date.getHours() % 12 || 12) + "_" + date.getDay() + "_" + date.getSeconds();
        var newdate = date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear();
        //setInterval(gettime, 1000);
        return newdate;
    }
    $('#Pedido').DataTable( {
        "language": {
            "lengthMenu": "Mostrar "+
                `<select>
                    <option value='5'>5</option>
                    <option value='10'>10</option>
                    <option value='15'>15</option>
                    <option value='20'>20</option>
                    <option value='-1'>Todos</option>
                </select>`+
                `<span class= "mr-5">registros por pagina</span>`,
            "zeroRecords": "No se encontraron datos",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar: ",
            "paginate": {
                "next":"Siguiente",
                "previous":"Anterior"
            }
        },
        @can('pedido_descargar excel')
        dom: 'Bfrtip',
        dom: '<"top"lBf>rt<"bottom"ip>',
        buttons: [
            {
                extend:'excelHtml5',
                titleAttr: 'Descargar Excel Por Filtro',
                className: 'btn btn-outline-success',
                title: 'Pedidos',
                filename: 'Pedidos ' + gettime(),
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }
            // /* 'copy', 'csv', */ 'excel'/* , 'pdf', 'print' */
        ]
        @endcan
    } );
    } );
    </script>
    @endsection

@endsection
