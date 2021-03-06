@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Editar Usuario'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('users.update', $user->id)}}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title text-dark" style="font-weight: 900; font-size:24px">Usuarios</h4>
                            <p class="card-category text-dark" style="font-size:17px">Actualizar datos</p>
                        </div>
                        <div class="card-body">
                            {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif --}}

                            <div class="row">
                                <label for="name" class="col-sm-2 col-form-label ">Nombre:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="name"  value="{{old('name', $user->name)}}">
                                    @if ($errors->has('name'))
                                    <span class="error text-danger" for="input-nombre">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="email" class="col-sm-2 col-form-label ">Email:</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" name="email" value="{{old('email', $user->email)}}">
                                    @if ($errors->has('email'))
                                    <span class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="telefono" class="col-sm-2 col-form-label ">Tel??fono</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="telefono"  value="{{old ('telefono', $user->telefono)}}" autofocus >
                                    @if ($errors->has('telefono'))
                                    <span class="error text-danger" for="input-telefono">{{ $errors->first('telefono') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="direccion" class="col-sm-2 col-form-label ">Direcci??n</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="direccion" placeholder="Ingrese su direcci??n" value="{{old('direccion', $user->direccion)}}">
                                    @if ($errors->has('direccion'))
                                    <span class="error text-danger" for="input-direccion">{{ $errors->first('direccion') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="password" class="col-sm-2 col-form-label ">Contrase??a:</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password" placeholder="ingrese contrase??a si desea modificarla">
                                    @if ($errors->has('password'))
                                    <span class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label for="name" class="col-sm-2 col-form-label ">Roles</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <div class="tab-content">
                                            <div class="tab-pane active">
                                                <table class="table">
                                                    <tbody>
                                                        @foreach ($roles as $id => $role)
                                                        <tr>
                                                            <td>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input class="form-check-input" type="radio" name="roles[]"
                                                                        value="{{ $id }}" {{ $user->roles->contains($id) ? 'checked' : ''}}>
                                                                        <span class="form-check-sign">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{ $role}}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($user->id !=1)
                            <div class="row">
                                <label for="email" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="estado" id="estado">

                                            @if($user->estado==1)


                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</<option>

                                            @else

                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</<option>

                                        @endif
                                    {{-- </option>
                                        <option value="0">Inactivo</<option>
                                        <option value="1">Activo</option>
                                    --}}
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-footer ml-auto mr-auto col-md-3">
                            <button type="submit" class="btn btn-facebook">Enviar</button>
                            <div class="">
                                <a href="{{route('users.index')}}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
