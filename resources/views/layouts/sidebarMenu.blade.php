<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MENU</li>
  <!-- Optionally, you can add icons to the links -->


  <li class="@yield('sidebar-page-actividades', 'treeview')">
    <a href="#"><i class="fa fa-magic"></i> <span>Actividades</span>
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
  </a>
    <ul class="treeview-menu">
      @if(Auth::user()->tipo=='admin')
      <li class="@yield('sidebar-page-actividades-todas', '')"><a href="{{ url('actividades/todas') }}"><i class="fa fa-circle-o"></i> <span>Todas</span></a></li>
      @endif
      <li class="@yield('sidebar-page-actividades-asignaciones', '')"><a href="{{ url('actividades/asignaciones') }}"><i class="fa fa-circle-o"></i> <span>Asignaciones</span></a></li>
      <li class="@yield('sidebar-page-actividades-creaciones', '')"><a href="{{ url('actividades/creaciones') }}"><i class="fa fa-circle-o"></i> <span>Creaciones</span></a></li>
      <li class="@yield('sidebar-page-actividades-monitoreos', '')"><a href="{{ url('actividades/monitoreos')}}"><i class="fa fa-circle-o"></i> <span>Monitoreos</span></a></li>
    </ul>
  </li>
  @if(Auth::user()->tipo=='admin')
  <li class="@yield('sidebar_page_usuarios', '')"><a href="{{ url('users') }}"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>
  <li class="@yield('sidebar_page_oficina', '')"><a href="{{ url('oficinas') }}" }}><i class="fa fa-institution"></i> <span>Oficinas</span></a></li>
  <li class="@yield('sidebar_page_config', '')"><a href="#" }}><i class="fa fa-link"></i> <span>Config</span></a></li>
  @endif

</ul>
