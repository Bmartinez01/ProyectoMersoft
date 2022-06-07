@extends('layouts.main', ['activePage' => 'proveedores', 'titlePage' => 'Editar Proveedor'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('proveedores.update', $proveedore->id) }}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Proveedores</h4>
                            <p class="card-category text-dark" style="font-size:17px">Editar datos</p>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <label for="nit_empresa" class="col-sm-2 col-form-label ">Nit Empresa</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nit_empresa" readonly value="{{ old('nit_empresa', $proveedore->nit_empresa )}}" autofocus >
                                    @if ($errors->has('nit_empresa'))
                                    <span class="error text-danger" for="input-nit_empresa">{{ $errors->first('nit_empresa') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label ">Nombre</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre"  value="{{ old('nombre', $proveedore->nombre )}}" autofocus >
                                    @if ($errors->has('nombre'))
                                    <span class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="apellido" class="col-sm-2 col-form-label ">Apellido</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="apellido" value="{{ old('apellido', $proveedore->apellido )}}"  autofocus >
                                    @if ($errors->has('apellido'))
                                    <span class="error text-danger" for="input-apellido">{{ $errors->first('apellido') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="empresa" class="col-sm-2 col-form-label ">Empresa</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="empresa" value="{{ old('empresa', $proveedore->empresa )}}"  autofocus >
                                    @if ($errors->has('empresa'))
                                    <span class="error text-danger" for="input-empresa">{{ $errors->first('empresa') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="categoria_id" class="col-sm-2 col-form-label ">Categoría</label>
                                <div class="col-sm-7">
                                    <select class="form-control js-example-basic-single" name="categoria_id" id="categoria_id">
                                        <option value="{{old('categoria_id', $proveedore->categoria_id )}}">Seleccione solo para modificar</option>
                                        @foreach ( $categorias as $row )
                                            @if ($row->estado==0)
                                                @continue
                                            @endif
                                            <option @if ($row['id']==$proveedore->categoria_id)
                                                selected="true"
                                            @endif value="{{ $row['id']}}">{{$row['nombre']}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" class="form-control" name="categoria_id" value="{{ old('categoria_id', $proveedore->categoria_id )}}" autofocus > -->
                                    @if ($errors->has('categoria_id'))
                                    <span class="error text-danger" for="input-categoria_id">{{ $errors->first('categoria_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label ">Dirección</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $proveedore->direccion )}}"  autofocus >
                                    @if ($errors->has('direccion'))
                                    <span class="error text-danger" for="input-direccion">{{ $errors->first('direccion') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="telefono" class="col-sm-2 col-form-label ">Teléfono</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="telefono" value="{{ old('telefono', $proveedore->telefono )}}" autofocus >
                                    @if ($errors->has('telefono'))
                                    <span class="error text-danger" for="input-telefono">{{ $errors->first('telefono') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="email" class="col-sm-2 col-form-label ">Correo</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="email" value="{{ old('email', $proveedore->email )}}" autofocus >
                                    @if ($errors->has('email'))
                                    <span class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="estado" id="estado">

                                            @if($proveedore->estado==1)


                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</<option>

                                            @else

                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</<option>

                                        @endif

                                    </select>
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



