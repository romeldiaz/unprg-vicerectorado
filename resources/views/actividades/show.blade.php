@extends('layouts.main')

@section('content')
  <div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
      <li class="active"><a href="#actividad" data-toggle="tab">Actividad</a></li>
      <li><a href="#responsables" data-toggle="tab">Responsables</a></li>
      <li><a href="#metas" data-toggle="tab">Metas</a></li>
    </ul>

    <div class="tab-content">
      <div class="active tab-pane" id="actividad">
        {{ Form::hidden('actividad_id', $actividad->id) }}<!--Para capturara la actividad desde el script -->

        <div class="row">
          <div class="col col-sm-12">
            <div class="progress" style="margin:0">
              <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
            </div>
          </div>

          <div class="col col-sm-12">
            @if(empty($plazo))
              <p class="text-right text-primary">Esta actividad no tiene una fecha limite definida</p>
            @elseif($plazo>=0)
              <p class="text-right text-primary">Faltan {{$plazo}} dias para terminar la actividad</p>
            @else
              <p class="text-right text-danger">La actividad lleva {{abs($plazo)}} dias retrasada</p>
            @endif
          </div>

          <div class="col col-sm-12">
            <div class="callout callout-purple">
              <p class="lead mb-0">{{ $actividad->nombre }}</p>
              <label for="actividad_estado">Estado:</label>
              <span class="badge badge-pill badge-info p-1">En proceso</span>
              total:
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col col-sm-6">
            <div class="col col-sm-12">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Presupuesto</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Presupuesto</th>
                        <th>Gastos</th>
                        <th>Diferencia</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ $actividad->presupuesto}}</td>
                        <td>{{ $actividad->metas->sum('presupuesto') }}</td>
                        <td>{{ $actividad->presupuesto-100 - $actividad->metas->sum('presupuesto')}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col col-sm-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Resolucion</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                  <p class="card-title">N°: {{ $actividad->numero_resolucion}}</p>
                  <p class="card-text">Fecha: {{ $actividad->fecha_resolucion}}</p>
                </div>
              </div>
            </div>

            <div class="col col-sm-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Acta</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                  <p class="card-title">N°: {{ $actividad->fecha_acta }}</p>
                  <p class="card-text">{{ $actividad->descripcion_acta }}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col col-sm-6">
            <div class="box box-primary">
              <div class="box-body">
                Creador:
                <ul>
                  <li>
                    {{ $creador->nombres.' '.$creador->paterno.' '.$creador->materno }}
                    <a href="javascript: show_info_user({{$creador->id}})"><small class="label pull-right bg-blue">Ver</small></a>
                  </li>
                </ul>
                Monitor:
                <ul>
                  <li>
                    {{ $monitor->nombres.' '.$monitor->paterno.' '.$monitor->materno }}
                    <a href="javascript: show_info_user({{$monitor->id}})"><small class="label pull-right bg-blue">Ver</small></a>
                  </li>
                </ul>
                Responsables:
                <ul>
                  @foreach($responsables as $key=> $responsable)
                    <li>
                      {{ $responsable->nombres.' '.$responsable->paterno.' '.$responsable->materno }}
                      <a href="javascript: show_info_user({{$responsable->id}})"><small class="label pull-right bg-blue">Ver</small></a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>

            <div class="modal fade" id="modalUserInfo" >
              <div class="modal-dialog">
                <div class="box-body no-padding">
                  <div class="box box-widget widget-user no-margin">
                    <div class="widget-user-header bg-aqua-active" style="padding-top:0; padding-right:0">
                      <div class="text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">
                          <i class="fa fa-close"></i>
                        </button>
                      </div>
                      <h3 class="widget-user-username"><span id="user-fullname"></span></h3>
                      <h5 class="widget-user-desc"><span id="user-puesto"></span></h5>
                    </div>
                    <div class="widget-user-image">
                      <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                      <div class="row">
                        <div class="col-sm-4 border-right">
                          <div class="description-block">
                            <h5 class="description-header"><span id="user-actividades"></span></h5>
                            <span class="description-text">Actividades</span>
                          </div>
                        </div>
                        <div class="col-sm-4 border-right">
                          <div class="description-block">
                            <h5 class="description-header"><span id="user-metas"></h5>
                            <span class="description-text">Metas</span>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="description-block">
                            <h5 class="description-header"><span id="user-puntaje"></h5>
                            <span class="description-text">Puntos</span>
                          </div>
                        </div>
                      </div>
                      <div class="box-body">
                        <table class="table table-sm mt-2">
                          <tbody>
                            <tr>
                              <td>Oficina:</td>
                              <td><span id="user-oficina"></span></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>

        </div>
      </div>


      <div class="tab-pane" id="responsables">
        <div class="row">
          <div class="col col-sm-6">
            <div class="form-row">
              <?php
                $oficinas_options[0] = 'Todas';
                foreach ($oficinas as $key => $oficina) {
                  $oficinas_options[$oficina->id] = $oficina->nombre;
                }
               ?>

              <div class="col col-sm-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <div class="row" style="padding-bottom: 10px;">
                      <div class="col col-sm-7">
                        <div class="input-group input-group-sm">
                          {{ Form::select('search_by_oficinas',$oficinas_options, Auth::user()->oficina_id, ['class'=>'form-control', 'id'=>'search_by_oficinas', 'disabled'])}}
                          <div class="input-group-btn">
                            <span class="btn btn-default"><i class="fa fa-institution"></i></span>
                          </div>
                        </div>
                      </div>
                      <div class="col col-sm-5">
                        <div class="input-group input-group-sm">
                          {{ Form::text('search_word', null, ['class'=>'form-control', 'placeholder'=>'buscar', 'id'=>'search_word']) }}
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                      <table class="table table-sm table-hover">
                        <tr>
                          <th>N°</th>
                          <th>Resultados</th>
                          <th class="text-right"><a href="javascript: seleccionar_varios(0)"><span id="span_0" class="fa fa-square-o"></span></a></th>
                        </tr>
                        <tbody id="search_results">

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>



          </div>

          <div class="col col-sm-6">
            {{ Form::open(['action'=>['ResponsableController@store'], 'method'=>'POST']) }}
              {{ Form::hidden('actividad_id', $actividad->id)}}
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="box-body table-responsive no-padding">
                    <table class="table table-sm table-hover">
                      <tr>
                        <th>N</th>
                        <th>Responsables</th>
                        <th class="text-right">
                          {{ Form::submit('Guardar lista', ['class'=>'btn btn-sm btn-primary']) }}
                        </th>
                      </tr>
                      <tbody id="responsables_selected">
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            {{ Form::close() }}


          </div>
        </div>
      </div>
      <!-- /.tab-pane -->

      <div class="tab-pane" id="metas">
        <div class="box">
			<div class="box-header with-border">
				<div class="box-title">
					Metas
					<a href="#" class="btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
				</div>
				<div class="box-tools">
					{{-- @if(isset($user)) {{ Form::open(['action'=>['UserController@edit', $user->id], 'method'=>'GET'])}} @else {{ Form::open(['action'=>'UserController@create',
					'method'=>'GET'])}} @endif
					<div class="input-group input-group-sm" style="width: 150px;">
						{{ Form::text('search', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'search']) }}
						<div class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>
					</div>
					{{ Form::close() }} --}}
				</div>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table table-sm table-hover table-fixed">
					<thead>
						<tr>
							<th class="text-center">N°</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Fecha de Inicio</th>
							<th class="text-center">Fecha Final</th>
							<th class="text-center">Estado</th>
							<th class="text-center">Presupuesto</th>
							<th class="text-center" style="width: 150px"></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($actividad->metas as $meta)
						<tr>
							<td class="text-center">{{$meta->id}}</td>
							<td>{{$meta->nombre}}</td>
							<td class="text-center">{{ date("d/m/Y", strtotime($meta->fecha_inicio))}}</td>
							<td class="text-center">
								@if ($meta->estado == 'F') {{ date("d/m/Y", strtotime($meta->fecha_fin))}} @endif
							</td>
							<td class="text-center">
								@if ($meta->estado == 'I')
								<span class="label label-primary">Iniciado</span>
								@endif @if ($meta->estado == 'E')
								<span class="label label-warning">En proceso</span>
								@endif @if ($meta->estado == 'F')
								<span class="label label-success">Finalizado</span>
								@endif
							</td>
							<td class="text-right">{{number_format($meta->presupuesto, 2, '.', ',')}}</td>
							<td class="text-center">
								<a href="{{route('metas.show', $meta->id)}}" title="Ver" class="btn btn-xs btn-flat btn-info"><i class="fa fa-eye"></i></a>
								<a class="btn btn-xs btn-flat btn-success" href="{{route('metas.edit', $meta->id)}}"><i class="fa fa-pencil"></i></a>
								<button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#modalEliminar" title="Eliminar"><i class="fa fa-trash"></i></button>
								<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="modalEliminarLabel">Eliminar Meta</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body">
												¿Realmente desea eliminar la meta "<strong>{{ $meta->nombre }}</strong>"?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
												{!! Form::open(['route' =>['gastos.destroy', $meta->id], 'class' => 'new-form-inline', 'method' => 'DELETE']) !!}
												<button type="submit" class="btn btn-sm btn-danger">Eliminar</button> {!! Form::close() !!}
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
						<tr>
							<th class="text-right" colspan="5">Total</th>
							<td class="text-right pr-3">S/. {{ number_format($actividad->metas->sum('presupuesto'), 2, '.', ',') }}</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
@endsection

@section('script')
  <script src="{{ url('js/actividad_show.js') }}"></script>
  <script src="{{ url('js/actividad_show_responsables.js') }}"></script>
@endsection
