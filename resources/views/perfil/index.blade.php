@extends('layouts.perfil')

@section('content2')
<?php
  $creaciones = \App\User::findOrFail(Auth::user()->id)->actividades;
  $totalCreaciones = $creaciones->count();
  $finalizadas = 0;
  if($totalCreaciones!=0){
    foreach ($creaciones as $key => $actividad) {
      $metas = count($actividad->metas) ;
      $metasCumplidas = count($actividad->metas->where('estado', 'F'));
      if($metas !=0  && $metas==$metasCumplidas){
        $finalizadas++;
      }
    }
    $porcentaje = round(($finalizadas/$totalCreaciones)*100).'%';
  }else{
    $porcentaje = 0;
  }

  $porcentaje  = $porcentaje.'%';

?>

  <div class="row">
    <div class="col col-sm-12 col-md-6">
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-number">
            Creaciones
          </span>
          <span class="progress-description">
            {{ $totalCreaciones }} Actividades
          </span>

          <div class="progress">
            <div class="progress-bar" style="width: {{$porcentaje}}">HOla</div>
          </div>
          <span class="progress-description">
            {{ $porcentaje }} Acitividades finalizadas ({{ $finalizadas }})
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <div class="col col-sm-12 col-md-6">
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Mentions</span>
          <span class="info-box-number">92,050</span>

          <div class="progress">
            <div class="progress-bar" style="width: 20%"></div>
          </div>
          <span class="progress-description">
                20% Increase in 30 Days
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
  </div>
@endsection

@section('script')

@endsection
