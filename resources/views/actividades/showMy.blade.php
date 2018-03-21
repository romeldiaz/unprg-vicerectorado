@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-2">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action" href="{{ url('actividades/all') }}">Todas</a>
      <a class="list-group-item list-group-item-action active" href="{{ url('actividades/my') }}">Mis Actividades</a>
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

                {{ link_to_action('ActividadController@edit', 'Editar', $actividad->id, ['class'=>'btn btn-sm btn-success mr-1']) }}

                {{ Form::open(['action'=>['ActividadController@destroy', $actividad->id], 'method'=>'DELETE'])}}
                    {{ Form::submit('Borrar', ['class'=>'btn btn-sm btn-secondary']) }}
                {{ Form::close()}}
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
