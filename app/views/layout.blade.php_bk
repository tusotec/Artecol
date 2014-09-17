<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Artecol - @yield('title')</title>
    <style type="text/css">
      .menu_principal {

      }
      .menu_principal > li {
        float: left;
        display: block;
        list-style: none;
        width: 100px;
      }
      .menu_principal > li > ul {
        margin: 0px;
        padding: 0px;
        list-style: none;
      }
    </style>
    @yield('header')
  </head>
  <body>
    <header>
      <!-- Aqui el Header (obvio?) -->
    </header>
    <nav>
      @if (Auth::check())
        <ul class="menu_principal">
          <li>Usuarios
            <ul>
              <li>{{link_to_route('users.index', 'Lista')}}</li>
              <li>{{link_to_route('users.create', 'Nuevo')}}</li>
              <li>{{link_to_route('users.login', 'Ingresar')}}</li>
              <li>{{link_to_route('users.logout', 'Salir')}}</li>
              <li>{{Auth::user()->username}}</li>
            </ul>
          </li>
          <li>Materiales
            <ul>
              <li>{{link_to_route('materiales.index', 'Lista')}}</li>
              <li>{{link_to_route('materiales.create', 'Nuevo')}}</li>
              <li>{{link_to_route('materiales_categorias.index', 'Categorias')}}</li>
            </ul>
          </li>
          <li>Modulos
            <ul>
              <li>{{link_to_route('modulos.index', 'Lista')}}</li>
              <li>{{link_to_route('modulos.create', 'Nuevo')}}</li>
              <li>{{link_to_route('modulos_categorias.index', 'Categorias')}}</li>
            </ul>
          </li>
          <li>Clientes
            <ul>
              <li>{{link_to_route('clientes.index', 'Lista')}}</li>
              <li>{{link_to_route('clientes.create', 'Nuevo')}}</li>
            </ul>
          </li>
          <li>Presupuestos
            <ul>
              <li>{{link_to_route('presupuestos.index', 'Lista')}}</li>
              <li>{{link_to_route('presupuestos.create', 'Nuevo')}}</li>
            </ul>
          </li>
        </ul>
        <div style="clear: left;"></div>
      @endif
    </nav>

    <p>{{json_encode(Input::all())}}</p>
    @if ($errors->any())
      <section id="errores">
        Errores..
        <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
        </ul>
      </section>
    @endif
    
    <div>
      @yield('content')
    </div>

    <footer>
      <!-- Aqui el Footer (...) -->
    </footer>
  </body>
</html>