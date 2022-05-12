@extends('layouts.main', ['activePage' => 'proveedores', 'titlePage' => 'Agregar Proveedor'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('proveedores.store') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Proveedores</h4>
                            <p class="card-category text-dark" style="font-size:17px">Ingresar datos</p>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <label for="nit_empresa" class="col-sm-2 col-form-label control-label asterisco">Nit Empresa</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nit_empresa" placeholder="Ingrese el Nit de la empresa" value="{{old('nit_empresa')}}"  autofocus >
                                    @if ($errors->has('nit_empresa'))
                                    <span class="error text-danger" for="input-nit_empresa">{{ $errors->first('nit_empresa') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label control-label asterisco">Nombre</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre"  value="{{old('nombre')}}" autofocus >
                                    @if ($errors->has('nombre'))
                                    <span class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="apellido" class="col-sm-2 col-form-label control-label asterisco">Apellido</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="apellido" placeholder="Ingrese el apellido" value="{{old('apellido')}}"  autofocus >
                                    @if ($errors->has('apellido'))
                                    <span class="error text-danger" for="input-apellido">{{ $errors->first('apellido') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="empresa" class="col-sm-2 col-form-label control-label asterisco">Empresa</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="empresa" placeholder="Ingrese el nombre de la empresa" value="{{old('empresa')}}"  autofocus >
                                    @if ($errors->has('empresa'))
                                    <span class="error text-danger" for="input-empresa">{{ $errors->first('empresa') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="categoria_id" class="col-sm-2 col-form-label control-label asterisco">Categoría</label>
                                <div class="col-sm-7">
                                    <select class="form-control js-example-basic-single qborder" name="categoria_id" id="categoria_id" ">
                                        <option value="">Seleccione una categoría</option>
                                        @foreach ( $categorias as $row )
                                        @if ($row->estado==0)
                                        @continue
                                        @endif
                                            <option value="{{ $row['id']}}">{{$row['nombre']}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" class="form-control" name="categoria_id" placeholder="Ingrese la categoría"  value="{{old('')}}" autofocus > -->
                                    @if ($errors->has('categoria_id'))
                                    <span class="error text-danger" for="input-categoria_id">{{ $errors->first('categoria_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label control-label asterisco">Dirección</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="Ingrese su dirección" value="{{old('empresa')}}">
                                    @if ($errors->has('direccion'))
                                    <span class="error text-danger" for="input-direccion">{{ $errors->first('direccion') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="telefono" class="col-sm-2 col-form-label control-label asterisco">Teléfono</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="telefono" placeholder="Ingrese el teléfono" value="{{old('telefono')}} " >
                                    @if ($errors->has('telefono'))
                                    <span class="error text-danger" for="input-telefono">{{ $errors->first('telefono') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="email" class="col-sm-2 col-form-label control-label asterisco">Email</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="email" placeholder="Ingrese el email" value="{{old('email')}}"  autofocus >
                                    @if ($errors->has('email'))
                                    <span class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-facebook">Enviar</button>
                            <div class="card-footer ml-auto mr-auto">
                            <a href="{{ route('proveedores.index') }}" class="btn btn-danger ">Cancelar</a>
                        </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

</script>
@endsection
@endsection


