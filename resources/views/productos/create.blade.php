@extends('layouts.main', ['activePage' => 'Producto', 'titlePage' => 'Agregar Producto'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action= "{{route('productos.store')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Productos</h4>
                            <p class="card-category text-dark" style="font-size:17px">Ingresar datos</p>
                        </div>
                           <div class="card-body">
                               <!--  {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif --}} -->
                                {{-- <div class="row">
                                    <label for="Código" class="col-sm-2 col-form-label control-label asterisco">Código</label>
                                    <div class="col-sm-7">
                                    <input type="number" class="form-control" name="Código" placeholder="Ingrese su Código" value="{{old('Código')}}" autofocus>
                                    @if ($errors->has('Código'))
                                    <span class="error text-danger" for="input-Código">{{ $errors->first('Código') }}</span>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="row">
                                <label for="Nombre" class="col-sm-2 col-form-label control-label asterisco">Nombre</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" name="Nombre" placeholder="Ingrese su Nombre" value="{{old('Nombre')}}">
                                @if ($errors->has('Nombre'))
                                <span class="error text-danger" for="input-Nombre">{{ $errors->first('Nombre') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label for="Categorías" class="col-sm-2 col-form-label control-label asterisco">Categorías</label>
                            <div class="col-sm-7">
                                <select class="form-control js-example-basic-single" name="Categorías" id="Categorías">
                                    <option value="">Seleccione la categoría</option>
                                    @foreach ( $categorias as $row )
                                    @if ($row->estado==0)
                                    @continue
                                    @endif
                                    <option value="{{$row->id}}">{{$row->nombre}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('Categorías'))
                                <span class="error text-danger" for="input-Categorías">{{ $errors->first('Categorías') }}</span>
                                @endif
                        </div>
                    </div>
                    <div class="row">
                        <label for="unidad" class="col-sm-2 col-form-label control-label asterisco">Unidad</label>
                        <div class="col-sm-7">
                            <select class="form-control" name="unidad" id="unidad">
                                <option value="">Seleccione la unidad</option>
                                <option value="unidad(es)">Unidad(es)</option>
                                <option value="gramos">Gramos</option>
                                <option value="libra(s)">Libra(s)</option>
                                <option value="kilo(s)">Kilo(s)</option>
                                <option value="litro(s)">Litro(s)</option>
                                <option value="mililitros">Mililitros</option>

                            </select>
                            @if ($errors->has('unidad'))
                            <span class="error text-danger" for="input-unidad">{{ $errors->first('unidad') }}</span>
                            @endif
                    </div>
                </div>
                <div class="row">
                    <label for="Precio" class="col-sm-2 col-form-label control-label asterisco">Precio</label>
                    <div class="col-sm-7">
                    <input type="money" min="0.00" max="100000000.00" step="0.01" class="form-control" name="Precio" placeholder=" Ingrese el Precio" value="{{old('Precio')}}">
                    @if ($errors->has('Precio'))
                    <span class="error text-danger" for="input-Precio">{{ $errors->first('Precio') }}</span>
                    @endif
                </div>
            </div>
    </div>
    <div class="card-footer ml-auto mr-auto col-md-3">
        <button type="submit" class="btn btn-facebook">Enviar</button>
        <div class="">
            <a href="{{route('productos.index')}}" class="btn btn-danger">Cancelar</a>
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
