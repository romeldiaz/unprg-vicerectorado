@extends('layouts.dashPanel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                @include('partials.myMessage')
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                          <input type="text" name="nombres" value="{{old('nombres')}}" class="form-control form-control-sm {{ $errors->has('nombres')?'is-invalid':''}} " placeholder="Nombres">
                          @if($errors->has('nombres'))
                            <div class="invalid-feedback">
                              {{ $errors->first('nombres')}}
                            </div>
                          @endif
                        </div>

                        <div class="form-group">
                          <input type="text" name="paterno" value="{{ old('paterno') }}" class="form-control form-control-sm {{ $errors->has('paterno')?'is-invalid':''}} " placeholder="Apellido Paterno">
                          @if($errors->has('paterno'))
                            <div class="invalid-feedback">
                              {{ $errors->first('paterno')}}
                            </div>
                          @endif
                        </div>

                        <div class="form-group">
                          <input type="text" name="materno" value="{{ old('materno') }}" class="form-control form-control-sm {{ $errors->has('materno')?'is-invalid':''}} " placeholder="Apellido Materno" >
                          @if($errors->has('materno'))
                            <div class="invalid-feedback">
                              {{ $errors->first('materno')}}
                            </div>
                          @endif
                        </div>

                        <div class="form-group">
                          <input type="text" name="cuenta" value="{{ old('cuenta') }}" class="form-control form-control-sm {{ $errors->has('cuenta')?'is-invalid':''}} " placeholder="Cuenta" >
                          @if($errors->has('cuenta'))
                            <div class="invalid-feedback">
                              {{ $errors->first('cuenta')}}
                            </div>
                          @endif
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
