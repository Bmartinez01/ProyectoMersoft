@extends('layouts.main', ['activePage' => 'ventas', 'titlePage' => 'Ventas'])
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
                            <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Ventas</h4>
                            <p class="card-category text-dark" style="font-size:17px">Ver Detalle ventas</p>
                        </div>
                        <div class="card-body">
                        @foreach ($Venta as $venta)

                            <div class="row">
                            <label for="pedido" class=" col-md-1 col-form-label text-dark control-label asterisco">#Pedido</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="{{$venta->pedido_id}} " readonly>
                                    @if ($errors->has('Pedido'))
                                    <span class="error text-danger" for="input-Pedido">{{ $errors->first('Pedido') }}</span>
                                    @endif
                                    </div>
                                <label for="cliente" class="offset-md-3 col-md-1 col-form-label text-dark control-label asterisco">Cliente</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="{{$venta->nombre}} {{$venta->apellido}}" readonly>
                                    @if ($errors->has('cliente'))
                                    <span class="error text-danger" for="input-cliente">{{ $errors->first('cliente') }}</span>
                                    @endif
                            </div>

                            <br>
                            <br>
                            @endforeach

                            <div class="table-responsive">
                                <table  id="compras" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                    <thead class="text-white" id="fondo">
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Valor c/u</th>
                                        <th>Sub Total</th>

                                    </thead>
                                    <tbody >
                                        <tr>
                                        @foreach ($productos as $row)
                                            <td>{{ $row->Nombre}}</td>
                                            <td>{{ $row->cantidad_c}}</td>
                                            <td>{{ $row->precio}}</td>
                                            <td>{{ $row->precio * $row->cantidad_c}}</td>

                                        </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row offset-md-5">
                                <label for="valor_total" class="col-1 col-form-label control-label asterisco">Valor final </label>
                                <div class="col-sm-2">
                                <input type="number" class="form-control" id="valor_total" value="{{$venta->valor_total}}" name="valor_total" readonly>
                                </div>
                                </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto col-md-1">

                                <a href="{{route('ventas.index')}}" class="btn btn-facebook">Volver</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </div>
</div>
@endsection
@section('script')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

        <script>

            function colocar_precio(){

                let precio = $("#producto option:selected").attr("precio");
                $("#valor_unitario").val(precio);
            }

            function agregar_producto(){
                let producto_id = $("#producto option:selected").val();
                let producto_text = $("#producto option:selected").text();
                let cantidad = $("#cantidad").val();
                let precio = $("#valor_unitario").val();

                if(cantidad > 0 && precio > 0){
                    $("#tblProductos").append(`
                        <tr id="tr-${producto_id}">
                            <td>${producto_text}</td>
                            <td>
                                <input type="hidden" name="producto_id[]" value="${producto_id}" />
                                <input type="hidden" name="cantidades[]" value="${cantidad}" />

                                ${cantidad}
                            </td>

                            <td>${precio}</td>
                            <td>${parseInt(precio) * parseInt(cantidad)}</td>
                            <td class="">
                                <a href="{{route('pedidos.create')}}" onclick="return confirm('Estás seguro que deseas eliminar el registro?');"></a>

                                <button type="button" class="btn btn-outline-danger" onclick="eliminar_producto(${producto_id}, ${parseInt(cantidad) * parseInt(precio)})" ><i class="bi bi-trash" style="font-size: 20px; color: red;"></i></button>

                            </td>

                        </tr>
                    `);
                        let valor_total = $("#valor_total").val() || 0;
                        $("#valor_total").val(parseInt(valor_total) + parseInt(cantidad) * parseInt(precio));
                }
                else {
                    alert("Se debe ingresar una cantidad o precio valido");
                }
                $("#producto").val('');
                $("#cantidad").val('');
                $("#valor_unitario").val('');
            }

            function eliminar_producto(id,subtotal){
                $("#tr-"+id).remove();

                let valor_total = $("#valor_total").val() || 0;
             $("#valor_total").val(parseInt(valor_total) - subtotal);


            }
    //         $(document).ready(function() {
    //     $('#Pedidos').DataTable( {
    //         "language": {
    //             "lengthMenu": "Mostrar  _MENU_  registros por pagina",
    //             "zeroRecords": "No se encontraron datos",
    //             "info": "Mostrando la página _PAGE_ de _PAGES_",
    //             "infoEmpty": "No records available",
    //             "infoFiltered": "(filtrado de _MAX_ registros totales)",
    //             "search": "Buscar: ",
    //             "paginate": {
    //                 "next":"Siguiente",
    //                 "previous":"Anterior"
    //             }
    //         }
    //     } );
    // } );
    $(document).ready(function(){
                $("select").select2({
                })
        });
        </script>

@endsection
