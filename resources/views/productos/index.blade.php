@extends('layouts.main', ['activePage' => 'productos', 'titlePage' => 'Productos'])
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" >

@endsection
@section('content')
<style>


</style>
<div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-info">
                                <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Productos</h4>
                                <p class="card-category text-dark" style="font-size:17px">Productos Registrados</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                <div id="mensaj" class="alert alert-success alert-dismissible" role="success">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hiddzen="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-2 text-left mb-3">
                                    @can('producto_descargar excel')
                                        <a href="{{route('productos.excel')}}" title="Descargar Excel Completo" class="btn btn-sm btn-success" ><i class="material-icons">downloading</i>  Excel</a>
                                    @endcan
                                    </div>
                                    <div class="col-10 text-left mb-3">
                                    <form action="{{route('productos.excel2')}}" method="POST">
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
                                                    <a href="{{route('productos.index')}}" class="btn btn-sm btn-warning">Regresar</a>

                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="col-12 text-right">
                                    @can('producto_crear')
                                        <a href="{{route('productos.create')}}" class="btn btn-sm btn-facebook">Agregar productos</a>
                                    @endcan
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table  id="productos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                        <thead class="text-white" id="fondo">

                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Categorías</th>
                                            <th>Stock</th>
                                            <th>precio</th>
                                            <th>Estado</th>
                                            <th class="text-right">Funciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($productos as $Producto)
                                            <tr>
                                                <td>{{ $Producto->Código}}</td>
                                                <td>{{ $Producto->Nombre }}</td>
                                                <td>{{ $Producto->nombrecat}}</td>
                                                <td>{{ $Producto->Stock}}</td>
                                                <td>{{ $Producto->precio}}</td>
                                                <td class="td-actions text-right">
                                                @if ($Producto->estado==1)
                                                <button type="button" class="btn btn-success btn-sm">
                                                    Activo
                                                </button>

                                                @else
                                                <button type="button" class="btn btn-danger btn-sm">
                                                    Inactivo
                                                </button>

                                                @endif
                                               </td>
                                               <td class="td-actions text-right">
                                               @can('producto_editar')
                                                 <a href="{{ route('productos.edit', $Producto->id) }}"
                                                    class="btn btn-warning"><i class="material-icons">edit</i></a>
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
    $('#productos').DataTable( {
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
        },
        dom: 'Bfrtip',
        //  "dom": '<"top"lB>rt<"bottom"ip>',
        buttons:[
            {
                extend:'excelHtml5',
                titleAttr: 'Descargar Excel Por Filtro',
                className: 'btn btn-outline-success ',
                title: 'Productos',
                filename: 'Productos ' + gettime(),
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }
            // /* 'copy', 'csv', */ 'excel'/* , 'pdf', 'print' */
        ]

    } )
    } );

    </script>
    @endsection

@endsection
