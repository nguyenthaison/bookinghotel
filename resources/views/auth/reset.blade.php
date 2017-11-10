@extends('templates.frontend_layout')
@section('title', 'Forgot password')

@section('content')
  <form method="POST" action="/password/reset">
    {!! csrf_field() !!}

    <input type="hidden" name="token" value="{{ $token }}">
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="form-group">
                <label for="InputEmail">Email address</label>
                <input type="email" class="form-control" id="InputEmail" name="email" value="{{ old('email') }}" placeholder="Email address">
            </div>
            <div class="form-group">
                <label for="InputPassword1">New Password</label>
                <input type="password" class="form-control" id="InputPassword1" name="password" placeholder="New Password">
            </div>
            <div class="form-group">
                <label for="InputPassword2">Re-enter New Password</label>
                <input type="password" class="form-control" id="InputPassword2" name="password_confirmation" placeholder="Re-enter New Password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </div>
    </div>
</form>
@stop