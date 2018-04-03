<li class="dropdown notifications-menu">
  <!-- Menu toggle button -->
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <?php
    $notificaciones = \App\Notificacion::where('user_id', Auth::user()->id)->where('read', 0)->get();
  ?>
      <i class="fa fa-bell-o"></i>
      <span class="label label-warning">{{ count($notificaciones) }}</span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">Tienes {{ count($notificaciones) }} notificaciones</li>
    <li>
      <!-- Inner Menu: contains the notifications -->
      <ul class="menu">
        @if(count($notificaciones)!=0) @foreach($notificaciones as $key => $notificacion)
        <li>
          <!-- start notification -->
          <a href="{{ url('notificaciones/'.$notificacion->id) }}">
            @if($notificacion->tipo == 'Actividad')
              <i class="fa fa-sitemap text-aqua"></i> Nueva actividad creada
            @elseif($notificacion->tipo == 'Meta')
              <i class="fa fa-flag text-red"></i> Nueva meta creada
            @elseif($notificacion->tipo == 'Monitoreo')
              <i class="fa fa-eye text-yellow"></i> Monitoreo asignado
            @endif
          </a>
        </li>
        @endforeach @else
        <li>
          <!-- start notification -->
          <a href="#">
          <i class="fa fa-users text-aqua"></i> No tienes nuevas notificaciones
        </a>
        </li>
        @endif
        <!-- end notification -->
      </ul>
    </li>
    <li class="footer"><a href="{{ url('notificaciones') }}">View all</a></li>
  </ul>
</li>
