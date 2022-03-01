@extends('layouts.main', ['activePage' => 'categorias', 'titlePage' => 'Agregar Categoria'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('categorias.store')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark"><strong>Categoria</strong></h4>
                            <p class="card-category text-dark">Ingresar datos</p>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <label for="documento" class="col-sm-2 col-form-label control-label asterisco">Nombre</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre" value="{{ old('nombre')}}"  autofocus >
                                    @if ($errors->has('nombre'))
                                    <span class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto col-md-3">
                            <button type="submit" class="btn btn-facebook">Enviar</button>
                            <div class="card-footer ml-auto mr-auto">
                            <a href="{{route('categorias.index')}}" class="btn btn-danger ">Cancelar</a>
                        </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
