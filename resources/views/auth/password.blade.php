@extends('templates.frontend_layout')
@section('title', 'Forgot password')

@section('content')
  <form method="POST" action="/password/email">
    {!! csrf_field() !!}

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
                <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
            </div>
        </div>
    </div>
</form>
@stop