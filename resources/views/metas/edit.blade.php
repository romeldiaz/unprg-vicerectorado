@php
	$meta->fecha_fin = date("d-m-Y", strtotime($meta->fecha_fin));
	$meta->fecha_inicio = date("d-m-Y", strtotime($meta->fecha_inicio));
@endphp
{!! Form::model($meta, ['route' => ['metas.update', $meta->id], 'method' => 'PUT']) !!} 
	{!! Form::hidden('actividad_id', $meta->actividad->id) !!}
	<div class="form-group">
		{!! Form::label('nombre', 'Nombre', ['class'=>'control-label control-label-sm']) !!} {!! Form::text('nombre', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Nombre'])!!}
	</div>
	<div class="form-group">
		{!! Form::label('producto', 'Producto', ['class'=>'control-label control-label-sm']) !!} {!!Form::text('producto', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Producto'])!!}
	</div>
	<div class="form-group">
		{!! Form::label('presupuesto', 'Presupuesto', ['class'=>'control-label control-label-sm']) !!}
		<div class="input-group">
			<div class="input-group-addon">S/.</div>
			{!!Form::text('presupuesto', null, ['class'=>'form-control', 'placeholder'=>'Presupuesto'])!!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('estado', 'Estado', ['class'=>'control-label control-label-sm']) !!}
		<br>
		@if ($meta->estado == 'P')
		<label style="font-weight:400;">
			Pendiente {{ Form::radio('estado', 'P') }}
		</label>
		<label style="font-weight:400;">
			{{ Form::radio('estado', 'E' )}} En Proceso
		</label>	
		@endif
		@if ($meta->estado == 'E')
		<label style="font-weight:400;">
			En Proceso {{ Form::radio('estado', 'E') }}
		</label>
		<label style="font-weight:400;">
			{{ Form::radio('estado', 'F' )}} Finalizado
		</label>
		@endif
	</div>
	<div class="form-group">
		@if ($meta->estado == 'P')
		{!! Form::label('fecha_inicio', 'Fecha de Inicio', ['class'=>'control-label control-label-sm']) !!}
		<div class="input-group date">
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
			{!! Form::text('fecha_inicio',null, ['class'=>'datepicker form-control', 'placeholder' => 'Fecha de Inicio']) !!}
		</div>
		@endif
		@if ($meta->estado == 'E')
		{!! Form::label('fecha_fin', 'Fecha de Fin', ['class'=>'control-label control-label-sm']) !!}
		<div class="input-group date">
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
			{!! Form::text('fecha_fin',null, ['class'=>'datepicker form-control', 'placeholder' => 'Fecha de Fin']) !!}
		</div>
		@endif
	</div>
	<div class="form-group">
		@php
		$opciones = array()
		@endphp
		@foreach ($actividad->users as $user)
		@php
		$opciones[$user->id] = $user->nombres.' '.$user->paterno.' '.$user->materno;
		@endphp
		@endforeach
		{!! Form::label('monitor_id', 'Monitor', ['class'=>'control-label control-label-sm']) !!}
		<div class="form-group">
			{!! Form::select('monitor_id', $opciones , null,['class'=>'form-control form-control-sm', 'placeholder'=>'Seleccione un usuario como monitor']) !!}
		</div>
	</div>
	<div class="form-group">
		<a class="text-uppercase" style="margin-right: .75rem;" href="{{route('metas.create', $actividad->id)}}"> Cancelar</a>
		<button class="btn btn-success text-uppercase" type="submit"><i class="icon-plus"></i> Guardar</button>
	</div>
{!! Form::close() !!}