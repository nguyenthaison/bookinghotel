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
          <h3 class="box-title">Roles</h3>
      </div>
      
      <div class="box-body">
          @if (isset($roles))
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                  <th rowspan="1" colspan="1">Roles</th>
                  <th rowspan="1" colspan="1">Action</th>
                </tr>
                </thead>
                <tbody>

                  @foreach ( $roles as $role)
                  <tr role="row" class="odd">
                    <td>
                        <strong>{{ $role->name }}</strong>
                    </td>
                    <td>
                        <a href="{{ Route(env('ADMIN_URL').'.assignment.edit', array($role->id)) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil fa-lg"></i></a>
                    </td>
                  </tr>

                  @endforeach
                
              </tbody>
               </table>
             </div>
           </div>
         </div>
         @else
            <p>Data not available</p>
         @endif
      </div>
      <!-- /.box-body -->

      
    </div>
@stop
        