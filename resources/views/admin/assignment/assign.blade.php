@extends('admin.partial.layout')
@section('title', 'Assign permissions to roles')
@section('heading_breadcrumb')
  <h1>Assign Permissions to Roles</h1>
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
          <h3 class="box-title">Assign permissions to : <span class="label label-primary">{{ $role['name'] }}</span></h3>
      </div>
      {!! Form::open(['route' => env('ADMIN_URL').'.assignment', 'method' => 'post', 'name' => 'assignmentform']) !!}
      <div class="box-body">
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                  <th rowspan="1" colspan="1">Permissions</th>
                  <th rowspan="1" colspan="1" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $permissions as $permission)
                  <tr role="row" class="odd">
                    <td>
                        <strong>{{ $permission['name'] }}</strong>
                        <p class="text-info"><small>{{ $permission['label'] }}</small></p>
                    </td>
                    <td class="text-center" valign="middle">
                      {!! Form::checkbox('permissions[]', $permission['id'], $permission['active']) !!}
                    </td>
                  </tr>

                  @endforeach
                
              </tbody>
               </table>
             </div>
           </div>
         </div>
         
      </div>
      <!-- /.box-body -->
      <!-- box-footer -->
      <div class="box-footer">
          <a href="{{{ URL::route(env('ADMIN_URL').'.assignment') }}}" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Save</button>
      </div>
      <!-- /box-footer -->
      {!! Form::hidden('role_id', $role['id']) !!}
      {!! Form::close() !!}
    </div>
@stop
        