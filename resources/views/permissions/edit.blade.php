@extends('layouts.main', ['activePage' => 'permisos', 'titlePage' => 'Editar Permiso'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('permissions.update', $permission->id)}}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark"><strong>Permiso</strong></h4>
                            <p class="card-category text-dark">Actualizar datos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label for="name" class="col-sm-2 col-form-label ">Nombre:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="name"  value="{{old('name', $permission->name)}}">
                                    @if ($errors->has('name'))
                                    <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto col-md-3">
                            <button type="submit" class="btn btn-facebook">Enviar</button>
                            <div class="">
                                <a href="{{route('permissions.index')}}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>  
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection