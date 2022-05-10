@extends('layouts.main', ['activePage' => 'productos', 'titlePage' => 'Editar Producto'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('productos.update', $producto->id)}}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Productos</h4>
                            <p class="card-category text-dark" style="font-size:17px">Editar datos</p>
                        </div>
                            <div class="card-body">
                                <div class="row">
                                <label for="Código" class="col-sm-2 col-form-label control-label asterisco">Código</label>
                                    <div class="col-sm-7">
                                    <input type="number" class="form-control" name="Código" placeholder="Ingrese su Código" value="{{old('Código',$producto-> Código)}}" autofocus>
                                    @if ($errors->has('Código'))
                                    <span class="error text-danger" for="input-Código">{{ $errors->first('Código') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="Nombre" class="col-sm-2 col-form-label control-label asterisco">Nombre</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" name="Nombre" placeholder="Ingrese su Nombre" value="{{old('Nombre',$producto-> Nombre)}}">
                                @if ($errors->has('Nombre'))
                                <span class="error text-danger" for="input-Nombre">{{ $errors->first('Nombre') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label for="Categorías" class="col-sm-2 col-form-label control-label asterisco">Categorías</label>
                            <div class="col-sm-7">
                                <select class="form-control js-example-basic-single" name="Categorías" id="Categorías">
                                   <option  value="{{old('Categorías',$producto->Categorías)}}">Seleccione solo para modificar</option>
                                    @foreach ( $categorias as $row )
                                        @if ($row->estado==0)
                                            @continue
                                        @endif

                                        <option @if ($row->id==$producto->Categorías)
                                            selected="true"
                                        @endif

                                         value="{{$row->id}}">{{$row->nombre}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('Categorías'))
                                <span class="error text-danger" for="input-Categorías">{{ $errors->first('Categorías') }}</span>
                                @endif
                            {{-- <input type="select" class="form-control" name="Categorías" placeholder="Ingrese su Categorías" value="{{old('Categorías',$categorias, $producto-> Categorías)}}"> --}}

                        </div>
                    </div>
                    <div class="row">
                        <label for="Stock" class="col-sm-2 col-form-label control-label asterisco">Stock</label>
                        <div class="col-sm-7">
                        <input type="number" class="form-control" name="Stock" placeholder="Ingrese su Stock" value="{{old('Stock' ,$producto-> Stock)}}">
                        @if ($errors->has('Stock'))
                        <span class="error text-danger" for="input-Stock">{{ $errors->first('Stock') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <label for="Precio" class="col-sm-2 col-form-label control-label asterisco">Precio</label>
                    <div class="col-sm-7">
                    <input type="money" class="form-control" name="Precio" placeholder=" Ingrese el Precio" value="{{old('Precio' ,$producto-> precio)}}">
                    @if ($errors->has('Precio'))
                    <span class="error text-danger" for="input-Precio">{{ $errors->first('Precio') }}</span>
                    @endif
            </div>
        </div>
        <div class="row">
            <label for="email" class="col-sm-2 col-form-label">Estado</label>
            <div class="col-sm-7">
                <select class="form-control" name="estado" id="estado">

                        @if($producto->estado==1)


                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>

                        @else

                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>

                    @endif
                {{-- </option>
                    <option value="0">Inactivo</<option>
                    <option value="1">Activo</option>
                 --}}
                </select>
          </div>
        </div>
    <div class="card-footer ml-auto mr-auto col-md-4">
        <button type="submit" class="btn btn-facebook">Actualizar</button>
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
@endsection

