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

          {{ Form::open(['action'=>'ActividadController@all', 'method'=>'GET'])}}
            <div class="input-group input-group-sm" style="width: 150px;">
              {{ Form::text('search', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'search']) }}
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
              <th col>N°</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th>Presupuesto</th>
              <th>Estado</th>
              <th>
                <a style="color:#000;" href="javascript:"  data-toggle="tooltip" data-html="true" data-placement="top"
                title="
                <table>
                    <tr >
                      <td colspan='2' class='text-center'>Leyenda</th>
                    </tr>
                  <tbody>
                    <tr >
                      <td style='width:20px;'><i class='text-green fa fa-square'></i></td>
                      <td>1-75%</td>
                    </tr>
                    <tr>
                      <td><i class='text-yellow fa fa-square'></i></td>
                      <td>76-100%</td>
                    </tr>
                    <tr>
                      <td><i class='text-red fa fa-square'></i></td>
                      <td>+100%</td>
                    </tr>
                  </tbody>
                </table>
                ">
                Tiempo</a>
              </th>
              <th>By</th>
              <th>

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
              <td>
                <?php
                $total = count($actividad->metas);
                $completadas = count($actividad->metas->where('estado', 'F'));
                //C: creada (sin metas)
                //P: proceso (metas incompletas)
                //T: terminada (metas completadas)
                $estado_html = '';
                if($total == 0 ){
                  $estado_html = '<span class="label label-default">Creada</span>';
                }elseif ($completadas == $total) {
                  $estado_html = '<span class="label label-success">Finalizada</span>';
                }else{
                  $estado_html = '<span class="label label-primary">En proceso</span>';
                }
                echo $estado_html;
                ?>

              </td>
              <td style="width:30px;">
                <?php
                $hoy =  \Carbon\Carbon::now();
                $inicio = \Carbon\Carbon::create(
                  date('Y', strtotime($actividad->fecha_inicio)),
                  date('m', strtotime($actividad->fecha_inicio)),
                  date('d', strtotime($actividad->fecha_inicio)));

                $fin = \Carbon\Carbon::create(
                    date('Y', strtotime($actividad->fecha_fin_esperada)),
                    date('m', strtotime($actividad->fecha_fin_esperada)),
                    date('d', strtotime($actividad->fecha_fin_esperada)));

                $tiempo_estimado = $fin->diffInDays($inicio);
                $tiempo_transcurrido = $hoy->diffInDays($inicio);
                $tmp = round(($tiempo_transcurrido/$tiempo_estimado)*100);
                $color = '';
                if($tmp < 75){
                  $color = 'green';
                }elseif ($tmp <= 100) {
                  $color = 'yellow';
                }else{
                  $color = 'red';
                }
                echo  '<div class="progress">
                        <div class="progress-bar progress-bar-'.$color.'" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                      </div>'
                ?>
              </td>
              <td>{{$actividad->creador_id}}</td>
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
