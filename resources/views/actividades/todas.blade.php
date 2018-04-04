@extends('layouts.main')

@section('sidebar-page-actividades', 'active treeview')
@section('sidebar-page-actividades-todas', 'active')

@section('content')
<div class="row">
  <div class="col col-sm-12">
    <div class="box">
      <div class="box-header with-border">
        <div class="box-title">
          Todas las Actividades
        </div>
        <div class="box-tools">

          {{ Form::open(['action'=>'ActividadController@todas', 'method'=>'GET'])}}
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
              <th>Oficina</th>
              <th>Estado</th>
              <th>Tiempo</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $num=0;
            ?>

            @foreach($actividades as $key => $actividad)
            <?php $num++; ?>
            <?php
                $metas = count($actividad->metas) ;
                $metasCumplidas = count($actividad->metas->where('estado', 'F'));
                $imprimirfila = "";
                $estilofila = "x";
                if($metas==0){
                  $imprimirfila = '<span class="label label-warning"><i class="fa fa-clock-o"></i> Pendiente</span>';
                }elseif($metas==$metasCumplidas){
                  $imprimirfila = '<span class="label label-success"><i class="fa fa-trophy"></i> Finalizado</span>';
                  $estilofila = 'style="background-color:#9E9E9E;color:white;"';
                }else{
                  $imprimirfila = '<span class="label label-info"><i class="fa fa-circle-o-notch"></i> En proceso</span>';
                }
            ?>
            <tr <?php echo $estilofila;?>>
              <td>{{$actividad->id}}</td>
              <td>{{$actividad->nombre}}</td>
              <td>{{date("d-m-Y", strtotime($actividad->fecha_inicio))}}</td>
              <td>{{$actividad->presupuesto}}</td>
              <td>{{$actividad->creador->completo()}}</td>
              <td>{{$actividad->creador->oficina->nombre}}</td>
              <td>
              <?php
                echo $imprimirfila;
              ?>
              </td>

              <td>
                <div class="col col-sm-12">
                    <div class="progress" style="margin:0;min-width:50px;">
                      <div class="progress-bar progress-bar-striped @if($actividad->porcentaje()<70) avance-green @elseif($actividad->porcentaje()<100) avance-yellow @else avance-red @endif" role="progressbar" style="width:{{$actividad->porcentaje()}}%" aria-valuenow="{{$actividad->porcentaje()}}" aria-valuemin="0" aria-valuemax="100">{{$actividad->porcentaje()}}%</div>
                    </div>
                  </div>
              </td>
              <td>
                <a href="{{ url('actividades/'.$actividad->id) }}" class="btn btn-xs btn-flat btn-warning"><i class="fa fa-eye"></i></a>
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
