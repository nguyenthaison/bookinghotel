@extends('admin.partial.layout')
@section('title', 'Edit Permission')
@section('heading_breadcrumb')
  <h1>Edit Permission</h1>
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
          <h3 class="box-title">Edit : {{ $permissions->name }}</h3>
      </div>
      {!! Form::open(['route' => [env('ADMIN_URL').'.permission.update', $permissions->id], 'method' => 'put', 'name' => 'permissionform']) !!}
      <div class="box-body">
        <div class="col-xs-12 col-md-4">
          <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
            <label for="key">Name</label>
              <input type="text" class="form-control" value="{!! $errors->has('name') ? old('name') : str_replace('-', ' ', $permissions->name) !!}" name="name" id="name" placeholder="Enter Permission Name">
              {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
          </div>
          
          <div class="form-group">
            <label for="key">Label</label>
              <input type="text" class="form-control" name="label" id="label" value="{!! old('label') !== null ? old('label') : $permissions->label !!}" placeholder="Enter Label">
          </div>
        </div>
      </div>
      <!-- /.box-body -->
       <input type="hidden" value="{!! count($errors) > 0 ? old('id') : $permissions->id !!}" name="id">
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
@stop
        