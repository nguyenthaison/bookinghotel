@extends('admin.partial.layout')
@section('title', 'Create New User')
@section('heading_breadcrumb')
  <h1>User Configuration</h1>
  <!-- breadcrumbs -->
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
  </ol>
  <!-- .breadcrumbs -->
@stop
@section('content')
    <!-- Content -->
    <div class="box box-default">
      <div class="box-header with-border">
          <h3 class="box-title">User: Add</h3>
      </div>
      {!! Form::open(['route' => env('ADMIN_URL').'.user.store', 'method' => 'post', 'name' => 'userform']) !!}
      <div class="box-body">
        <div class="col-xs-12 col-md-4">
          <div class="form-group {!! $errors->has('first_name') ? 'has-error' : '' !!}">
            <label for="key">First Name</label>
              <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name">
              {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group">
            <label for="key">Last Name</label>
              <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name">
          </div>
          <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
            <label for="key">Email</label>
              <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Email">
              {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group {!! $errors->has('country_id') ? 'has-error' : '' !!}">
            <label for="key">Country</label>
              {{ Form::select('country_id', $countries, null, ['class' => 'form-control']) }}
              {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group {!! $errors->has('role_id') ? 'has-error' : '' !!}">
            <label for="key">Roles</label>
              {{ Form::select('role_id', $roles, null, ['class' => 'form-control']) }}
              {!! $errors->first('role_id', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
            <label for="key">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
              {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
            <label for="key">Password confirmation</label>
              <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password confirmation">
              {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
          </div>
          
          
        </div>
      </div>
      <!-- /.box-body -->
      {!! csrf_field() !!}
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
@stop
        