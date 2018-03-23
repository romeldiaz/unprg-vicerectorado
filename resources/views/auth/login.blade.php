@extends('layouts.log')

@section('content')
<p class="login-box-msg">Registrate para empesar tu sesión</p>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group has-feedback">
      <input id="cuenta" type="text" class="form-control{{ $errors->has('cuenta') ? ' is-invalid' : '' }}" name="cuenta" value="{{ old('cuenta') }}" placeholder="cuenta" required autofocus>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      @if ($errors->has('cuenta'))
          <span class="invalid-feedback">
              <strong>{{ $errors->first('cuenta') }}</strong>
          </span>
      @endif
    </div>

    <div class="form-group has-feedback">
      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      @if ($errors->has('password'))
          <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif
    </div>

    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
      </div>
      <!-- /.col -->
    </div>
</form>
@endsection
