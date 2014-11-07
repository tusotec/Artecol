<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

{{ HTML::script('assets/js/jquery.js') }}
{{ HTML::script('assets/js/bootstrap.min.js') }}
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <title>Artecol - @yield('title')</title>
    {{ HTML::style('assets/css/bootstrap-theme.min.css') }}
	 {{ HTML::style('assets/css/bootstrap.min.css') }}
	 {{ HTML::style('assets/css/master.css') }}
   
    <!--[if lt IE 9]>
	
	 <!-- Bootstrap -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	@yield('header')
	
  </head>
  <body>
 
<!-- scripts
{{ HTML::script('assets/js/jquery.js') }}
{{ HTML::script('assets/js/bootstrap.min.js') }} -->

<!-- scripts -->  
    <header>
	<div id="head">
      <!-- Aqui el Header (obvio?) -->
    </header>
	
	<div id='cssmenu'>
<ul class="menu_principal">
   <li class='active has-sub'><a href='#'><span>Usuarios</span></a>
       <ul>
              <li>{{link_to_route('users.index', 'Lista')}}</li>
              <li>{{link_to_route('users.create', 'Nuevo')}}</li>
              <li>{{link_to_route('users.login', 'Ingresar')}}</li>
              <li>{{link_to_route('users.logout', 'Salir')}}</li>
            </ul>
   <li class='active has-sub'><a href='#'><span>Materiales</span></a>
            <ul>
              <li>{{link_to_route('materiales.index', 'Lista')}}</li>
              <li>{{link_to_route('materiales.create', 'Nuevo')}}</li>
              <li>{{link_to_route('materiales_categorias.index', 'Categorias')}}</li>
            </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>Módulos</span></a>
                 <ul>
              <li>{{link_to_route('modulos.index', 'Lista')}}</li>
              <li>{{link_to_route('modulos.create', 'Nuevo')}}</li>
              <li>{{link_to_route('modulos_categorias.index', 'Categorias')}}</li>
            </ul>
    </li>
	 <li class='active has-sub'><a href='#'><span>Clientes</span></a>
     <ul>
              <li>{{link_to_route('clientes.index', 'Lista')}}</li>
              <li>{{link_to_route('clientes.create', 'Nuevo')}}</li>
            </ul>
    </li> <li class='active has-sub'><a href='#'><span>Presupuestos</span></a>
   <ul>
              <li>{{link_to_route('presupuestos.index', 'Lista')}}</li>
              <li>{{link_to_route('presupuestos.create', 'Nuevo')}}</li>
            </ul>
    </li>
</ul>
</div>
	
	
  
    <div id="contenido">
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
    
      @yield('content')
    </div>
	
	
    <footer>
      <!-- Aqui el Footer (...) -->
    </footer>
  </body>
</html>