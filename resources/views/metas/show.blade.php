@extends('layouts.dashPanel')

@section('content')
  <div class="row">
    <div class="col col-sm-6">
      <p>Nombre: {{ $meta->nombre }}</p>
      <p>Producto: {{ $meta->nombre }}</p>
      <p>inicio: {{ $meta->fecha_inicio_esperada }}</p>
      <p>Final: {{ $meta->fecha_fin_esperada }}</p>
    </div>
    <div class="col col-sm-6">
      <table class="table table-sm">
        <thead>
          <tr>
            <th>N°</th>
            <th>Responsables</th>
            <th>Oficina</th>
            <th>Info</th>
          </tr>
        </thead>
        <tbody>
          @foreach($responsables as $key => $responsable)
            <tr>
              <td>{{ $responsable->id }}</td>
              <td>{{ $responsable->nombre.' '.$responsable->paterno.' '.$responsable->materno }}</td>
              <td>{{ $responsable->nombre_oficina }}</td>
              <td>Informacion personal</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop

@section('scripts')
  <script type="text/javascript" src="{{url('js/meta.js')}}"></script>
@stop
