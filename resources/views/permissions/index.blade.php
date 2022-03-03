@extends('layouts.main', ['activePage' => 'permisos', 'titlePage' => 'Permisos'])
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
                                <h4 class="card-title text-dark"><strong>Permisos</strong></h4>
                                <p class="card-category text-dark">Permisos Registrados</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                               <div class="alert alert-success" role="success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="{{route('permissions.create')}}" class="btn btn-sm btn-facebook">Agregar Permiso</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table  id="permissions" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                        <thead class="text-white " id="fondo">

                                            <th>No.</th>
                                            <th>Nombre</th>
                                            <th>Guard</th>
                                            <th class="text-right">Función</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $permission)
                                            <tr>

                                                <td>{{$permission->id}}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->guard_name }}</td>
                                                <td class="td-actions text-right">
                                                 <a href="{{route('permissions.edit', $permission->id)}}"
                                                    class="btn btn-warning"><i class="material-icons">edit</i></a>
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
        $('#permissions').DataTable( {
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