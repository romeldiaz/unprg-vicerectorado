@extends('layouts.app') 
@section('content')
<div class="container">
	<div class="row">
		{!! Form::open(['route' => 'metas.store']) !!} 
		{{--  {{ Form::hidden('actividad_id', $actividad->id) }}  --}}
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="datos-tab" data-toggle="tab" href="#div-datos" role="tab" aria-controls="datos" aria-selected="true">Datos Principales</a>
			</li>
			{{--  <li class="nav-item">
				<a class="nav-link" id="responsables-tab" data-toggle="tab" href="#div-responsables" role="tab" aria-controls="responsables"
				 aria-selected="false">Responsables</a>
			</li>  --}}
		</ul>
		<div class="tab-content" id="metas-tab-content">
			<div class="tab-pane fade show active pt-3" id="div-datos" role="tabpanel" aria-labelledby="datos-tab">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group mb-3">
							{!! Form::label('actividad_id', 'Actividad', ['class'=>'control-label control-label-sm']) !!} 
							<select name="actividad_id" id="actividad_id" class="custom-select form-control form-control-sm">
								<option value="">Escoje una actividad...</option>
								@foreach ($actividades as $actividad)
								<option value="{{$actividad->id}}">{{$actividad->nombre}}</option>
								@endforeach
							</select>
							{{--  {!!Form::select('actividad_id', ['I'=>'Iniciado', 'F'=>'Finalizado'], null, ['class'=>'custom-select form-control form-control-sm'])!!}  --}}
						</div>
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
			{{--  <div class="tab-pane fade pt-3" id="div-responsables" role="tabpanel" aria-labelledby="responsables-tab">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-sm table-hover">
							<thead>
								<tr>
									<th>{{ Form::label('responsables', 'Apellidos y Nombres') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($actividad->responsables as $responsable) @php $usuario = $responsable->usuario @endphp
								<tr>
									<td>
										<label>{{ Form::checkbox('responsables[]', $responsable->id) }} {{ strtoupper($usuario->paterno) }} {{ strtoupper($usuario->materno) }}, {{ ucfirst($usuario->nombre)}}</label>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>  --}}
			</div>
		</div>
		<div class="mt-3 float-right">
			<a class="btn btn-outline-secondary text-uppercase" href="{{route('actividades.show', $actividad->id)}}"> Cancelar</a>
			<button class="btn btn-success text-uppercase" type="submit"><i class="icon-plus"></i> Crear</button>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection