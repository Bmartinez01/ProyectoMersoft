@extends('layouts.main', ['activePage' => 'roles', 'titlePage' => 'Agregar Rol'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('roles.index')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark"><strong>Roles</strong></h4>
                            <p class="card-category text-dark">Ingresar datos</p>
                        </div>
                            <div class="card-body">
                            <div class="row">
                                <label for="name" class="col-sm-3 col-form-label control-label asterisco">Nombre del Rol</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" name="name" >
                                @if ($errors->has('name'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="card-footer ml-auto mr-auto col-md-3">
                        <button type="submit" class="btn btn-facebook">Enviar</button>
                        <div class="">
                            <a href="{{route('roles.index')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
