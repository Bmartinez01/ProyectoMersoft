<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand">{{ $titlePage }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <form class="navbar-form">
        <div class="input-group no-border">
        <input type="hidden" value="" class="form-control" placeholder="Search...">
        </div>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              {{ __('Account')}}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <label style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px" class="dropdown-item">{{Auth::user()->name}}</label>
            <a type="button" href="#"class="dropdown-item" data-bs-toggle="modal" data-bs-target="#f">Ver Perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Cerrar sesión') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="modal fade" id="f" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ver información del usuario: {{Auth::user()->name}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form >
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Nombre:</label>
                <input class="form-control" id="message-text" readonly value="{{Auth::user()->name}}">
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Celular:</label>
                <input class="form-control" id="message-text" readonly value="{{Auth::user()->telefono}}">
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Dirección:</label>
                <input class="form-control" id="message-text" readonly value="{{Auth::user()->direccion}}">
              </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Email:</label>
              <input class="form-control" id="message-text" readonly value="{{Auth::user()->email}}">
            </div>
          </form>
        </div>
        <div class="modal-footer">
            <div class="col-12 text-center">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
      </div>
    </div>
  </div>
