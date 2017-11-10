@extends('admin.partial.layout')
@section('title', 'Villas List')
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
          <span>Villa updated succesfull</span>
        </div>
    @endif
    <!-- Content -->
    <div ng-controller="adminController">
    <div class="box box-default" ng-init="getVillaList()">
        <div class="box-header with-border">
            <h3 class="box-title">Villas: List</h3>
            <div class="pull-right">
              <div class="form-inline">
              <input ng-model="searchVilla" placeholder="Search Villa">
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
                    <th rowspan="1" colspan="1">Area</th>
                    <th rowspan="1" colspan="1">Status</th>
                    <th rowspan="1" colspan="1">Featured</th>
                    <th rowspan="1" colspan="1">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <tr role="row" class="odd" ng-repeat="list in villaList | filter:searchVilla ">
                      <td>@{{ list.title }}</td>
                      <td>@{{ list.area }}</td>
                      <td>@{{ list.status }}</td>
                       <td>@{{ list.featured }}</td>
                      <td>
                        <a ng-href="@{{ list.rateUrl }}" class="btn btn-default btn-sm"><i class="fa fa-money fa-lg"></i> </a>
                         <a ng-href="@{{ list.galleryUrl }}" class="btn btn-default btn-sm"><i class="fa fa-file-image-o fa-lg"></i> </a>
                         <a ng-href="@{{ list.editUrl }}" class="btn btn-default btn-sm"><i class="fa fa-pencil fa-lg"></i> </a>
                        <button ng-click="villaModal(list)" class="btn btn-default btn-sm" ><i class="fa fa-trash fa-lg"></i></button>
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