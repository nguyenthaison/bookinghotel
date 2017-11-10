@extends('admin.partial.layout')
@section('title', 'Edit Country')
@section('heading_breadcrumb')
  <h1>Edit Country</h1>
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
          <h3 class="box-title">Edit : {{ $countries->name }}</h3>
      </div>
      {!! Form::open(['route' => [env('ADMIN_URL').'.country.update', $countries->id], 'method' => 'put', 'name' => 'countryform']) !!}
      <div class="box-body">
        <div class="col-xs-12 col-md-4">
          <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
            <label for="key">Title</label>
              <input type="text" class="form-control" value="{!! $errors->has('name') ? old('name') : $countries->name !!}" name="name" id="name" placeholder="Enter Country Name">
              {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
          </div>
          <input type="hidden" value="{!! count($errors) > 0 ? old('id') : $countries->id !!}" name="id">
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
@stop
        