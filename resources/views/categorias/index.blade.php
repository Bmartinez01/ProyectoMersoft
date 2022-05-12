@extends('layouts.main', ['activePage' => 'categorias', 'titlePage' => 'Categorías'])
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" >
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-info">
                                    <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Categorías</h4>
                                    <p class="card-category text-dark" style="font-size:17px">Categorias Registradas</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                    <div id="mensaj" class="alert alert-success alert-dismissible" role="success">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right mb-3">
                                        @can('categoria_crear')
                                            <a href="{{  route('categorias.create') }}" class="btn btn-sm btn-facebook">Agregar Categoría</a>
                                        @endcan
                                        </div>
                                    </div>
                                    <div class="table-responsive ">
                                        <table  id="categorias" class="table table-striped table-bordered shadow-lg mt-4 mx-auto " style="width:90%">
                                            <thead class="text-white" id="fondo">
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th >Funciones</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($categorias as $categoria)
                                                    <tr>
                                                        <td>{{ $categoria->id }}</td>
                                                        <td>{{ $categoria->nombre }}</td>
                                                        <td class="td-actions text-left">
                                                        @if ($categoria->estado==1)
                                                        <button type="button" class="btn btn-success btn-sm">
                                                            Activo
                                                        </button>

                                                        @else
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            Inactivo
                                                        </button>

                                                        @endif
                                                    </td>
                                                        <td class="td-actions ">
                                                        @can('categoria_editar')
                                                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning">
                                                            <i class="material-icons">edit</i></a>
                                                        @endcan
                                                        </td>
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
@section('script')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#categorias').DataTable( {
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

