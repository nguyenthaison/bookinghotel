@extends('admin.partial.layout')
@section('title', 'Edit Region')
@section('heading_breadcrumb')
  <h1>Edit Region</h1>
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
          <h3 class="box-title">Edit : {{ $regions->title }}</h3>
      </div>
      {!! Form::open(['route' => [env('ADMIN_URL').'.region.update', $regions->id], 'method' => 'put', 'name' => 'regionform']) !!}
      <div class="box-body">
        <div class="col-xs-12 col-md-4">
          <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <label for="key">Title</label>
              <input type="text" class="form-control" value="{!! $errors->has('title') ? old('title') : $regions->title !!}" name="title" id="title" placeholder="Enter Region Name">
              {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group {!! $errors->has('number') ? 'has-error' : '' !!}">
            <label for="key">Country</label>
             {{ Form::select('country_id', $countries, $regions->country_id, ['class' => 'form-control']) }}
              {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
          </div>
          <input type="hidden" value="{!! count($errors) > 0 ? old('id') : $regions->id !!}" name="id">
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
@stop
        