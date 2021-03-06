@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Usuarios'])
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
                                <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Usuarios</h4>
                                <p class="card-category text-dark" style="font-size:17px">Usuarios Registrados</p>
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
                                    <div class="col-12 text-right">
                                    @can('usuario_crear')
                                        <a href="{{route('users.create')}}" class="btn btn-sm btn-facebook">Agregar Usuario</a>
                                    @endcan
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table  id="users" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                        <thead class="text-white " id="fondo">

                                            <th>No.</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Tel??fono</th>
                                            <th>Direcci??n</th>
                                            <th>Roles</th>
                                            {{-- <th>Fecha</th> --}}
                                            <th>Estado</th>
                                            <th class="text-left">Funci??n</th>
                                        </thead>
                                        <tbody>
                                            @if (Auth::user()->id==$users[0]->id)
                                            @foreach ($users as $user)
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->telefono }}</td>
                                                <td>{{ $user->direccion }}</td>
                                                <td>
                                                    @forelse ($user->roles as $role)
                                                    <span class="badge badge-info text-dark">{{ $role->name}}</span>
                                                    @empty
                                                    <span class="badge badge-danger">No hay Roles seleccionados</span>
                                                    @endforelse
                                                </td>
                                                {{-- <td>{{ $user->created_at }}</td> --}}

                                                <td class="td-actions text-right">
                                                @if ($user->estado==1)
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
                                               @can('usuario_editar')
                                                 <a href="{{route('users.edit', $user->id)}}"
                                                    class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                @endcan
                                               </td>

                                            </tr>
                                            <!-- javascript init -->
                                            @endforeach
                                            @endif
                                            @foreach ($users as $user)
                                            @if (Auth::user()->id==$user->id && $user->id>1)
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->telefono }}</td>
                                                <td>{{ $user->direccion }}</td>
                                                <td>
                                                    @forelse ($user->roles as $role)
                                                    <span class="badge badge-info text-dark">{{ $role->name}}</span>
                                                    @empty
                                                    <span class="badge badge-danger">No hay Roles seleccionados</span>
                                                    @endforelse
                                                </td>
                                                {{-- <td>{{ $user->created_at }}</td> --}}

                                                <td class="td-actions text-right">
                                                @if ($user->estado==1)
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
                                               @can('usuario_editar')
                                                 <a href="{{route('users.edit', $user->id)}}"
                                                    class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                @endcan
                                               </td>

                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="card-footer mr-auto">
                                {{$userS->links()}}
                            </div> --}}
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
        $('#users').DataTable( {
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
            "info": "Mostrando la p??gina _PAGE_ de _PAGES_",
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
