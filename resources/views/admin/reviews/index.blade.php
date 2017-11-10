@extends('admin.partial.layout')
@section('title', 'Reviews List')
@section('heading_breadcrumb')
  <h1>Guest Reviews</h1>
  <!-- breadcrumbs -->
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
  </ol>
  <!-- .breadcrumbs -->
@stop
@section('content')
    @if (isset($status) && $status === '1')
        <div class="callout callout-info lead">
          <span>Reviews created succesfully</span>
        </div>
    @elseif (isset($status) && $status === '2')
        <div class="callout callout-info lead">
          <span>Review approved</span>
        </div>
    @endif
    <!-- Content -->
    <div ng-controller="adminController">
    <div class="box box-default" ng-init="getReviews()">
        <div class="box-header with-border">
            <h3 class="box-title">Reviews: List</h3>
            <div class="pull-right">
              <div class="form-inline">
              <input ng-model="searchReviews" placeholder="Search Reviews">
              </div>
            </div>
        </div>
        
        <div class="box-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                <div class="col-sm-12">
                  <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                  <tr role="row">
                    <th rowspan="1" colspan="1">Guest Name</th>
                    <th rowspan="1" colspan="1">Villa</th>
                    <th rowspan="1" colspan="1">Period Stay</th>
                    <th rowspan="1" colspan="1">Status</th>
                    <th rowspan="1" colspan="1">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr role="row" class="odd" ng-repeat="list in reviewsVilla | filter:searchReviews ">
                      <td>@{{ list.guestName }}</td>
                      <td>@{{ list.villa }}</td>
                      <td>@{{ list.period_stay }}</td>
                      <td>@{{ list.status }}</td>
                      <td>
                      @can('approve-review')
                        <a ng-href="@{{ list.approvedUrl }}" class="btn btn-info btn-sm" ng-show="list.status == 'draft' "><i class="fa fa-pencil fa-lg"></i> Approved </a>
                      @endcan
                      @can('delete-review')
                        <button ng-click="reviewModal(list)" class="btn btn-default btn-sm" ><i class="fa fa-trash fa-lg"></i></button>
                      @endcan
                      </td>
                    </tr>

                  
                </tbody>
                 </table>
               </div>
             </div>
           </div>
         
        </div>
      <!-- /.box-body -->

      
    </div>
  </div>
@stop