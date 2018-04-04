<li class="dropdown notifications-menu">
  <!-- Menu toggle button -->
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <?php
    $notificaciones = \App\Notificacion::where('to', Auth::user()->id)->where('checked', 0)->get();
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
            @if($notificacion->type == 'Actividad')
              <i class="fa fa-sitemap text-blue"></i> {{ $notificacion->title }}
            @elseif($notificacion->type == 'Meta')
              <i class="fa fa-flag text-red"></i> {{ $notificacion->title }}
            @elseif($notificacion->type == 'Monitoreo')
              <i class="fa fa-binoculars text-yellow"></i> {{ $notificacion->title }}
              @elseif($notificacion->type == 'Responsable')
                <i class="fa fa-user-plus text-green"></i> {{ $notificacion->title }}
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
