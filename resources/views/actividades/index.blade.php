@extends('layouts.master')

@section('content')

<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>N°</th>
      <th>Fecha</th>
      <th>Nombre</th>
      <th>Presupuesto</th>
      <th>Estado</th>
      <th>
        {{ link_to('actividades/create', 'nueva', ['class'=>'btn btn-sm btn-danger m-0'])}}
      </th>
    </tr>
  </thead>
  <tbody>
    <?php $num =0; ?>
    @foreach($actividades as $key => $actividad)
    <?php $num++ ?>
    <tr>
      <td>{{ $actividad->id }}</td>
      <td>{{ $actividad->fecha_inicio }}</td>
      <td>{{ $actividad->nombre }}</td>
      <td>{{ $actividad->presupuesto }}</td>
      <td style="width: 200px" >
        <div class="progress" >
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
        </div>
      </td>
      <td>
        <div class="form-inline">
          {{ Form::open(['url'=>'actividades/'.$actividad->id, 'class'=>'pull-right']) }}
            {{ Form::hidden('_method', 'DELETE')}}
            {{ Form::submit('Borrar', ['class'=>'btn btn-sm btn-info mr-1']) }}
          {{ Form::close() }}

          {{ link_to('actividades/'.$actividad->id, 'ver', ['class'=>'btn btn-sm btn-info mr-1']) }}
          {{ link_to('actividades/'.$actividad->id.'/edit', 'editar', ['class'=>'btn btn-sm btn-info mr-1']) }}
        </div>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop

@section('scripts')

@stop
