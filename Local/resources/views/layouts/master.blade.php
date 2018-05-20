<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APP</title>

  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="fonts/glyphicons-halflings-regular.eot">
  <link rel="stylesheet" href="fonts/glyphicons-halflings-regular.svg">
  <link rel="stylesheet" href="fonts/glyphicons-halflings-regular.ttf">
  <link rel="stylesheet" href="fonts/glyphicons-halflings-regular.woff">
  <link rel="stylesheet" href="fonts/glyphicons-halflings-regular.woff2">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

 
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{asset('#')}}">App fotos</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

       <ul class="nav navbar-nav">
          @if ((Session::get('idUser')))
          <li><a href="{{ asset('mostrarMisAlbumes') }}">Mis Álbumes</a></li>
          @if(Session::get('type')=='A')
          <li><a href="{{ asset('MostrarUsuarios') }}">Gestionar Datos</a></li>
          @else
          <li><a href="{{ asset('MostrarUsuarios') }}">Explorar Datos</a></li>
          @endif
          @endif
        </ul>


        <ul class="nav navbar-nav navbar-right">
          @if (!(Session::get('idUser')))
            <li><a href="{{ asset('inicioSesion') }}">Iniciar Sesión</a></li>
            <li><a href="{{ asset('reg') }}">Registrarse</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Session::get('name') }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ asset('logout') }}">Salir</a></li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <!-- Scripts -->
  <!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script> -->
</body>
</html>
