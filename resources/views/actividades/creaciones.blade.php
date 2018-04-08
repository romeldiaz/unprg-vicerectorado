@extends('layouts.main')

@section('sidebar-page-actividades', 'active treeview')
@section('sidebar-page-actividades-creaciones', 'active')

@section('content')
<div class="row">
  <div class="col col-sm-12">
    <div class="box">
      <div class="box-header with-border">
        <div class="box-title">
          Actividades Creadas
          <a href="{{ url('actividades/create') }}" class="btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
        </div>
        <div class="box-tools">
        </div>
      </div>
      <div class="box-body table-responsive">
        <table class="table custom_datatable table-hover" id='creaciones_table'>
          <thead>
            <tr>
              <th>N°</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th>Presupuesto</th>
              <th>Estado</th>
              <th>Tiempo</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($actividades as $key => $actividad)
              <?php
                  $meta_success=false;//para pintar fila si la meta esta cumplida
                  $metas = count($actividad->metas) ;
                  $metasCumplidas = count($actividad->metas->where('estado', 'F'));
                  $imprimirfila = "";
                  $estilofila = "x";
                  if($metas==0){
                    $imprimirfila = '<span class="label label-warning"><i class="fa fa-clock-o"></i> Pendiente</span>';
                  }elseif($metas==$metasCumplidas){
                    $meta_success=true;
                    $imprimirfila = '<span class="label label-success"><i class="fa fa-trophy"></i> Finalizado</span>';
                  }else{
                    $imprimirfila = '<span class="label label-info"><i class="fa fa-circle-o-notch"></i> En proceso</span>';
                  }
              ?>
              <tr class="{{ $meta_success?'success':''}}">
                <td>{{$actividad->id}}</td>
                <td>{{$actividad->nombre}}</td>
                <td>{{$actividad->fecha_inicio}}</td>
                <td>{{$actividad->presupuesto}}</td>
                <td>{!!$imprimirfila!!}</td>
                <td>
                  <div class="col col-sm-12">
                      <div class="progress" style="margin:0">
                        <div class="progress-bar progress-bar-striped @if($actividad->porcentaje()<70) avance-green @elseif($actividad->porcentaje()<100) avance-yellow @else avance-red @endif" role="progressbar" style="width:{{$actividad->porcentaje()}}%" aria-valuenow="{{$actividad->porcentaje()}}" aria-valuemin="0" aria-valuemax="100">{{$actividad->porcentaje()}}%</div>
                      </div>
                    </div>
                </td>
                <td class="text-right">
                  {{ Form::open(['action'=>['ActividadController@destroy', $actividad->id], 'method'=>'DELETE', 'style'=>'margin:0'])}}
                    <a href="{{ url('actividades/'.$actividad->id) }}" class="btn btn-xs btn-flat btn-warning"><i class="fa fa-eye"></i></a>
                    <a href="{{ url('actividades/'.$actividad->id.'/edit') }}" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil"></i></a>
                    <button type="submit" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i></button>
                  {{ Form::close()}}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>



</div>
@endsection

@section('script')
  <script src="{{ url('js/comun.js') }}"></script>
  <script src="{{ url('js/custom_datatable.js') }}"></script>
  <script>
    noSortableTable(0, [6]);
  </script>
@endsection
