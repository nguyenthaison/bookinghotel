@extends('admin.partial.layout')
@section('title', 'Create New Role')
@section('heading_breadcrumb')
  <h1>Role Configuration</h1>
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
          <h3 class="box-title">Role: Add</h3>
      </div>
      {!! Form::open(['route' => env('ADMIN_URL').'.role.store', 'method' => 'post', 'name' => 'roleform']) !!}
      <div class="box-body">
        <div class="col-xs-12 col-md-4">
          <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
            <label for="key">Title</label>
              <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Role Name">
              {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group">
            <label for="key">Label</label>
              <input type="text" class="form-control" name="label" id="label" value="{{ old('label') }}" placeholder="Enter Label">
          </div>
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
@stop
        