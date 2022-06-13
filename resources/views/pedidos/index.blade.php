@extends('layouts.main', ['activePage' => 'pedidos', 'titlePage' => 'Pedidos'])
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
                                <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Pedidos</h4>
                                <p class="card-category text-dark" style="font-size:17px">Pedidos Registrados</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                               <div id="mensaj" class="alert alert-success" role="success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if (session('danger'))
                               <div id="mensaj" class="alert alert-danger" role="success">
                                    {{ session('danger') }}
                                </div>
                                @endif
                                <div class="row">
                                        <div class="col-1 text-left mb-3">
                                                <a href="{{route('pedidos.index')}}" class="btn btn-sm btn-secondary"><i class="material-icons">reply</i></a>
                                        </div>
                                    <div class="col-1 text-left mb-3">
                                            @can('pedido_descargar excel')
                                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#Fecha"><i class="material-icons">save_alt</i> Excel 
                                            @endcan
                                    </div>
                                    <div class="col-2 text-left mb-3">
                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Filtro">Filtrar
                                    </div>
                                    
                                    <div class="col-8 text-right">
                                    @can('producto_crear')
                                    <a href="{{route('pedidos_detalles.create')}}" class="btn btn-sm btn-facebook">Agregar Pedido</a>
                                    @endcan
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table  id="Pedido" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                        <thead class="text-white" id="fondo">

                                            <th>#Pedido</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Valor Total</th>
                                            <th>Tipo</th>
                                            <th>Estado</th>
                                            <th class="text-left">Función</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($pedidos as $pedido)

                                                    <td>{{ $pedido->id}}</td>
                                                    <td>{{ $pedido->created_at}}</td>
                                                    <td>{{ $pedido->nombclient}} {{$pedido->apellclient}}</td>
                                                    <td>{{ $pedido->valor_total }}</td>
                                                    <td>{{ $pedido->tipoEst}}</td>
                                                    <td>{{ $pedido->estadoEst}}</td>
                                                    <td class="td-actions text-left">

                                                        @can('pedido_descargar pdf')
                                                        <a href="{{ route('pedidos.pdf', $pedido->id) }}"
                                                        class="btn btn-outline-danger"><span class="material-icons">picture_as_pdf </span></a>
                                                        @endcan
                                                        @can('pedido_editar')
                                                        @if($pedido->estadoEst != 'Vendido' && $pedido->estadoEst != 'Venta Directa' )
                                                        <a href="{{ route('pedidos.edit', $pedido->id) }}"
                                                        class='btn btn-warning'><i class='material-icons'>edit</i></a>
                                                        @endif
                                                        @endcan
                                                        @can('pedido_ver detalle')
                                                           <a href="{{route('pedidos.show', $pedido->id)}}"
                                                            class="btn btn-warning"><span class="material-icons">visibility </span></a>
                                                        @endcan

                                                        @can('pedido_cancelar')
                                                        @if($pedido->estadoEst != 'Vendido' && $pedido->estadoEst != 'Venta Directa' && $pedido->estadoEst != 'Enviado' )
                                                        <form action="{{route('pedidos.destroy', $pedido->id)}}" method="post" style="display: inline-block;" onsubmit="return confirm('¿Está seguro de cancelar este pedido?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                        </form>
                                                        @endif
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
                                                <form action="{{ route('pedidos_excel')}}" method="post">
                                                    @csrf
                                                    <div class="text-center" >
                                                        <input type="text" hidden name="Desicion" value="Todo">
                                                        <button type="submit" class="btn btn-secondary" >Descargar todo</button>
                                                    </div>
                                                </form>
                                
                                                <form action="{{ route('pedidos_excel')}}" method="post">
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
                                        
                                
                                                <form action="{{ route('pedidos.excel2')}}" method="post">
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
    $('#Pedido').DataTable( {
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
