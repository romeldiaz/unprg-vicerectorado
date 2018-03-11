<div class="list-group list-group-flush m-3">
  <a class="list-group-item list-group-item-action bg-light" href="{{ url('perfil') }}"><span class="icon-user mr-2"></span>Perfil</a>
  <a class="list-group-item list-group-item-action bg-light" href="{{ url('dashboard/tareas')}}"><span class="icon-hammer mr-2"></span>Tareas</a>
  <a class="list-group-item list-group-item-action bg-light" href="#"><span class="icon-mail2 mr-2"></span>Mensajes</a>
  <a class="list-group-item list-group-item-action bg-light" href="#"><span class="icon-stats-bars2 mr-2"></span>Progreso</a>
  <a class="list-group-item list-group-item-action bg-light" data-toggle="collapse" href="#administrar-sublist"><span class="icon-cog mr-2"></span>Administrar</a>
  <div class="collapse" id="administrar-sublist">
      <div class="list-group ml-4">
        <a class="list-group-item list-group-item-action bg-light p-1" href="{{ url('actividades') }}">Actividades</a>
        <a class="list-group-item list-group-item-action bg-light p-1" href="{{ url('usuarios') }}">Usuarios</a>
        <a class="list-group-item list-group-item-action bg-light p-1" href="{{ url('oficinas') }}">Oficinas</a>
        <a class="list-group-item list-group-item-action bg-light p-1" href="{{ url('documentos') }}">Documentos</a>
      </div>

  </div>
</div>
