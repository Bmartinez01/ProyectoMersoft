@extends('layouts.main', ['activePage' => 'compras', 'titlePage' => 'Compras'])
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
                                <h4 class="card-title text-dark"><strong>Compras</strong></h4>
                                <p class="card-category text-dark">Compras Registrados</p>
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
                                    <div class="col-1 text-left mb-3">
                                        <a href="{{route('compras.excel')}}" title="Descargar Excel" class="btn btn-sm btn-success" ><i class="material-icons">downloading</i>  Excel</a>
                                    </div>
                                    <div class="col-11 text-right">
                                        <a href="{{route('compras_detalle.create')}}" class="btn btn-sm btn-facebook">Agregar Compra</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table  id="compras" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                        <thead class="text-white" id="fondo">
                                            <th>No.</th>
                                            <th>Recibo</th>
                                            <th>Fecha Compra</th>
                                            <th>Proveedor</th>
                                            <th>Valor Total</th>
                                            <th>Estado</th>
                                            <th class="text-right">Función</th>
                                        </thead>
                                        <tbody>

                                            <tr>
                                            @foreach ($compras as $compra)
                                                <td>{{ $compra->id}}</td>
                                                <td>{{ $compra->recibo}}</td>
                                                <td>{{ $compra->fecha_compra}}</td>
                                                @foreach ($proveedores as $row)
                                                @if ($compra->proveedor==$row->id)
                                                <td>{{ $row->nombre}} {{$row->apellido}}</td>
                                                @endif
                                                @endforeach
                                                <td>{{ $compra->valor_total }}</td>
                                                <td class="td-actions text-right">
                                                @if ($compra->estado==1)
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
                                               <a href="{{route('compras.pdf', $compra->id)}}"
                                                    class="btn btn-outline-danger"><span class="material-icons">picture_as_pdf </span></a>
                                                 <a href="{{route('compras.show', $compra->id)}}"
                                                    class="btn btn-warning"><span class="material-icons">visibility </span></a>

                                                    <form action="{{route('compras.destroy', $compra->id)}}" method="post" style="display: inline-block;" onsubmit="return confirm('¿Está seguro de anular esta compra?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </form>
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
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#compras').DataTable( {
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
