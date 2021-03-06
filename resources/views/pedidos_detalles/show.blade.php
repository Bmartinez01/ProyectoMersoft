@extends('layouts.main', ['activePage' => 'pedidos', 'titlePage' => 'Pedidos'])
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" >
@endsection
@section('content')
@if (count($productos) > 0)



<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Pedidos</h4>
                            <p class="card-category text-dark" style="font-size:17px">Ver Detalle Pedido</p>
                        </div>
                        <div class="card-body">
                        @foreach ($pedido as $pedido)

                            <div class="row">
                                <label for="cliente" class="col-md-1 col-form-label text-dark">Cliente :</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="{{$pedido->nombre}} {{$pedido->apellido}}" readonly>
                                    @if ($errors->has('cliente'))
                                    <span class="error text-danger" for="input-cliente">{{ $errors->first('cliente') }}</span>
                                    @endif
                            </div>

                             <label for="estado" class="col-1 offset-1 col-form-label text-dark ">Estado :</label>
                                <div class="col-sm-3">
                                        <input type="text" class="form-control" value="{{($pedido->estado)}}" readonly >

                                        <a href="#" title="Editar" class="btn-sm" data-toggle="modal" data-target="#Estados"><i class="fa fa-question-circle fa-2x"></i></a>
                                    @if ($errors->has('estado'))
                                    <span class="error text-danger" for="input-estado">{{ $errors->first('estado') }}</span>
                                    @endif
                                </div>
                            </div>
                            <br>
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
                                            <td>{{ $row->Nombre}} {{$row->unidad}}</td>
                                            <td>{{ $row->cantidad_c}}</td>
                                            <td>{{ $row->precio}}</td>
                                            <td>{{ $row->precio * $row->cantidad_c}}</td>

                                        </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row offset-md-7">
                                <label for="valor_total" class="col-3 col-form-label text-dark">Valor final :</label>
                                <div class="col-sm-6">
                                <input type="number" class="form-control" id="valor_total" value="{{$pedido->valor_total}}" name="valor_total" readonly>
                                </div>
                                </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto col-md-1">

                                <a href="{{route('pedidos.index')}}" class="btn btn-facebook">Volver</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </div>


@endif
<div class="modal fade" id="Estados" tabindex="3" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <table class="table table-striped ">
                    <thead>
                      <tr>
                        <th scope="col">Estado</th>
                        <th scope="col" colspan="8">Descripcion</th>
                        <th scope="col">Tipo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>

                        <td>Venta Directa</td>
                        <td colspan="8">El cliente compra y se lleva sus articulos</td>
                        <td>Venta Directa </td>
                      </tr>
                      <tr>

                        <td>Solicitado</td>
                        <td colspan="8">Compra a domicilio y se realiza el pedido</td>
                        <td>Domicilio</td>
                      </tr>
                      <tr>

                        <td>En Proceso</td>
                        <td colspan="8">El pedido se esta empacando</td>
                        <td>Domicilio</td>
                      </tr>
                      <tr>

                        <td>Por Despachar</td>
                        <td colspan="8">Esta listo para despachar</td>
                        <td>Domicilio</td>
                      </tr>
                      <tr>

                        <td>Enviado</td>
                        <td colspan="8">Esta despachado al cliente</td>
                        <td>Domicilio</td>
                      </tr>
                      <tr>

                        <td>Vendido</td>
                        <td colspan="8">El pedido fue entregado y se reciio el pago</td>
                        <td>Domicilio/venta directa</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
                                <a href="{{route('pedidos.create')}}" onclick="return confirm('Est??s seguro que deseas eliminar el registro?');"></a>

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
    //             "info": "Mostrando la p??gina _PAGE_ de _PAGES_",
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
