@extends('layouts.main', ['activePage' => 'productos', 'titlePage' => 'Productos'])
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" >
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
                                        <div class="col-1 text-left mb-3">
                                                <a href="{{route('productos.index')}}" class="btn btn-sm btn-secondary"><i class="material-icons">reply</i></a>
                                        </div>
                                    <div class="col-2 text-left mb-3">
                                        @can('producto_descargar excel')
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#Fecha"><i class="material-icons">save_alt</i> Excel
                                        @endcan
                                    </div>
                                    <div class="col-7 text-left mb-3">
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Filtro">Filtrar
                                    </div>

                                    <div class="col-2 text-right">
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
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Estado</th>
                                            <th class="text-left">Función</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($productos as $Producto)
                                            <tr>


                                                <td>{{ $Producto->id}}</td>
                                                <td>{{ $Producto->Nombre}} {{$Producto->unidad}}</td>
                                                <td>{{ $Producto->nombrecat}}</td>
                                                <td>{{ $Producto->Stock}}</td>
                                                <td>{{ $Producto->precio}}</td>
                                                <td class="td-actions text-left">
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
                                               <td class="td-actions text-left">
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
                                                    <form action="{{ route('productos_excel')}}" method="post">
                                                        @csrf
                                                        <div class="text-center" >
                                                            <input type="text" hidden name="Desicion" value="Todo">
                                                            <button type="submit" class="btn btn-outline-dark" >Descargar todo</button>
                                                        </div>
                                                    </form>

                                                    <form action="{{ route('productos_excel')}}" method="post">
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
                                                        <button type="submit" class="btn btn-facebook">Aceptar</button>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    {{--------------------------}}
                                    {{-- Modal filtro --}}
                                    <div class="modal fade" id="Filtro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Filtrar</h5>
                                                        @can('Exportar')
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        @endcan
                                                    </div>

                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="Text-center">


                                                        <form action="{{ route('productos.excel2')}}" method="post">
                                                            @csrf
                                                            <label for="">Desde</label>
                                                            <br>
                                                            <input type="date" class="form-control" id="from" name="from"  max="<?= date('Y-m-d'); ?>" >
                                                            <br>
                                                            <label for="">Hasta</label>
                                                            <br>
                                                            <input type="date" class="form-control" id="to" name="to"  max="<?= date('Y-m-d'); ?>" >


                                                        </div>
                                                        <div class="modal-footer">
                                                                <button type="submit" class="btn btn-outline-dark btn-sm" name="search" ><i class="material-icons">search</i></button>
                                                        </div>
                                                        </form>
                                                    </div>

                                                </div>
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
    @section('script')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
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
        }
    } );
} );

</script>
@endsection

@endsection
