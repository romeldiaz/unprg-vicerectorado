@extends('layouts.main') 
@section('css')
	<link rel="stylesheet" href="{{ url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('content')
<div class="row">
	<div class="col col-sm-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active">
					<a data-toggle="tab" href="#tab_datos">Datos Principales</a>
				</li>
				<li>
					<a data-toggle="tab" href="#tab_gastos">Gastos</a>
				</li>
				<li>
					<a data-toggle="tab" href="#tab_monitoreo">Monitoreo</a>
				</li>
				<li class="pull-right">
					<a href="{{route('actividades.show', $meta->actividad->id)}}" class=""><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Volver</a>
				</li>
			</ul>
			<div class="tab-content" id="metas-tab-content">
				<div class="tab-pane active" id="tab_datos">
					{{ Form::hidden('actividad_id', $meta->actividad->id) }}
					<!--Para capturara la actividad desde el script -->
					<div class="row">
						<div class="col col-sm-12">
							<div class="progress mb-2">
								<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
								 aria-valuemax="100">75%</div>
							</div>
						</div>
						<div class="col col-sm-12">
							<div class="callout callout-purple">
								<p class="lead"><strong>{{$meta->nombre}}</strong></p>
								<h4>Producto: {{$meta->producto}}</h4>
								<label>Estado:&nbsp;</label> @if ($meta->estado == 'I')
								<span class="label label-primary">Iniciado</span> @endif @if ($meta->estado == 'E')
								<span class="label label-warning">En proceso</span> @endif @if ($meta->estado == 'F')
								<span class="label label-success">Finalizado</span> @endif
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
													<td>{{ $meta->presupuesto}}</td>
													@php $total_gasto = 0 @endphp @foreach ($meta->gastos as $gasto) @php $total_gasto = $gasto->monto @endphp @endforeach
													<td>{{$total_gasto}}</td>
													<td>{{ $meta->presupuesto - $total_gasto }}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col col-sm-12">
								<div class="row">
									<div class="col col-sm-6">
										<div class="box box-info">
											<div class="box-header with-border">
												<h3 class="box-title">Fechas Esperadas</h3>
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
												</div>
											</div>
											<div class="box-body">
												<p class="card-title">Fecha Inicial Esperada: {{ date("d/m/Y", strtotime($meta->fecha_inicio_esperada)) }}</p>
												<p class="card-text">Fecha Final Esperada: {{ date("d/m/Y", strtotime($meta->fecha_fin_esperada)) }}</p>
											</div>
										</div>
									</div>
									<div class="col col-sm-6">
										<div class="box box-info">
											<div class="box-header with-border">
												<h3 class="box-title">Fechas</h3>
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
												</div>
											</div>
											<div class="box-body">
												<p class="card-title">Fecha Inicial: {{ date("d/m/Y", strtotime($meta->fecha_inicio)) }}</p>
												<p class="card-text">Fecha Final: {{ date("d/m/Y", strtotime($meta->fecha_fin)) }}</p>
											</div>
										</div>
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
											{{ $meta->creador->nombres.' '.$meta->creador->paterno.' '.$meta->creador->materno }}
											<a href="javascript: show_info_user({{$meta->creador->id}})"><small class="label pull-right bg-blue">Ver</small></a>
										</li>
									</ul>
									Monitor:
									<ul>
										<li>
											{{ $meta->monitor->nombres.' '.$meta->monitor->paterno.' '.$meta->monitor->materno }}
											<a href="javascript: show_info_user({{$meta->monitor->id}})"><small class="label pull-right bg-blue">Ver</small></a>
										</li>
									</ul>
									Responsables:
									<ul>
										@foreach($meta->responsables as $responsable)
										<li>
											{{ $responsable->user->nombres.' '.$responsable->user->paterno.' '.$responsable->user->materno }}
											<a href="javascript: show_info_user({{$responsable->user->id}})"><small class="label pull-right bg-blue">Ver</small></a>
										</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
						<div class="modal fade" id="modalUserInfo">
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
				<div class="tab-pane" id="tab_gastos">
					<div class="row">
						<div class="col col-sm-12 col-md-4">
							Gasto:
							{!! Form::open(['route' => 'gastos.store']) !!} {!! Form::hidden('meta_id', $meta->id) !!}
							<input name="page" type="hidden" value="create">
							<!--Para controlar el script usuario js-->
							<div class="form-group">
								{!! Form::select('tipo', ['B' => 'Bien', 'S' => 'Servicio'], null, ['class'=>'form-control form-control-sm', 'placeholder'
								=> 'Elige un tipo de gasto...']) !!}
							</div>
							<div class="form-group">
								{!! Form::text('descripcion', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Detalle'])!!}
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">S/.</div>
									{!!Form::text('monto', null, ['class'=>'form-control', 'placeholder'=>'Importe'])!!}
								</div>
							</div>
							<div class="form-group">
								<div class="input-group date">
									<div class="input-group-addon">
										&nbsp;<i class="fa fa-calendar"></i>
									</div>
									{!! Form::text('fecha',null, ['class'=>'datepicker form-control pull-right', 'placeholder'=>'Fecha']) !!}
								</div>
							</div>
							Tipo de Documento:
							<div class="form-group">
								<select class="form-control form-control-sm" name="tipo_documento_id" id="tipo_documento_id">
									<option selected="selected" value="">Seleccione un tipo de documento...</option>
									@foreach ($documentos as $doc)
									<option value="{{$doc->id}}">{{$doc->nombre}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">N°&nbsp;</div>
									{!!Form::text('numero', null, ['class'=>'form-control', 'placeholder'=>'Número de documento'])!!}
								</div>
							</div>
							
							<div class="d-flex flex-row-reverse">
								<div class="form-inline">
									<a href="http://localhost:8000/users" class="btn btn-sm btn-secondary mr-1">Cancelar</a>
									<input class="btn btn-sm btn-info" type="submit" value="Crear">
								</div>
							</div>
							</form>
						</div>
						<div class="col col-sm-12 col-md-8">
							<div class="box">
								<div class="box-header with-border">
									<div class="box-title">
										Gastos
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
												<th class="text-center">Fecha</th>
												<th class="text-center">Documento</th>
												<th class="text-center">N°</th>
												<th class="text-center">Detalle del gasto</th>
												<th class="text-center">Importe</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@foreach($meta->gastos as $gasto)
											<tr>
												<td class="text-center">
													{{-- <label>{{ Form::checkbox('responsables[]', $responsable->id) }} {{ strtoupper($usuario->paterno) }} {{ strtoupper($usuario->materno) }}, {{ ucfirst($usuario->nombre)}}</label>													--}} {{ date("d/m/Y", strtotime($gasto->fecha)) }}
												</td>
												<td class="text-center">{{ $gasto->tipo_documento->nombre }}</td>
												<td class="text-center">{{ $gasto->numero }}</td>
												<td>{{ $gasto->descripcion }}</td>
												<td class="text-right pr-3">S/. {{ number_format($gasto->monto, 2, '.', ',') }}</td>
												<td class="text-center">
													<a class="btn btn-xs btn-flat btn-success" href="{{route('metas.edit', $meta->id)}}"><i class="fa fa-pencil"></i></a>
													<button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#modalEliminar" title="Eliminar"><i class="fa fa-trash"></i></button>
													<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h4 class="modal-title" id="modalEliminarLabel">Eliminar Gasto</h4>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																					    <span aria-hidden="true">&times;</span>
																					</button>
																</div>
																<div class="modal-body">
																	¿Realmente desea eliminar el gasto "<strong>{{ $gasto->descripcion }}</strong>"?
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button> {{-- {!! Form::open(['route'
																	=>['gastos.destroy', $gasto->id], 'class' => 'new-form-inline', 'method' => 'DELETE']) !!}
																	<button type="submit" class="btn btn-sm btn-danger">Eliminar</button> {!! Form::close() !!} --}}
																</div>
															</div>
														</div>
													</div>
												</td>
											</tr>
											@endforeach
											<tr>
												<th class="text-right" colspan="4">Total</th>
												<td class="text-right pr-3">S/. {{ number_format($meta->gastos->sum('monto'), 2, '.', ',') }}</td>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_monitoreo">
					<div class="row">
						<div class="col col-sm-12">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('script')
<script src="{{ url('js/comun.js') }}"></script>
<script src="{{ url('js/actividad_show.js') }}"></script>
<script src="{{ url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
	//Date picker 
		$(function () {
			$('.datepicker').datepicker({ 
				format: 'dd/mm/yyyy',
				autoclose: true 
			})
		})
</script>
@endsection