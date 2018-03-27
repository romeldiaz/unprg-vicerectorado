@extends('layouts.main')


@section('content')
  <div class="row">
    <div class="col col-sm-12">

      <div class="box">
        <div class="box-header with-border">

          <div class="box-title">
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Filtro
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-folder"></i> <span>Examples</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="../examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                    <li><a href="../examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                    <li><a href="../examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                    <li><a href="../examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                    <li><a href="../examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                    <li><a href="../examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                    <li><a href="../examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                    <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                    <li><a href="../examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
                  </ul>
                </li>
                <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Fecha</th>
                  <th>Tipo</th>
                  <th class="text-right">Ir</th>
                </tr>
            </thead>
            <tbody id="table-body-oficinas">
                @foreach($notificaciones as $key => $notificacion)
                  <tr>
                    <td>{{ $notificacion->id }}</td>
                    <td>{{ $notificacion->fecha }}</td>
                    <td>{{ $notificacion->tipo }}</td>
                    <td>
                      <div class="text-right">
                        <div class="btn-group">
                          <a href="{{ url('notificaciones/'.$notificacion->id) }}" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil"></i>Ir</a>
                        </div>
                      </div>

                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="box-footer clearfix">
          <div id="mypag" hidden>
            @if($notificaciones->total()!=0)
              <div class="text-right">
                  {{ $notificaciones->firstItem().'-'.$notificaciones->lastItem().'/'.$notificaciones->total()}}

                {{ $notificaciones->links() }}
              </div>


            @else
              No hay registros
            @endif
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection

@section('script')
  <script src="{{ url('js/comun.js') }}"></script>
@endsection
