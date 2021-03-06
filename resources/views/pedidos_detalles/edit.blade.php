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
            <form action="{{route('pedidos.update', $pedidos->id)}}" method="post" class="form-horizontal">
                @csrf
                @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Pedidos</h4>
                            <p class="card-category text-dark" style="font-size:17px">Editar Pedido</p>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <label for="cliente" class="col-md-1 col-form-label text-dark control-label asterisco">Cliente</label>
                                <div class="col-sm-3">
                                    @foreach ( $clientes as $cliente )

                                    <input type="text" class="form-control" value="{{$cliente->nombre}} {{$cliente->apellido}}" readonly >
                                    @endforeach

                                    <input type="hidden" class="form-control" id="productox" name="productox">
                                    @if ($errors->has('cliente'))
                                    <span class="error text-danger" for="input-cliente">{{ $errors->first('cliente') }}</span>
                                    @endif
                                </div>

                             <label for="estado" class="col-1 offset-1 col-form-label text-dark control-label asterisco">Estado</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="estado" id="estado" >
                                        <option  value="">Seleccione solo para modificar</option>
                                        @foreach ( $estado as $row )
                                        <option @if ($row->id==$pedidos->estado)
                                            selected="true"
                                        @endif

                                         value="{{$row->id}}">{{$row->Estado}}</option>
                                        @endforeach

                                    </select>

                                        <a href="#" title="Editar" class="btn-sm" data-toggle="modal" data-target="#Estados"><i class="fa fa-question-circle fa-2x"></i></a>

                                    @if ($errors->has('estado'))
                                    <span class="error text-danger" for="input-estado">{{ $errors->first('estado') }}</span>
                                    @endif

                                </div>
                            </div>

                            <br>

                            <br>
                            <br>
                             <div class="row">
                                <div class="col-12 text-right">
                                    <a href="#" class="btn btn-sm btn-facebook" data-toggle="modal" data-target="#Form">Agregar Producto</a>
                                 </div>
                            </div>

                            <div class="table-responsive">
                                <table  id="Pedido" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                                    <thead class="text-white" id="fondo">
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Valor c/u</th>
                                        <th>Sub Total</th>
                                        <th>funciones</th>
                                    </thead>
                                    <tbody id="tblProductos">

                                        @foreach ($productos2 as $row)
                                        <tr id="tr-{{$row->id}}">
                                            <td>{{ $row->Nombre}} {{$row->unidad}}</td>
                                            <td>{{ $row->cantidad_c}}</td>
                                            <td>{{ $row->precio}}</td>
                                            <td>{{ $row->precio * $row->cantidad_c}}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger" onclick="eliminar_producto({{$row->id}}, {{$row->cantidad_c * $row->precio}})" ><i class="bi bi-trash" style="font-size: 20px; color: red;"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div class="row offset-md-5">
                                <label for="valor_total" class="col-3 col-form-label control-label asterisco">Valor final </label>
                                <div class="col-sm-5">
                                <input type="number" class="form-control" id="valor_total" value="{{$pedidos->valor_total}}" name="valor_total" readonly>
                                @if ($errors->has('valor_total'))
                                    <span class="error text-danger" for="input-valor_total">{{ $errors->first('valor_total') }}</span>
                                    @endif
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
                        <td colspan="8">El pedido fue entregado y se recibio el pago</td>
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
{{-- agregar --}}
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
                        <option precio="{{$row->precio}}" value="{{$row->id}}">{{$row->Nombre}} {{$row->unidad}}</option>
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
@endsection
@section('script')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

        <script>

            function colocar_precio(){

                let precio = $("#producto option:selected").attr("precio");
                $("#valor_unitario").val(precio);
            }
            let array = [];
            function agregar_producto(){
                let producto_id = $("#producto option:selected").val();
                let producto_text = $("#producto option:selected").text();
                let cantidad = $("#cantidad").val();
                let precio = $("#valor_unitario").val();
                if(cantidad > 0 && precio > 0){
                    array.push(producto_id);

                    for(var j = 0; j < array.length; j++){

                        for(var i = j+1; i < array.length; i++){

                            if(array[j] == array[i] && producto_id == array[i]){
                                alert("El producto "+producto_text+" ya esta registrado en el pedido");
                                 array.pop();
                                die();
                             }
                         }
                    }


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

            let productox=[];
            function eliminar_producto(id,subtotal){

                    id= id.toString();
                    var index =array.indexOf(id);
                    if (index !== -1) {
                        array.splice(index, 1);
                    }

                    if (productox.includes(id, 0)) {

                    }
                    else{
                        let nuevoproducto = productox.push(id);
                    }
                    console.log(productox);


                $("#tr-"+id).remove();

                let valor_total = $("#valor_total").val() || 0;
             $("#valor_total").val(parseInt(valor_total) - subtotal);
             $("#productox").val(productox);


            }







        </script>

@endsection
