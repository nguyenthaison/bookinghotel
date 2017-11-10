@extends('admin.partial.layout')
@section('title', 'Setting Configuration')
@section('heading_breadcrumb')
  <h1>Settings Configuration</h1>
  <!-- breadcrumbs -->
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
  </ol>
  <!-- .breadcrumbs -->
@stop
@section('content')
    @if (Session::has('message'))
        <div class="callout callout-info lead">
          {{ Session::get('message') }}
        </div>
    @endif
    <!-- Content -->
    <div class="box box-default">
      <div class="box-header with-border">
          <h3 class="box-title">Welcome back, admin</h3>
      </div>
      
      <div class="box-body">
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12">
                @can('create-bedroom')
                 <a href="#">add bedroom</a>
                 @endcan

                 @can('create-season')
                    <a href="#">Add season</a>
                @endcan
             </div>
           </div>
         </div>
      </div>
      <!-- /.box-body -->

      
    </div>
@stop