<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{url('css/style_iconos.css')}}">
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="images/icon.png" alt="" width="30" height="30" alt="icono-unprg">UNPRG
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class="navbar-nav mr-auto">

            <li class="nav-item">
              <a class='nav-link' href="{{ url('/') }}">Tareas</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administrar</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('oficinas') }}">Oficinas</a>
                <a class="dropdown-item" href="{{ url('usuarios') }}">Usuarios</a>
                <a class="dropdown-item" href="{{ url('actividades') }}">Actividades</a>
              </div>
            </li>

          </ul>

        </div>
      </nav>


      @yield('content', 'contenido por defecto')
    </div>

    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->

    @include('layouts.mensaje')
    <script type="text/javascript" src="{{url('js/mensaje.js')}}"></script>
    <script type="text/javascript" src="{{url('js/jquery-3.3.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    @yield('scripts')


  </body>
</html>
