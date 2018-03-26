@extends('layouts.main') 
@section('css')
<link rel="stylesheet" href="{{ url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
 
@section('content')

<div class="row">
	<div class="col-sm-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active">
					<a id="datos-tab" data-toggle="tab" href="#div-datos" aria-expanded="true">Datos Principales</a>
				</li>
			</ul>
			{!! Form::open(['route' => 'metas.store']) !!} 
			{!! Form::hidden('creador_id', Auth::user()->id) !!}
			<div class="tab-content" id="metas-tab-content">
				<div class="tab-pane active" id="div-datos">
					<div class="box-body">
					<div class="col-sm-12">
						<div class="form-group">
							{!! Form::label('actividad_id', 'Actividad', ['class'=>'control-label control-label-sm']) !!}
							<select name="actividad_id" id="actividad_id" class="custom-select form-control form-control-sm">
								<option>Escoje una actividad...</option>
								@foreach ($actividades as $actividad)
								<option value="{{$actividad->id}}">{{$actividad->nombre}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							{!! Form::label('nombre', 'Nombre', ['class'=>'control-label control-label-sm']) !!} {!! Form::text('nombre', null, ['class'=>'form-control
							form-control-sm', 'placeholder'=>'Nombre'])!!}
						</div>
						<div class="form-group">
							{!! Form::label('producto', 'Producto', ['class'=>'control-label control-label-sm']) !!} {!!Form::text('producto', null,
							['class'=>'form-control form-control-sm', 'placeholder'=>'Producto'])!!}
						</div>
						<div class="form-group">
							{!! Form::label('presupuesto', 'Presupuesto', ['class'=>'control-label control-label-sm']) !!}
							<div class="input-group input-group-sm">
								<div class="input-group-addon">S/.</div>
								{!!Form::text('presupuesto', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Presupuesto', 'aria-label'=>'Username'])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('fecha_inicio_esperada', 'Fecha de inicio esperada', ['class'=>'control-label control-label-sm']) !!}
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								{!! Form::text('fecha_inicio_esperada',null, ['class'=>'datepicker form-control form-control-sm pull-right', 'placeholder' => 'Fecha de inicio esperada']) !!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('fecha_fin_esperada', 'Fecha final esperada', ['class'=>'control-label control-label-sm']) !!}
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								{!! Form::text('fecha_fin_esperada',null, ['class'=>'datepicker form-control form-control-sm', 'placeholder' => 'Fecha final esperada']) !!}
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<a class="btn btn-outline-secondary text-uppercase" href="{{route('actividades.index')}}"> Cancelar</a>
							<button class="btn btn-success text-uppercase" type="submit"><i class="icon-plus"></i> Crear</button>
						</div>
					</div>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
 
@section('script')
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