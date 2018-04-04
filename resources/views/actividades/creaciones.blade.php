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

          {{ Form::open(['action'=>'ActividadController@creaciones', 'method'=>'GET'])}}
            <div class="input-group input-group-sm" style="width: 150px;">
              {{ Form::text('search', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'buscar']) }}
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>N°</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th>Presupuesto</th>
              <th>Creador</th>
              <th>Estado</th>
              <th>Tiempo</th>
              <th></th>
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
              <td>{{$actividad->creador->completo()}}</td>

              <td>
                <?php
                $metas = count($actividad->metas) ;
                $metasCumplidas = count($actividad->metas->where('estado', 'F'));
                if($metas==0){
                  echo '<span class="label label-warning"><i class="fa fa-clock-o"></i> Pendiente</span>';
                }elseif($metas==$metasCumplidas){
                  echo '<span class="label label-success"><i class="fa fa-trophy"></i> Finalizado</span>';
                }else{
                  echo '<span class="label label-info"><i class="fa fa-circle-o-notch"></i> En proceso</span>';
                }
                ?>
              </td>
              <td>
                <div class="col col-sm-12">
                    <div class="progress" style="margin:0">
                      <div class="progress-bar progress-bar-striped @if($actividad->porcentaje()<70) avance-green @elseif($actividad->porcentaje()<100) avance-yellow @else avance-red @endif" role="progressbar" style="width:{{$actividad->porcentaje()}}%" aria-valuenow="{{$actividad->porcentaje()}}" aria-valuemin="0" aria-valuemax="100">{{$actividad->porcentaje()}}%</div>
                    </div>
                  </div>
              </td>
              <td >
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
      <div class="box-footer clearfix">
        <div id="mypag" hidden>
          @if($actividades->total()!=0)
            {{ 'Mostrando del '.$actividades->firstItem().' al  '.$actividades->lastItem().' de '.$actividades->total().' registros'}}
            {{ $actividades->links() }}
          @else
            No hay registros
          @endif
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('script')
  <script src="{{ url('js/comun.js') }}"></script>
@endsection
