@extends('admin.partial.layout')
@section('title', 'Edit Special Offers')
@section('heading_breadcrumb')
  <h1>Create Special Offers</h1>
  <!-- breadcrumbs -->
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
  </ol>
  <!-- .breadcrumbs -->
@stop
@section('content')
    <!-- Content -->
    <div ng-controller="adminController" ng-init="getSpecialOffers(<?=$id?>)">

    	<div class="callout callout-danger lead" ng-show="contentFailed">
            @{{ failedMessage }}
            <ul>
            <li ng-repeat="error in errors">@{{ error }}</li>
            </ul>
      	</div>
      	<div class="callout callout-success lead" ng-show="contentSuccess">
            @{{ successMessage }}
      	</div>

    	<div class="box box-default">
	    	<div class="box-header with-border">
	            <h3 class="box-title">Villa: Edit Special Offers</h3>
	        </div>
	        <div class="box-body">
	        	<form name="SpecialOffersForm">
	        	<div class="row" ng-init="offersVillaList()">
	        		<div class="col-xs-12 col-md-5">

	        		<label for="villa_id">Villa Name</label>
		        	<div class="form-group">
			        	<ui-select ng-model="offers.VillaOffers.selected" theme="bootstrap" style="min-width: 300px;" title="Choose a villa">
						<ui-select-match placeholder="Select villa...">@{{$select.selected.title}}</ui-select-match>
						<ui-select-choices repeat="villa in offersVilla | propsFilter: {title: $select.search, area: $select.search}" position='auto'>
							<div ng-bind-html="villa.title | highlight: $select.search"></div>
							      <small>
							        @{{villa.title}}
							        area: <span ng-bind-html="''+villa.area | highlight: $select.search"></span>
							      </small>
							    </ui-select-choices>
							  </ui-select>
					</div>

	        	    	<label for="title">Special offers Title</label>
			        	<div class="form-group">
			        		<input type="text" class="form-control" ng-model="offers.Title"></input>
			        	</div>

			            <label for="Start Date">Start Date</label>
			            <div class="input-group">
			                <input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="offers.StartDate" is-open="datepicker.openStart" max-date="maxDate" datepicker-options="dateOptions" close-text="Close" name="StartDate" />                            
			                 <span class="input-group-btn">
			                    <button type="button" class="btn btn-default" ng-click="openStart($event)">
			                    <i class="glyphicon glyphicon-calendar"></i>
			                    </button>
			                 </span>
			            </div>

			            <label for="Start Date">End Date</label>
			            <div class="input-group">
					            <input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="offers.EndDate" is-open="datepicker.endStart"  datepicker-options="dateOptions" close-text="Close" name="EndDate" />                            
		                      <span class="input-group-btn">
		                        <button type="button" class="btn btn-default" ng-click="endStart($event)">
		                        <i class="glyphicon glyphicon-calendar"></i>
		                        </button>
		                      </span>
			            </div>

			            <label for="discount">Discount</label>
			            <div class="form-group">
			            	<input type="text" class="form-control" ng-model="offers.Discount"></input>
			            </div>

			            <label for="discount">Remark</label>
			            <div class="form-group">
			            	<input type="text" class="form-control" ng-model="offers.Other"></input>
			            </div>
			        </div>
			    </div>
			    <input type="hidden" ng-model="offers.Id">
	        	</form>
	        </div>
	        <div class="box-footer">
	          <button type="submit" ng-click="editSpecialOffers(offers)" ng-disabled="SpecialOffersForm.$invalid" class="btn btn-primary">Submit</button>
	        </div>
	    </div>
    </div>
    <!-- /Content -->
@stop
