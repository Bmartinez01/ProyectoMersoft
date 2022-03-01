@extends('layouts.main', ['activePage' => 'productos', 'titlePage' => 'productos'])
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
                                <h4 class="card-title text-dark"><strong>productos</strong></h4>
                                <p class="card-category text-dark">productos Registrados</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                               <div class="alert alert-success" role="success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="{{route('productos.create')}}" class="btn btn-sm btn-facebook">Agregar productos</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table  id="productos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                        <thead class="text-white "id="fondo">

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
                                                @foreach ($categorias as $categoria)
                                                @if ($Producto->Categorías==$categoria->id)
                                                <td>{{ $categoria->nombre}}</td>
                                                @endif
                                                @endforeach

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
                                                 <a href="{{ route('productos.edit', $Producto->id) }}"
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
        $('#productos').DataTable( {
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
