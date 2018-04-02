Gasto: 
{!! Form::open(['route' => 'gastos.store']) !!} 
{!! Form::hidden('meta_id', $meta->id) !!}
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
Documento:
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
		<div class="input-group-addon">N° </div>
		{!!Form::text('numero', null, ['class'=>'form-control', 'placeholder'=>'Número de documento'])!!}
	</div>
</div>
<div class="form-group pt-4">
	<button class="btn btn-md btn-info" type="submit"><i class="fa fa-plus"></i> Crear</button>
	<a href="{{route('gastos.create', $meta->id)}}" class="btn btn-md btn-default"><i class="fa fa-times"></i> Cancelar</a>
</div>
{!! Form::close() !!}