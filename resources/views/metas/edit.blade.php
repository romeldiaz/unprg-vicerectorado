@extends('layouts.main') 
@section('content')
<div class="container">
	<div class="row">
		{!! Form::model($meta, ['route' => ['metas.update', $meta->id], 'method' => 'PUT']) !!} {{ Form::hidden('actividad_id', $meta->actividad->id)
		}}
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="datos-tab" data-toggle="tab" href="#div-datos" role="tab" aria-controls="datos" aria-selected="true">Datos Principales</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="responsables-tab" data-toggle="tab" href="#div-responsables" role="tab" aria-controls="responsables"
				 aria-selected="false">Responsables</a>
			</li>
			<li class="Gastos">
				<a class="nav-link" id="gastos-tab" data-toggle="tab" href="#div-gastos" role="tab" aria-controls="gastos" aria-selected="false">Gastos</a>
			</li>
			<li class="Monitoreo">
				<a class="nav-link" id="monitoreo-tab" data-toggle="tab" href="#div-monitoreo" role="tab" aria-controls="monitoreo" aria-selected="false">Monitoreo</a>
			</li>
		</ul>
		<div class="tab-content" id="metas-tab-content">
			<div class="tab-pane fade show active pt-3" id="div-datos" role="tabpanel" aria-labelledby="datos-tab">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group mb-3">
							{!! Form::label('nombre', 'Nombre', ['class'=>'control-label control-label-sm']) !!} {!! Form::text('nombre', null, ['class'=>'form-control
							form-control-sm', 'placeholder'=>'Nombre'])!!}
						</div>
						<div class="form-group">
							{!! Form::label('producto', 'Producto', ['class'=>'control-label control-label-sm']) !!} {!!Form::text('producto', null,
							['class'=>'form-control form-control-sm', 'placeholder'=>'Producto'])!!}
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('presupuesto', 'Presupuesto', ['class'=>'control-label control-label-sm']) !!}
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text">S/.</span>
								</div>
								{!!Form::text('presupuesto', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Presupuesto', 'aria-label'=>'Username'])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('estado', 'Estado', ['class'=>'control-label control-label-sm']) !!} {!!Form::select('estado', ['I'=>'Iniciado',
							'F'=>'Finalizado'], null, ['class'=>'custom-select form-control form-control-sm'])!!}
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('fecha_inicio_esperada', 'Fecha de inicio esperada', ['class'=>'control-label control-label-sm']) !!}
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text icon icon-calendar"></span>
								</div>
								{!! Form::date('fecha_inicio_esperada',null, ['class'=>'form-control form-control-sm']) !!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('fecha_fin_esperada', 'Fecha final esperada', ['class'=>'control-label control-label-sm']) !!}
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text icon icon-calendar"></span>
								</div>
								{!! Form::date('fecha_fin_esperada',null, ['class'=>'form-control form-control-sm']) !!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('fecha_inicio', 'Fecha de inicio', ['class'=>'control-label control-label-sm']) !!}
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text icon icon-calendar"></span>
								</div>
								{!! Form::date('fecha_inicio',null, ['class'=>'form-control form-control-sm']) !!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('fecha_fin', 'Fecha final', ['class'=>'control-label control-label-sm']) !!}
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text icon icon-calendar"></span>
								</div>
								{!! Form::date('fecha_fin',null, ['class'=>'form-control form-control-sm']) !!}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade pt-3" id="div-responsables" role="tabpanel" aria-labelledby="responsables-tab">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-sm table-hover table-fixed">
							<thead>
								<tr>
									<th>Apellidos y Nombres</th>
								</tr>
							</thead>
							<tbody>
								@foreach($meta->actividad->responsables as $responsable) @php $user = $responsable->user @endphp
								<tr>
									<td>
										<label>{{ Form::checkbox('responsables[]', $responsable->id) }} {{ strtoupper($user->paterno) }} {{ strtoupper($user->materno) }}, {{ ucfirst($user->nombres)}}</label>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane fade pt-3" id="div-gastos" role="tabpanel" aria-labelledby="gastos-tab">
				<div class="col-12">
					<table class="table table-sm table-hover table-fixed">
						<thead>
							<tr>
								<th class="text-center" style="width: 120px;">Fecha</th>
								<th class="text-center" style="width: 150px;">Documento</th>
								<th class="text-center" style="width: 150px;">N°</th>
								<th class="text-center">Detalle del gasto</th>
								<th class="text-center" style="width: 180px;">Importe</th>
								<th class="text-center" style="width: 150px;"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($meta->gastos as $gasto)
							<tr>
								<td class="text-center">{{ date("d/m/Y", strtotime($gasto->fecha)) }}</td>
								<td class="text-center">{{ $gasto->tipo_documento->nombre }}</td>
								<td class="text-center">{{ $gasto->numero }}</td>
								<td>{{ $gasto->descripcion }}</td>
								<td class="text-right pr-3">S/. {{ number_format($gasto->monto, 2, '.', ',') }}</td>
								<td class="text-center">
									<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalEliminar" title="Eliminar"><i class="icon-bin"></i></button>
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
													<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button> 
													{!! Form::open(['route' =>['gastos.destroy', $gasto->id], 'class' => 'new-form-inline', 'method' => 'DELETE']) !!}
													<button type="submit" class="btn btn-sm btn-danger">Eliminar</button> {!! Form::close() !!}
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
			<div class="tab-pane fade pt-3" id="div-monitoreo" role="tabpanel" aria-labelledby="monitoreo-tab">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-sm table-hover table-fixed">
							<thead>
								<tr>
									<th>{{ Form::label('responsables', 'Apellidos y Nombres') }}</th>
								</tr>
							</thead>
							<tbody>
								{{-- @foreach($meta->actividad->responsables as $responsable) @php $usuario = $responsable->usuario @endphp
								<tr>
									<td>
										<label>{{ Form::checkbox('responsables[]', $responsable->id) }} {{ strtoupper($usuario->paterno) }} {{ strtoupper($usuario->materno) }}, {{ ucfirst($usuario->nombre)}}</label>
									</td>
								</tr>
								@endforeach --}}
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="mt-3 float-right">
			<a class="btn btn-outline-secondary text-uppercase" href="{{route('metas.my')}}"> Cancelar</a>
			<button class="btn btn-success text-uppercase" type="submit"><i class="icon-loop2"></i> Guardar</button>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection