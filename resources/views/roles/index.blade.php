@extends('layouts.main', ['activePage' => 'roles', 'titlePage' => 'Roles'])
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
                                <h4 class="card-title text-dark"><strong>Roles</strong></h4>
                                <p class="card-category text-dark">Roles Registrados</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                               <div class="alert alert-success" role="success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-12 text-right">
                                    @can('role_create')        
                                        <a href="{{route('roles.create')}}" class="btn btn-sm btn-facebook">Agregar Rol</a>
                                    @endcan
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table  id="roles" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                        <thead class="text-white " id="fondo">

                                            <th>No.</th>
                                            <th>Nombre</th>
                                            <th>Permisos</th>
                                            <th>Estado</th>
                                            <th>Función</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                            <tr>

                                                <td>{{$role->id}}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @forelse ($role->permissions as $permission)
                                                    <span class="badge badge-info">{{ $permission->name}}</span>
                                                    @empty
                                                    <span class="badge badge-danger">No hay permisos seleccionados</span>
                                                    @endforelse
                                                </td>
                                                <td class="td-actions text-left">
                                                    @if ($role->estado==1)
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        Activo
                                                    </button>

                                                    @else
                                                    <button type="button" class="btn btn-danger btn-sm">
                                                        Inactivo
                                                    </button>

                                                    @endif
                                                </td>
                                                <td class="td-actions">
                                                @can('role_edit')        
                                                 <a href="{{route('roles.edit', $role->id)}}"
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
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#roles').DataTable( {
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
