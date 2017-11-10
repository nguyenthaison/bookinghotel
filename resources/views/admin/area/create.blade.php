@extends('admin.partial.layout')
@section('title', 'Create New Area')
@section('heading_breadcrumb')
  <h1>Area Configuration</h1>
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
          <h3 class="box-title">Area: Add</h3>
      </div>
      {!! Form::open(['route' => env('ADMIN_URL').'.area.store', 'method' => 'post', 'name' => 'areaform']) !!}
      <div class="box-body">
        <div class="col-xs-12 col-md-4">
          <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <label for="key">Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Enter Area Name">
              {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group {!! $errors->has('region_id') ? 'has-error' : '' !!}">
            <label for="key">Region</label>
              {{ Form::select('region_id', $regions, null, ['class' => 'form-control']) }}
              {!! $errors->first('region_id', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group">
            <label for="key">Description</label>
              <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
          </div>
          <div class="form-group">
            <label for="key">Longitude (Google Map)</label>
              <input type="text" class="form-control" name="longitude" id="longitude" value="{{ old('longitude') }}" placeholder="Enter Longitude">
          </div>
          <div class="form-group">
            <label for="key">Latitude (Google Map)</label>
              <input type="text" class="form-control" name="latitude" id="latitude" value="{{ old('latitude') }}" placeholder="Enter Latitude">
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
        