{!! Form::open(['route' => 'metas.store']) !!}
	{!! Form::hidden('actividad_id', $actividad->id) !!}
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
		{!! Form::label('fecha_inicio_esperada', 'Fecha de inicio esperada', ['class'=>'control-label control-label-sm']) !!}
		<div class="input-group date">
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
			{!! Form::text('fecha_inicio_esperada',null, ['class'=>'datepicker form-control pull-right', 'placeholder' => 'Fecha de inicio esperada']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('fecha_fin_esperada', 'Fecha final esperada', ['class'=>'control-label control-label-sm']) !!}
		<div class="input-group date">
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
			{!! Form::text('fecha_fin_esperada',null, ['class'=>'datepicker form-control', 'placeholder' => 'Fecha final esperada']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('monitor_id', 'Monitor', ['class'=>'control-label control-label-sm']) !!}
		<select name="monitor_id" id="monitor_id" class="form-control form-control-sm">
				<option value="" selected="selected">Seleccione un usuario de monitoreo...</option>
				@foreach ($actividad->responsables as $responsable)
					<option value="{{$responsable->user->id}}">{{$responsable->user->nombres}} {{$responsable->user->paterno}} {{$responsable->user->materno}}</option>
				@endforeach
			</select>
	</div>
	<div class="form-group">
		<a class="text-uppercase" style="margin-right: .75rem;" href="{{route('actividades.show', $actividad->id)}}"> Cancelar</a>
		<button class="btn btn-success text-uppercase" type="submit"><i class="icon-plus"></i> Crear</button>
	</div>
{!! Form::close() !!}