@extends('admin.partial.login_layout')
@section('title', 'Login')
@section('logo')
  <h1>Bali Home Paradise</h1>
@stop
@section('content')
      
    <p class="login-box-msg">Control Center Login</p>
    

    <form method="POST" action="{{ url('/login') }}" name="loginform">
      {{ csrf_field() }}
      <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="text" class="form-control" name="email" placeholder="Email address">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('email'))
          <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck" style="margin-left:25px;">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-default btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br/>

    <a href="{{ url('/password/reset') }}">Forgot Password?</a><br/>
    <a href="{{ url('/') }}">Home</a><br>

@stop
