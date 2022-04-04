@extends('layouts.main', ['activePage' => 'pedidos', 'titlePage' => 'Agregar pedido'])
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" >
@endsection
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('pedidos.store')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark "><strong>Pedido</strong></h4>
                            <p class="card-category text-dark">Ingresar datos</p>

                        </div>

                            <div class="card-body">
                                <div class="row">
                                    <label for="cliente" class="col-md-1 col-form-label text-dark control-label asterisco">Cliente</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="cliente" id="cliente">
                                            <option value="">Seleccione el cliente</option>
                                            @foreach ( $clientes as $row )
                                            @if ($row->estado==0)
                                            @continue
                                            @endif
                                            <option value="{{$row->id}}">{{$row->nombre}} {{$row->apellido}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('cliente'))
                                        <span class="error text-danger" for="input-cliente">{{ $errors->first('cliente') }}</span>
                                        @endif
                                </div>

                                <label for="estado" class="col-1 offset-1 col-form-label text-dark control-label asterisco">Estado</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="estado" id="estado">
                                            <option value="">Seleccione el estado</option>
                                            @foreach ( $estados as $row )
                                            <option value="{{$row->id}}">{{$row->Estado}}</option>
                                            @endforeach
                                        </select>

                                            <a href="#" title="Editar" class="btn-sm" data-toggle="modal" data-target="#Estados"><i class="fa fa-question-circle fa-2x"></i></a>

                                        @if ($errors->has('estado'))
                                        <span class="error text-danger" for="input-estado">{{ $errors->first('estado') }}</span>
                                        @endif

                                    </div>
                                </div>

                                <br>
                                {{-- <div class="row">
                                <label for="tipo" class="col-1 col-form-label text-dark control-label asterisco">Tipo</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value="">Seleccione el Tipo</option>
                                            @foreach ( $estados as $row )
                                            <option value="{{$row->id}}">{{$row->Tipo}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('tipo'))
                                        <span class="error text-danger" for="input-tipo">{{ $errors->first('tipo') }}</span>
                                        @endif
                                </div>
                            </div> --}}
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="{{route('pedidos.create')}}" class="btn btn-sm btn-facebook" data-toggle="modal" data-target="#Form">Agregar Producto</a>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                <table  id="Pedidos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                    <thead class="text-white" id="fondo">

                                        <th>Cantidad</th>
                                        <th>Producto</th>
                                        <th>Valor/u</th>
                                        <th>Valor Total</th>
                                        <th>Función</th>
                                    </thead>
                                    <tbody id="tblProductos" >

                                    </tbody>

                                </table>

                                </div>
                                <div class="row offset-md-5">
                                    <label for="valor_total" class="col-3 col-form-label control-label asterisco">Valor final </label>
                                    <div class="col-sm-5">
                                    <input type="number" class="form-control" id="valor_total" name="valor_total" readonly>
                                    </div>
                                    </div>
                                </div>

                                <div class="card-footer ml-auto mr-auto col-md-3">
                                    <button type="submit" class="btn btn-facebook">Guardar</button>
                                    <div class="">
                                        <a href="{{route('pedidos.index')}}" class="btn btn-danger">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="Form" tabindex="3" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body ">
                <div class="row">
                    <label for="cantidad" class="col-sm-3 col-form-label control-label asterisco">Cantidad</label>
                    <div class="col-sm-7">
                    <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese su cantidad" >
                    @if ($errors->has('cantidad'))
                    <span class="error text-danger" for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <label for="producto" class="col-sm-3 col-form-label control-label asterisco">Producto</label>
                <div class="col-sm-7">
                    <select class="form-control " name="producto" id="producto" onchange="colocar_precio()">
                        <option value="">Seleccione el producto</option>
                        @foreach ( $productos as $row )
                        @if ($row->estado==0)
                        @continue
                        @endif
                        <option precio="{{$row->precio}}" value="{{$row->id}}">{{$row->Nombre}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('producto'))
                    <span class="error text-danger" for="input-producto">{{ $errors->first('producto') }}</span>
                    @endif
            </div>
            </div>
            <div class="row">
                <label for="valor_unitario" class="col-sm-3 col-form-label control-label asterisco">Valor c/u</label>
                <div class="col-sm-7">
                <input type="number" class="form-control"  id="valor_unitario" name="valor_unitario" readonly>
                @if ($errors->has('valor_unitario'))
                <span class="error text-danger" for="input-valor_unitario">{{ $errors->first('valor_unitario') }}</span>
                @endif
            </div>
            </div>


            </div>
            <div class="modal-footer">
                <div class="">
                    <button onclick="agregar_producto()" data-dismiss="modal" type="button" class="btn btn-success ">Agregar Producto</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                </div>

            </div>
        </div>

    </div>

</div>
{{-- Modal icono --}}
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

                            <td>
                                <input type="hidden" name="producto_id[]" value="${producto_id}" />
                                <input type="hidden" name="cantidades[]" value="${cantidad}" />

                                ${cantidad}
                            </td>
                            <td>${producto_text}</td>
                            <td>${precio}</td>
                            <td>${parseInt(precio) * parseInt(cantidad)}</td>
                            <td class="td-actions text-right">
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

