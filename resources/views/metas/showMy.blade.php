@extends('layouts.app') 
@section('content')
<div class="row">
	<div class="col-2">
		<div class="list-group" id="list-tab" role="tablist">
			<a class="list-group-item list-group-item-action" href="{{ route('metas.all') }}">Todas</a>
			<a class="list-group-item list-group-item-action active" href="{{ route('metas.my') }}">Mis metas</a>
		</div>
	</div>
	<div class="col-10">
		<table class="table table-hover table-sm">
			<thead>
				<tr>
					<th>N°</th>
					<th>Nombre</th>
					<th>Fecha</th>
					<th>Presupuesto</th>
					{{--
					<th>By</th> --}}
					<th class="text-center" style="width: 150px">
						{{ link_to('metas/create', 'Crear', ['class'=>'btn btn-sm btn-primary']) }}
					</th>
				</tr>
			</thead>
			<tbody>
				<?php $num=0; ?> @foreach($metas as $key => $meta)
				<?php $num++; ?>
				<tr>
					<td>{{$meta->id}}</td>
					<td>{{$meta->nombre}}</td>
					<td>{{ date("d/m/Y", strtotime($meta->fecha_inicio))}}</td>
					<td>{{number_format($meta->presupuesto, 2, '.', ',')}}</td>
					{{--
					<td>{{$meta->creador_id}}</td> --}}
					<td class="text-center">
						<a href="{{route('metas.show', $meta->id)}}" title="Ver" class="btn btn-sm btn-info text-uppercase"><i class="icon-search"></i></a>
						<a href="{{route('metas.edit', $meta->id)}}" title="Editar" class="btn btn-sm btn-warning text-uppercase"><i class="icon-pencil"></i></a>
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
										¿Realmente desea eliminar la meta "<strong>{{ $meta->nombre }}</strong>"?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button> 
										{!! Form::open(['route' =>['metas.destroy', $meta->id], 'class' => 'new-form-inline', 'method' => 'DELETE']) !!}
										<button type="submit" class="btn btn-sm btn-danger">Eliminar</button> {!! Form::close() !!}
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
 
@section('script') {{--
<script src="{{ url('js/meta.js') }}"></script> --}}
@endsection