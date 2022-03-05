@extends('layouts.main', ['activePage' => 'compras', 'titlePage' => 'Agregar Compra'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('compras.store')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark "><strong>Compra</strong></h4>
                            <p class="card-category text-dark">Ingresar datos</p>

                        </div>
                            <div class="card-body">
                                <div class="row">
                                    <label for="recibo" class="col-sm-2 col-form-label control-label asterisco">Recibo</label>
                                    <div class="col-sm-7">
                                    <input type="number" class="form-control" name="recibo" placeholder="Ingrese su recibo" value="{{old('recibo')}}" autofocus>
                                    @if ($errors->has('recibo'))
                                    <span class="error text-danger" for="input-recibo">{{ $errors->first('recibo') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label control-label asterisco">Nombre</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" name="nombre" placeholder="Ingrese su nombre" value="{{old('nombre')}}">
                                @if ($errors->has('nombre'))
                                <span class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label for="proveedor" class="col-sm-2 col-form-label control-label asterisco">Proveedor</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="proveedor" id="proveedor">
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
                    <div class="row">
                        <label for="cantidad" class="col-sm-2 col-form-label control-label asterisco">Cantidad</label>
                        <div class="col-sm-7">
                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese su cantidad" value="{{old('cantidad')}}">
                        @if ($errors->has('cantidad'))
                        <span class="error text-danger" for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <label for="producto" class="col-sm-2 col-form-label control-label asterisco">Producto</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="producto" id="producto" onchange="colocar_precio()">
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
                    <label for="valor_unitario" class="col-sm-2 col-form-label control-label asterisco">Valor c/u</label>
                    <div class="col-sm-7">
                    <input type="number" class="form-control"  id="valor_unitario" name="valor_unitario" readonly>
                    @if ($errors->has('valor_unitario'))
                    <span class="error text-danger" for="input-valor_unitario">{{ $errors->first('valor_unitario') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <label for="valor_total" class="col-sm-2 col-form-label control-label asterisco">Valor Total</label>
                <div class="col-sm-7">
                <input type="number" class="form-control" id="valor_total" name="valor_total" readonly>
                </div>
        </div>
    </div>
    <div class="card-footer ml-auto mr-auto col-md-3">
        <button onclick="agregar_producto()" type="button" class="btn btn-success float-left ">Agregar datos</button>
        <button type="submit" class="btn btn-facebook">Enviar</button>
        <div class="">
            <a href="{{route('compras.index')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
    <table class="table">
        <thead>
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
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

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
                                ${producto_text}

                            </td>
                            <td>${cantidad}</td>
                            <td>${precio}</td>
                            <td>${parseInt(precio) * parseInt(cantidad)}</td>
                            <td>
                                <a href="{{route('compras.create')}}" onclick="return confirm('Estás seguro que deseas eliminar el registro?');">Eliminar registro</a>

                // <button type="button" class="btn btn-danger" onclick="eliminar_producto(${producto_id}, ${parseInt(cantidad) * parseInt(precio)})" >X</button>
                            </td>

                        </tr>
                    `);
                        let valor_total = $("#valor_total").val() || 0;
                        $("#valor_total").val(parseInt(valor_total) + parseInt(cantidad) * parseInt(precio));
                }
                else {
                    alert("Se debe ingresar una cantidad o precio valido");
                }

            }

            function eliminar_producto(id,subtotal){
                $("#tr-"+id).remove();

                let valor_total = $("#valor_total").val() || 0;
             $("#valor_total").val(parseInt(valor_total) - subtotal);


            }
        </script>

@endsection
