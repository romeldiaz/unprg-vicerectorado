@extends('layouts.dashPanel')

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
        <div class="d-flex flex-row-reverse">
          {{ link_to('actividades/create', 'nueva', ['class'=>'btn btn-sm btn-danger m-0'])}}
        </div>
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
        <div class="d-flex flex-row-reverse">
          <div class="form-inline">

            {{ link_to('actividades/'.$actividad->id.'/metas/create', '', ['class'=>'btn btn-sm btn-outline-secondary icon-flag mr-1']) }}

            {{ link_to('actividades/'.$actividad->id, '', ['class'=>'btn btn-sm btn-outline-success icon-eye mr-1']) }}

            {{ link_to('actividades/'.$actividad->id.'/edit', '', ['class'=>'btn btn-sm btn-outline-info icon-pencil mr-1']) }}

            {{ Form::open(['url'=>'actividades/'.$actividad->id, 'class'=>'pull-right']) }}
              {{ Form::hidden('_method', 'DELETE')}}
              <button type="submit" name="button" class="btn btn-sm btn-outline-dark icon-bin mr-1"></button>
            {{ Form::close() }}
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop

@section('scripts')

@stop
