@extends('layouts.dashpanel')

@section('content')
  {{$actividad->nombre}}
  <div class="row">
    <div class="col col-sm-4">
      actividad
    </div>

    <div class="col col-sm-4">
      <table class="table table-sm">
        <thead>
          <tr>
            <th>N</th>
            <th>Responsable</th>
          </tr>
        </thead>
        <tbody>
          @foreach($responsables as $key => $responsable)
            <tr>
              <td>{{ $responsable->id }}</td>
              <td>{{ $responsable->nombre }}</td>
            </tr>
          @endforeach()
        </tbody>
      </table>
    </div>

    <div class="col col-sm-4">
      <table class="table table-sm">
        <thead>
          <tr>
            <th>N</th>
            <th>Meta</th>
            <th>
              {{ link_to('actividades/'.$actividad->id.'/metas/create','', ['class'=>'btn btn-sm btn-info icon-cog']) }}
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($metas as $key => $meta)
            <tr>
              <td>{{ $meta->id }}</td>
              <td colspan="2">{{ $meta->nombre }}</td>
            </tr>
          @endforeach()

        </tbody>
      </table>

    </div>
  </div>
@stop

@section('scripts')

@stop
