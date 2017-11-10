@extends('admin.partial.layout')
@section('title', 'Edit Area')
@section('heading_breadcrumb')
  <h1>Edit Area</h1>
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
          <h3 class="box-title">Edit : {{ $areas->title }}</h3>
      </div>
      {!! Form::open(['route' => [env('ADMIN_URL').'.area.update', $areas->id], 'method' => 'put', 'name' => 'areaform']) !!}
      <div class="box-body">
        <div class="col-xs-12 col-md-4">
          <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <label for="key">Title</label>
              <input type="text" class="form-control" value="{!! $errors->has('title') ? old('title') : $areas->title !!}" name="title" id="title" placeholder="Enter Area Name">
              {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group {!! $errors->has('region_id') ? 'has-error' : '' !!}">
            <label for="key">Region</label>
             {{ Form::select('region_id', $regions, $areas->region_id, ['class' => 'form-control']) }}
              {!! $errors->first('region_id', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group">
            <label for="key">Description</label>
              <textarea class="form-control" name="description" id="description">{{ $areas->description }}</textarea>
          </div>
          <div class="form-group">
            <label for="key">Longitude (Google Map)</label>
              <input type="text" class="form-control" name="longitude" id="longitude" value="{{ $areas->longitude }}" placeholder="Enter Longitude">
          </div>
          <div class="form-group">
            <label for="key">Latitude (Google Map)</label>
              <input type="text" class="form-control" name="latitude" id="latitude" value="{{ $areas->latitude }}" placeholder="Enter Latitude">
          </div>
          <input type="hidden" value="{!! count($errors) > 0 ? old('id') : $areas->id !!}" name="id">
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
@stop
        