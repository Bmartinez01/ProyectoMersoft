@extends('layouts.main', ['activePage' => 'compras', 'titlePage' => 'Compras'])
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
                                <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Compras</h4>
                                <p class="card-category text-dark" style="font-size:17px">Compras Registrados</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                               <div id="mensaj" class="alert alert-success" role="success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if (session('error'))
                               <div id="mensaj" class="alert alert-danger" role="danger">
                                    {{ session('error') }}
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-4 text-left mb-3">
                                    {{-- @can('compra_descargar excel')
                                        <a href="{{route('compras.excel')}}" title="Descargar Excel" class="btn btn-sm btn-success" ><i class="material-icons">downloading</i>  Excel</a>
                                    @endcan  --}}
                                    </div>
                                    <div class="col-6 text-left mb-3">
                                    <form action="{{route('compras.excel2')}}" method="POST">
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
                                                    <a href="{{route('compras.index')}}" class="btn btn-sm btn-warning">Regresar</a>
                                                </div>
                                                @can('compra_descargar excel')
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Fecha">Excel
                                                @endcan
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="col-12 text-right">
                                    @can('compra_crear')
                                        <a href="{{route('compras_detalle.create')}}" class="btn btn-sm btn-facebook">Agregar Compra</a>
                                    @endcan
                                    </div>
                                </div>
                                </div>
                                <div class="table-responsive">
                                    <table  id="compras" class="table table-striped table-bordered shadow-lg mt-4" style="width:95%">
                                        <thead class="text-white" id="fondo">
                                            <th>No.</th>
                                            <th>Recibo</th>
                                            <th>Fecha Compra</th>
                                            <th>Proveedor</th>
                                            <th>Valor Total</th>
                                            <th class="text-right">Función</th>
                                        </thead>
                                        <tbody>

                                            <tr>
                                            @foreach ($compras as $compra)
                                                <td>{{ $compra->id}}</td>
                                                <td>{{ $compra->recibo}}</td>
                                                <td>{{ $compra->fecha_compra}}</td>
                                                <td>{{ $compra->nombreprov}} {{$compra->apelliprov}}</td>
                                                <td>{{ $compra->valor_total }}</td>
                                               <td class="td-actions text-right">
                                                @can('compra_descargar pdf')
                                                <a href="{{route('compras.pdf', $compra->id)}}"
                                                    class="btn btn-outline-danger"><span class="material-icons">picture_as_pdf </span></a>
                                                @endcan
                                                @can('compra_ver detalle')
                                                <a href="{{route('compras.show', $compra->id)}}"
                                                    class="btn btn-warning"><span class="material-icons">visibility </span></a>
                                                @endcan
                                                @can('compra_cancelar')
                                                    <form action="{{route('compras.destroy', $compra->id)}}" method="post" style="display: inline-block;" onsubmit="return confirm('¿Está seguro de anular esta compra?')">
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
                                {{-- Modal descargar --}}
                                    <div class="modal fade" id="Fecha" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Filtrado de descarga</h5>
                                                @can('Exportar')
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                @endcan
                                            </div>
                                
                                                @csrf
                                                <div class="modal-body">
                                                <div class="Text-center">
                                                <form action="{{ route('compras_excel')}}" method="post">
                                                    @csrf
                                                    <div class="text-center" >
                                                        <input type="text" hidden name="Desicion" value="Todo">
                                                        <button type="submit" class="btn btn-secondary" >Descargar todo</button>
                                                    </div>
                                                </form>
                                
                                                <form action="{{ route('compras_excel')}}" method="post">
                                                    @csrf
                                                    <label for="">Fecha minima</label>
                                                    <br>
                                                    <input type="date" class="form-control" required name="Fecha_minima" id="Fecha_minima" value="<?php echo $Fecha_minima ?>" min="<?php echo $Fecha_minima ?>" max="<?php echo $Fecha_maxima ?>" >
                                                    <br>
                                                    <label for="">Fecha Maxima</label>
                                                    <br>
                                                    <input type="date" class="form-control" required name="Fecha_maxima" id="Fecha_maxima" value="<?php echo $Fecha_maxima?>" min="<?php echo $Fecha_minima ?>" max="<?php echo $Fecha_maxima ?>" >
                                
                                                    <input type="text" hidden name="Desicion" value="Filtrar">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                {{--------------------------}}

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
    $('#compras').DataTable( {
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
        @can('compra_descargar excel')
        dom: 'Bfrtip',
        dom: '<"top"lBf>rt<"bottom"ip>',
        buttons: [
            {

                extend:'excelHtml5',
                titleAttr: 'Descargar Excel Por Filtro',
                className: 'btn btn-outline-success',
                title: 'Compras',
                filename: 'Compras ' + gettime(),
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
