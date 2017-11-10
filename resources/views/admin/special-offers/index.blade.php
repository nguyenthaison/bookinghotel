@extends('admin.partial.layout')
@section('title', 'Special Offers List')
@section('heading_breadcrumb')
  <h1>Villa Configuration</h1>
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
          <span>Created special offers succesfull</span>
        </div>
    @endif
    <!-- Content -->
    <div ng-controller="adminController">
    <div class="box box-default" ng-init="getSpecialOffersList()">
        <div class="box-header with-border">
            <h3 class="box-title">Special Offers: List</h3>
            <div class="pull-right">
              <div class="form-inline">
              <input ng-model="searchSpecialOffers" placeholder="Search Special Offers">
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
                    <th rowspan="1" colspan="1">Villa Name</th>
                    <th rowspan="1" colspan="1">Special Offers Title</th>
                    <th rowspan="1" colspan="1">Period End</th>
                    <th rowspan="1" colspan="1">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <tr role="row" class="odd" ng-repeat="list in offersList | filter:searchSpecialOffers ">
                      <td>@{{ list.villa_name }}</td>
                      <td>@{{ list.title }}</td>
                      <td>@{{ list.period_end }}</td>
                      <td>
                        <a ng-href="@{{ list.editUrl }}" class="btn btn-default btn-sm"><i class="fa fa-pencil fa-lg"></i> </a>
                        <button ng-click="offersModal(list)" class="btn btn-default btn-sm" ><i class="fa fa-trash fa-lg"></i></button>
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