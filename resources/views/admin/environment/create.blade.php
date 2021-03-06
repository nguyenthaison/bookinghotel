@extends('admin.partial.layout')
@section('title', 'Create New Environment')
@section('heading_breadcrumb')
  <h1>Environments Configuration</h1>
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
          <h3 class="box-title">Environments: Add</h3>
      </div>
      {!! Form::open(['route' => env('ADMIN_URL').'.environment.store', 'method' => 'post', 'name' => 'environmentform']) !!}
      <div class="box-body">
        <div class="col-xs-12 col-md-4">
          <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <label for="key">Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Enter Environment Type">
              {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
          </div>          
        </div>
      </div>
      <div class="box-body">
        <div class="col-xs-12 col-md-9">
          <div class="form-group">
            <label for="key">Description</label>
              <textarea name="description" id="text_area" class="form-control" >{{ old('description') }}</textarea>
              <script type="text/javascript">
                CKEDITOR.replace( 'text_area' );
              </script>
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
        