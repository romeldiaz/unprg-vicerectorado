@extends('layouts.main')


@section('content')
  <div class="row">
    <div class="col col-sm-5">
      <div class="row">
        <div class="col col-sm-12">
          <div class="box box-primary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Mis Notificaciones</h3>

              <div class="box-tools pull-right">
                {{ Form::open(['action'=>'NotificacionController@index', 'method'=>'GET'])}}
                  <div class="input-group input-group-sm" style="width: 150px;">
                    {{ Form::text('search', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'buscar']) }}
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                {{ Form::close() }}
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list ui-sortable">
                @foreach($notificaciones as $key => $notificacion)
                <?php
                $color_leido = $notificacion->checked?'rgb(171, 171, 171)':'rgb(15, 125, 172)';
                ?>
                <li  style="border-left: 3px solid {{$color_leido}};">
                  <!-- drag handle -->
                  @if($notificacion->type=='Actividad')
                  <i class="fa fa-sitemap"></i>
                  @elseif($notificacion->type=='Meta')
                  <i class="fa fa-flag"></i>
                  @elseif($notificacion->type=='Monitoreo')
                  <i class="fa fa-binoculars"></i>
                  @elseif($notificacion->type=='Responsable')
                  <i class="fa fa-user-plus"></i>
                  @endif

                  <!-- todo text -->
                  <span class="text">{{ $notificacion->title }}</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> {{ $notificacion->creadoHace()}}</small>
                  <div class="tools">
                    <a href="{{ url('notificaciones/'.$notificacion->id) }}"><i class="fa fa-eye"></i></a>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <div class="box-footer clearfix">
                <div id="mypag" hidden>
                  @if($notificaciones->total()!=0)
                    {{ 'Mostrando del '.$notificaciones->firstItem().' al  '.$notificaciones->lastItem().' de '.$notificaciones->total().' registros'}}
                    {{ $notificaciones->links() }}
                  @else
                    No hay registros
                  @endif
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="col col-sm-12">
          <div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Tipos de Notificaciones</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
              <div class="row">
                <div class="col col-sm-6">
                  <p><i class="fa fa-sitemap"></i> Actividad</p>
                  <p><i class="fa fa-flag"></i> Meta</p>
                  <p><i class="fa fa-binoculars"></i> Monitor</p>
                  <p><i class="fa fa-user-plus"></i> Responsable</p>
                </div>
                <div class="col col-sm-6">

                  <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> Hey!</h4>
                    *Tambien Puedes utilizar estas paralabras en el filtro de busqueda
                  </div>
                </div>
              </div>
						</div>
					</div>
        </div>
      </div>

    </div>
    <div class="col col-sm-7">


      <div class="box box-primary">
        <div class="box-header">
          <i class="fa fa-bell-o"></i>
          <h3 class="box-title">Notificacion</h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body chat" id="chat-box">
          @if(isset($noti))
          {{$noti->title}}
          {{$noti->detail}}
          @else
            <div class="text-center">
              <div class="form-group">
                <a href="javascript:" class="btn btn-app">
                  <i class="fa fa-bullhorn"></i> Notifications
                </a>
              </div>
              <blockquote>
                <p>Selecciona una elemento para leerlo</p>
              </blockquote>

            </div>
          @endif

        </div>
        <!-- /.chat -->
        <div class="box-footer">

        </div>
      </div>

    </div>
  </div>

@endsection

@section('script')
  <script src="{{ url('js/comun.js') }}"></script>
  <script src="{{ url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ url('js/dashboard.js') }}"></script>
@endsection
