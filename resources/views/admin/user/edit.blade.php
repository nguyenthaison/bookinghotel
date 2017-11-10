@extends('admin.partial.layout')
@section('title', 'Edit User')
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
          <h3 class="box-title">User: Edit</h3>
      </div>
      {!! Form::open(['route' => [env('ADMIN_URL').'.user.update', $users_arr['id']], 'method' => 'put', 'name' => 'userform']) !!}
      <div class="box-body">
        <div class="col-xs-12 col-md-4">
          <div class="form-group {!! $errors->has('first_name') ? 'has-error' : '' !!}">
            <label for="key">First Name</label>
              <input type="text" class="form-control" name="first_name" id="first_name" value="{!! $errors->has('first_name') ? old('first_name') : $users_arr['first_name'] !!}" placeholder="Enter First Name">
              {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group">
            <label for="key">Last Name</label>
              <input type="text" class="form-control" name="last_name" id="last_name" value="{!! $errors->has('last_name') ? old('last_name') : $users_arr['last_name'] !!}" placeholder="Enter Last Name">
          </div>
          <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
            <label for="key">Email</label>
              <input type="text" class="form-control" name="email" id="email" value="{!! $errors->has('email') ? old('email') : $users_arr['email'] !!}" placeholder="Enter Email">
              {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group {!! $errors->has('country_id') ? 'has-error' : '' !!}">
            <label for="key">Country</label>
              {{ Form::select('country_id', $countries, $users_arr['country_id'], ['class' => 'form-control']) }}
              {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group {!! $errors->has('role_id') ? 'has-error' : '' !!}">
            <label for="key">Roles</label>
              {{ Form::select('role_id', $roles, $users_arr['role_id'], ['class' => 'form-control']) }}
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
          <input type="hidden" value="{!! count($errors) > 0 ? old('id') : $users_arr['id'] !!}" name="id">

          
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
@stop
        