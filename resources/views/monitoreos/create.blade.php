{!! Form::open(['route' => 'monitoreo.store']) !!}
{!! Form::hidden('meta_id', $meta->id) !!}
<div class="form-group">
	{!! Form::label('fecha', 'Fecha', ['class'=>'control-label control-label-sm']) !!}
	<div class="input-group date">
		<div class="input-group-addon">
			&nbsp;<i class="fa fa-calendar"></i>
		</div>
		{!! Form::text('fecha', $hoy, ['class'=>'datepicker form-control pull-right', 'placeholder'=>'Fecha']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('descripcion', 'Descripción', ['class'=>'control-label control-label-sm']) !!}
	{!! Form::textarea('descripcion', null, ['class'=>'form-control', 'placeholder'=>'Descripcion', 'rows'=>'3']) !!}
</div>
<div class="form-group">
	{!! Form::label('observacion', 'Observación', ['class'=>'control-label control-label-sm']) !!}
	{!! Form::textarea('observacion', null, ['class'=>'form-control', 'placeholder'=>'Observacion', 'rows'=>'5']) !!}
</div>
<div class="form-group pt-4">
	<button class="btn btn-md btn-info" type="submit"><i class="fa fa-plus"></i> Crear</button>
	<a href="{{route('monitoreo.create', $meta->id)}}" class="btn btn-md btn-default"><i class="fa fa-times"></i> Cancelar</a>
</div>
{!! Form::close() !!}