@php 
$gasto->fecha = date("d-m-Y", strtotime($gasto->fecha));
@endphp
Gasto: 
{!! Form::model($gasto, ['route' => ['gastos.update', $gasto->id], 'method' => 'PUT']) !!}
{!! Form::hidden('meta_id', $gasto->meta->id) !!}
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