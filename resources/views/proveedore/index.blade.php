@extends('layouts.main', ['activePage' => 'proveedores', 'titlePage' => 'Proveedores'])
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
                                    <h4 class="card-title text-dark text-dark"><strong>Proveedores</strong></h4>
                                    <p class="card-category text-dark text-dark">Proveedores Registrados</p>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                    <div class="alert alert-success" role="success">
                                        {{ session('success')}}
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12 text-right mb-3">
                                            <a href="{{ route('proveedores.create') }}" class="btn btn-sm btn-facebook">Agregar Proveedor</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive ">
                                        <table  id="proveedores" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                            <thead class="text-white "id="fondo">
                                                <th>ID</th>
                                                <th>Nit Empresa</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Empresa</th>
                                                <th>Categoria</th>
                                                <th>Direccion</th>
                                                <th>Telefono</th>
                                                <th>Email</th>
                                                <th>Estado</th>
                                                <th >Función</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($proveedores as $proveedore)
                                                    <tr>
                                                        <td>{{ $proveedore->id }}</td>
                                                        <td>{{ $proveedore->nit_empresa }}</td>
                                                        <td>{{ $proveedore->nombre }}</td>
                                                        <td>{{ $proveedore->apellido }}</td>
                                                        <td>{{ $proveedore->empresa }}</td>
                                                        @foreach ($categorias as $categoria)
                                                        @if ($proveedore->categoria_id==$categoria->id)
                                                        <td>{{ $categoria->nombre}}</td>
                                                        @break
                                                        @endif
                                                        @endforeach
                                                        <td>{{ $proveedore->direccion }}</td>
                                                        <td>{{ $proveedore->telefono }}</td>
                                                        <td>{{ $proveedore->email }}</td>
                                                        <td class="td-actions text-right">
                                                            @if ($proveedore->estado==1)
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
                                                            <a href="{{ route('proveedores.edit', $proveedore->id) }}" class="btn btn-warning">
                                                            <i class="material-icons">edit</i></a>
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
    $('#proveedores').DataTable( {
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


