@extends('layouts.main', ['activePage' => 'compras', 'titlePage' => 'Agregar Compra'])
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" >
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('compras.store')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Compra</h4>
                            <p class="card-category text-dark" style="font-size:17px">Ingresar datos</p>

                        </div>
                            <div class="card-body">
                                <div class="row">
                                    <label for="recibo" class="col-sm-1 col-form-label control-label asterisco">Recibo</label>
                                    <div class="col-sm-3">
                                    <input type="text" class="form-control" name="recibo" placeholder="Ingrese su recibo" value="{{old('recibo')}}" autofocus>
                                    @if ($errors->has('recibo'))
                                    <span class="error text-danger" for="input-recibo">{{ $errors->first('recibo') }}</span>
                                    @endif
                                </div>
                                <label for="cliente"  class="col-sm-2 col-form-label offset-3 text-dark control-label asterisco">Proveedor</label>
                                <div class="col-sm-3">
                                    <select class="form-control js-example-basic-single" name="proveedor" id="proveedor">
                                        <option value="">Seleccione el proveedor</option>
                                        @foreach ( $proveedores as $row )
                                        @if ($row->estado==0)
                                        @continue
                                        @endif
                                        <option value="{{$row->id}}">{{$row->nombre}} {{$row->apellido}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('proveedor'))
                                    <span class="error text-danger" for="input-proveedor">{{ $errors->first('proveedor') }}</span>
                                    @endif
                            </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        <div class="row">
                            <label for="fecha_compra" class="col-sm-1 col-form-label control-label asterisco">Fecha Compra</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="fecha_compra" placeholder="Ingrese la fecha de la compra" value="{{old('fecha_compra')}}" autofocus max="<?= date('Y-m-d'); ?>">
                                    @if ($errors->has('fecha_compra'))
                                    <span class="error text-danger" for="input-fecha_compra">{{ $errors->first('fecha_compra') }}</span>
                                    @endif
                                </div>
                                <label for="valor_total" class="col-sm-2 offset-3 col-form-label control-label asterisco">Valor Total</label>
                                <div class="col-sm-3">
                                <input type="number" class="form-control" id="valor_total" name="valor_total" step="0.01" readonly>
                                </div>
                                <br>
                                <br>
                                <br>
                                <label for="iva" class="col-sm-1 offset-3 col-form-label control-label">Iva</label>
                                <div class="col-sm-3">
                                <input type="text" class="form-control" name="iva" id="iva"  placeholder="Ingrese el iva de la compra">
                                <button onclick="agregar_iva()" class="btn btn-sm btn-facebook" id="mostrar" name="mostrar" data-dismiss="modal" type="button">Agregar iva</button>
                                <button onclick="limpiar_iva()" class="btn btn-sm btn-facebook" type="button">Corregir Iva</button>
                            </div>
                    </div>
                    <br>

    </div>
    <div class="row">
        <div class="col-2 text-right">
            <a href="{{route('compras.create')}}" class="btn btn-sm btn-success" data-toggle="modal" data-target="#Form">Agregar producto</a>
        </div>
    </div>

    <div class="table-responsive">
        <table  id="Compras" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="text-white" id="fondo">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Valor c/u</th>
                <th>Sub Total</th>
                <th>Funciones</th>

            </tr>
        </thead>
        <tbody id="tblProductos">

        </tbody>
    </table>
</div>
<div class="card-footer ml-auto mr-auto col-md-3">
    <button type="submit" class="btn btn-facebook">Enviar</button>
    <div class="">
        <a href="{{route('compras.index')}}" class="btn btn-danger">Cancelar</a>
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
                    <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese su cantidad">
                    @if ($errors->has('cantidad'))
                    <span class="error text-danger" for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <label for="producto" class="col-sm-3 col-form-label control-label asterisco">Producto</label>
                <div class="col-sm-7">
                    <select class="form-control" name="producto" id="producto">
                        <option value="">Seleccione el producto</option>
                        @foreach ( $productos as $row )
                        @if ($row->estado==0)
                        @continue
                        @endif
                        <option value="{{$row->id}}">{{$row->Nombre}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('producto'))
                    <span class="error text-danger" for="input-producto">{{ $errors->first('producto') }}</span>
                    @endif
            </div>
            </div>
            <div class="row">
                <div class="row">
                    <label for="precio" class="col-sm-3 col-form-label control-label asterisco">Valor c/u</label>
                    <div class="col-sm-7">
                    <input type="number" class="form-control" id="precio"  name="precio" placeholder="Ingrese su precio" >
                    @if ($errors->has('precio'))
                    <span class="error text-danger" for="input-precio">{{ $errors->first('precio') }}</span>
                    @endif
                </div>
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
        <script>
                let array = [];

                function agregar_producto(){
                let producto_id = $("#producto option:selected").val();
                let producto_text = $("#producto option:selected").text();
                let cantidad = $("#cantidad").val();
                let precio = $("#precio").val();
                if(producto_id > 0 && cantidad > 0 && precio > 0){
                array.push(producto_id);
                for(var j = 0; j < array.length; j++){
                for(var i = j+1; i < array.length; i++){
                    if(array[j] == array[i] && producto_id == array[i]){
                        alert("El producto "+producto_text+" ya esta registrado en la compra");
                        array.pop();
                        die();
                    }
                }
                }

                    $("#tblProductos").append(`
                        <tr id="tr-${producto_id}">
                            <td>
                                <input type="hidden" name="precios[]" value="${precio}"/>
                                <input type="hidden" name="producto_id[]" value="${producto_id}" />
                                <input type="hidden" name="cantidades[]" value="${cantidad}" />
                                ${producto_text}

                            </td>
                            <td contenteditable='true'>${cantidad}</td>
                            <td>${precio}</td>
                            <td>${parseInt(precio) * parseInt(cantidad)}</td>
                            <td>
                 <button type="button" class="btn btn-outline-danger" onclick="eliminar_producto(${producto_id}, ${parseInt(cantidad) * parseInt(precio)})"><i class="bi bi-trash" style="font-size: 20px;"></i></button>


                            </td>

                        </tr>
                    `);
                        let valor_total = $("#valor_total").val() || 0;
                        $("#valor_total").val(parseInt(valor_total) + parseInt(cantidad) * parseInt(precio));
                }
                else {
                    alert("Se debe ingresar un producto valido,  cantidad y/o precio valido");
                    // $("#producto").val('');
                    // $("#cantidad").val('');
                    // $("#precio").val('');
                    die();
                }
                $("#producto").val('');
                $("#cantidad").val('');
                $("#precio").val('');

            }
            let cont = 0;
            function agregar_iva(){
                if(cont == 0){
                let iva = $("#iva").val() || 0;
                let Valor_Total = $("#valor_total").val() || 0;
                let suma = parseInt(Valor_Total) + parseInt(iva);
                $("#valor_total").val(suma);
                document.getElementById("iva").readOnly = true;
                // document.getElementById("mostrar").style.opacity = "0";
                cont++;
                }
            }

            function limpiar_iva(){
                if(cont > 0){
                let iva = $("#iva").val() || 0;
                let Valor_Total = $("#valor_total").val() || 0;
                let resta = parseInt(Valor_Total) - parseInt(iva);
                if(iva <= Valor_Total){
                $("#valor_total").val(resta);
                $("#iva").val("");
                document.getElementById("iva").readOnly = false;
                cont--;
                }
            }
            }

            function eliminar_producto(id,subtotal){
                id = id.toString();
                var index = array.indexOf(id);
                if (index !== -1){
                    array.splice(index, 1);
                }
                $("#tr-"+id).remove("");

                let valor_total = $("#valor_total").val() || 0;
             $("#valor_total").val(parseInt(valor_total) - parseInt(subtotal));

            }

        </script>
        <script>
            $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        
        </script>

@endsection
