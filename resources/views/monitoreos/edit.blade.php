{!! Form::model($monitoreo, ['route' => ['monitoreo.update', $monitoreo->id], 'method' => 'PUT']) !!}
{!! Form::hidden('meta_id', $monitoreo->meta->id) !!}
<div class="form-group">
	<div class="input-group date">
		<div class="input-group-addon">
			&nbsp;<i class="fa fa-calendar"></i>
		</div>
		{!! Form::text('fecha',null, ['class'=>'datepicker form-control pull-right', 'placeholder'=>'Fecha']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::textarea('descripcion', null, ['class'=>'form-control', 'placeholder'=>'Descripcion', 'rows'=>'3']) !!}
</div>
<div class="form-group">
	{!! Form::textarea('observacion', null, ['class'=>'form-control', 'placeholder'=>'Observacion', 'rows'=>'5']) !!}
</div>
<div class="form-group pt-4">
	<button class="btn btn-md btn-info" type="submit"><i class="fa fa-save"></i> Guardar</button>
	<a href="{{route('monitoreo.create', $meta->id)}}" class="btn btn-md btn-default"><i class="fa fa-times"></i> Cancelar</a>
</div>
{!! Form::close() !!}