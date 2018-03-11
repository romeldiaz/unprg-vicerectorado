@extends('layouts.dashPanel')

@section('content')
  <div class="row">
    <div class="col col-sm-12">
      <div class="progress">
        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </div>
    <div class="col col-sm-12">
      Meta :: {{ $meta->nombre }}
      <div class="row">
        <div class="col col-sm-4">
          @if(isset($tarea))
            @include('monitoreos.edit')
          @else
            @include('monitoreos.create')
          @endif
        </div>
        <div class="col col-sm-8">
          <table class="table table-hover table-sm">
            <thead>
              <tr>
                <th>N°</th>
                <th>Fecha</th>
                <th>Descripcion</th>
                <th>Observacion</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($monitoreos as $key => $monitoreo)
                <tr>
                  <td>{{ $monitoreo->id }}</td>
                  <td>{{ $monitoreo->fecha }}</td>
                  <td>{{ $monitoreo->descripcion }}</td>
                  <td>{{ $monitoreo->observacion }}</td>
                  <td>
                    <div class="d-flex flex-row-reverse">
                      {{ Form::open(['action'=>['MonitoreoController@destroy', $monitoreo->id], 'method'=>'DELETE']) }}
                        {{ Form::submit('Borrar', ['class'=>'btn btn-sm btn-seconday']) }}
                      {{ Form::close() }}

                      {{ link_to_action('MonitoreoController@edit', 'Editar', $monitoreo->id, ['class'=>'btn btn-sm btn-success mr-2']) }}

                      {{ Form::open(['url'=>'monitoreos/edit']) }}
                        {{ Form::hidden('meta_id', $meta->id) }}
                        {{ Form::hidden('monitoreo_id', $monitoreo->id) }}
                        <button type="submit" name="button">Editar</button>
                      {{ Form::close() }}
                    </div>
                  </td>
                </tr>
              @endforeach


            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
@stop

@section('scripts')

@stop
