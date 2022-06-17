<div class="sidebar" data-color="azure" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a class="simple-text logo-normal text-info">
      {{ __('MERSOFT') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Menú') }}</p>
        </a>
      </li>
      @can('rol_listar')
      <li class="nav-item {{ ($activePage == 'recent_actors' ) ? ' active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#configuracion" aria-expanded="false" aria-controls="configuracion">
        <i class="material-icons">settings_suggest</i>
          <p>{{ __('Configuraciones') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="configuracion">
          <ul class="nav">

            <li class="nav-item{{ $activePage == 'roles' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('roles.index')}}">
                <i class="material-icons">recent_actors</i>
                  <p>{{ __('Roles') }}</p>
              </a>
            </li>

          </ul>
        </div>
      </li>@endcan
      @can('usuario_listar')
      <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#usuarios" aria-expanded="false" aria-controls="usuarios">
          <i class="material-icons">person</i>
            <p>{{ __('Usuarios') }}
              <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="usuarios">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">              <a class="nav-link" href="{{route('users.index')}}">
                <i class="material-icons">account_circle</i>
                  <p>{{ __('Usuario') }}</p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endcan
      <li class="nav-item{{ $activePage == 'user' ? ' active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#Compras" aria-expanded="false" aria-controls="Compras">
          <i class="material-icons">shopping_bag</i>
            <p>{{ __('Compras') }}
              <b class="caret"></b>
            </p>
        </a>

        <div class="collapse" id="Compras">
          <ul class="nav">
            @can('categoria_listar')
            <li class="nav-item{{ $activePage == 'categorias' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('categorias.index')}}">
                <i class="material-icons">receipt_long</i>
                  <p>{{ __('Categorías') }}</p>
              </a>
            </li>
            @endcan
            @can('producto_listar')
            <li class="nav-item{{ $activePage == 'productos' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('productos.index')}}">
                <i class="material-icons">view_in_ar</i>
                  <p>{{ __('Productos') }}</p>
              </a>
            </li>
            @endcan
            @can('proveedor_listar')
            <li class="nav-item{{ $activePage == 'proveedores' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('proveedores.index') }}">
                <i class="material-icons">settings_accessibility</i>
                  <p>{{ __('Proveedores') }}</p>
              </a>
            </li>
            @endcan
            @can('compra_listar')
            <li class="nav-item{{ $activePage == 'compras' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('compras.index')}}">
                <i class="material-icons">shopping_basket</i>
                <p>{{ __('Compras') }}</p>
              </a>
            </li>
            @endcan
            @can('compra_informe')
            <li class="nav-item{{ $activePage == 'informes' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('compras.charts')}}">
                <i class="material-icons">bar_chart</i>
                <p>{{ __('Informes') }}</p>
              </a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'user' ? ' active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#Ventas" aria-expanded="false" aria-controls="Ventas">
          <i class="material-icons">person</i>
            <p>{{ __('Ventas') }}
              <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="Ventas">
          <ul class="nav">
          @can('cliente_listar')
            <li class="nav-item{{ $activePage == 'clientes' ? ' active' : '' }}">
              <a class="nav-link" href={{route('clientes.index') }}>
                <i class="material-icons">supervisor_account</i>
                  <p>{{ __('Clientes') }}</p>
              </a>
            </li>
          @endcan
          @can('pedido_listar')
            <li class="nav-item{{ $activePage == 'pedidos' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('pedidos.index')}}">
                <i class="material-icons">shopping_cart</i>
                <p>{{ __('Pedidos') }}</p>
              </a>
            </li>
          @endcan
          @can('venta_listar')
            <li class="nav-item{{ $activePage == 'ventas' ?' active' : '' }}">
              <a class="nav-link" href="{{route('ventas.index')}}">
                <i class="material-icons">currency_exchange</i>
                <p>{{ __('Ventas') }}</p>
              </a>
            </li>
            @endcan
          @can('venta_informe')
            <li class="nav-item{{ $activePage == 'informesv' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('ventas.charts')}}">
                <i class="material-icons">bar_chart</i>
                <p>{{ __('Informes') }}</p>
              </a>
            </li>
          @endcan
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'ayuda_linea' ? ' active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#ayuda_linea" aria-expanded="false" aria-controls="ayuda_linea">
          <i class="material-icons">video_settings</i>
            <p>{{ __('Ayuda en linea') }}
              <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="ayuda_linea">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'ayuda_linea' ? ' active' : '' }}"><a class="nav-link" href="#">
                <i class="material-icons">settings_suggest</i>
                  <p>{{ __('Configuraciones') }}</p>
              </a>
            </li>
          </ul>
        </div>
        <div class="collapse" id="ayuda_linea">
            <ul class="nav">
              <li class="nav-item{{ $activePage == 'ayuda_linea' ? ' active' : '' }}"><a class="nav-link" href="#">
                  <i class="material-icons">person</i>
                    <p>{{ __('Usuarios') }}</p>
                </a>
              </li>
            </ul>
          </div>
          <div class="collapse" id="ayuda_linea">
            <ul class="nav">
              <li class="nav-item{{ $activePage == 'ayuda_linea' ? ' active' : '' }}"><a class="nav-link" href="#">
                  <i class="material-icons">shopping_bag</i>
                    <p>{{ __('Compras') }}</p>
                </a>
              </li>
            </ul>
          </div>
          <div class="collapse" id="ayuda_linea">
            <ul class="nav">
              <li class="nav-item{{ $activePage == 'ayuda_linea' ? ' active' : '' }}"><a class="nav-link" href="#">
                  <i class="material-icons">real_estate_agent</i>
                    <p>{{ __('Ventas') }}</p>
                </a>
              </li>
            </ul>
          </div>
      </li>
    </ul>
  </div>
</div>
