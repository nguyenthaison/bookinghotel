@extends('admin.partial.layout')
@section('title', 'Bedrooms List')
@section('heading_breadcrumb')
  <h1>Bedrooms Configuration</h1>
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
          <h3 class="box-title">Bedrooms: List</h3>
      </div>
      
      <div class="box-body">
        <?php //dd(isset($settings)); ?>
          @if (isset($bedrooms))
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                  <th rowspan="1" colspan="1">Title</th>
                  <th rowspan="1" colspan="1">Numeric</th>
                  <th rowspan="1" colspan="1">Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>

                  @foreach ( $bedrooms as $bedroom)
                  <tr role="row" class="odd">
                    <td>{{ $bedroom->title }}</td>
                    <td>{{ $bedroom->number }}</td>
                    
                    <td>
                      <a href="{{ Route(env('ADMIN_URL').'.bedroom.edit', array($bedroom->id)) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil fa-lg"></i></a>
                    
                      <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal{{ $i }}">
                                <i class="fa fa-trash fa-lg"></i>
                      </button></td>
                  </tr>

                  <!-- Modal -->
                  <div class="modal fade" id="myModal{!! $i !!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
                        </div>
                        <div class="modal-body">
                          Are you sure want to delete bedroom : {!! $bedroom->title !!}
                        </div>
                        <div class="modal-footer">
                          {!! Form::open(array('method' => 'DELETE', 'route' => array(env('ADMIN_URL').'.bedroom.destroy', $bedroom->id))) !!}
                           <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                           
                              {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                           {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php $i++; ?>
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