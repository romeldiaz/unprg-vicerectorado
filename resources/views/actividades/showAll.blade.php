@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-2">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" href="{{ url('actividades/all') }}">Todas</a>
      <a class="list-group-item list-group-item-action" href="{{ url('actividades/my') }}">Mis Actividades</a>
    </div>
    <div class="alert alert-warning mt-3" role="alert">
      En la lista de tu derecha son las actividades en las que estas asiganado como responsable,
      no las puedes elimiar ni editar. Puedes crear metas para esta actividad y seleccionar reponsables
      para que te ayuden a cumplirla!
    </div>
  </div>
  <div class="col-10">
    <table class="table table-hover table-sm">
      <thead>
        <tr>
          <th>N°</th>
          <th>Nombre</th>
          <th>Fecha</th>
          <th>Presupuesto</th>
          <th>By</th>
          <th>
            <div class="d-flex flex-row-reverse">
              {{ link_to('actividades/create', 'Crear', ['class'=>'btn btn-sm btn-info']) }}
            </div>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php $num=0; ?>
        @foreach($actividades as $key => $actividad)
        <?php $num++; ?>
        <tr>
          <td>{{$actividad->id}}</td>
          <td>{{$actividad->nombre}}</td>
          <td>{{$actividad->fecha_inicio}}</td>
          <td>{{$actividad->presupuesto}}</td>
          <td>{{$actividad->creador_id}}</td>
          <td>
            <div class="d-flex flex-row-reverse">
              <div class="form-inline">
                {{ link_to_action('ActividadController@show', 'Ver', $actividad->id, ['class'=>'btn btn-sm btn-dark mr-1']) }}
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('script')
  <script src="{{ url('js/actividad.js') }}"></script>
@endsection
