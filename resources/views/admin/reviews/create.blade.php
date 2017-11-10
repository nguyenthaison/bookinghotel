@extends('admin.partial.layout')
@section('title', 'Create Reviews Link')
@section('heading_breadcrumb')
  <h1>Create Guest Reviews Invitation</h1>
  <!-- breadcrumbs -->
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
  </ol>
  <!-- .breadcrumbs -->
@stop
@section('content')
    <!-- Content -->
    <div ng-controller="adminController">
    	
      	<div class="box box-default">
	    	<div class="box-header with-border">
	            <h3 class="box-title">Reviews: create reviews invitation link and send to client</h3>
	        </div>

	        <div class="box-body">
	        	<form name="ReviewsForm">
	        	<div class="row" ng-init="offersVillaList()">
	        		<div class="col-xs-12 col-md-5">

		        		<label for="villa_id">Villa Name</label>
			        	<div class="form-group">
				        	<ui-select ng-model="reviews.VillaReviews.selected" theme="bootstrap" style="min-width: 300px;" title="Choose a villa" ng-required="true">
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

						<label for="guest">Guest Name</label>
						<div class="form-group">
							<input type="text" class="form-control" ng-model="reviews.GuestName" name="GuestName" ng-required="true"></input>
						</div>

						<label for="guest">Email</label>
						<div class="form-group">
							<input type="text" class="form-control" ng-model="reviews.Email" name="Email" ng-required="true"></input>
						</div>

						<label for="city">City</label>
						<div class="form-group">
                            <input type="text" class="form-control" ng-model="reviews.City" name="City"></input>
                        </div>

						<label for="country">Country</label>
						<div class="form-group" ng-init="countries()">
                            <select class="form-control" name="role" ng-model="reviews.Country_id" ng-required="true">
                              <option ng-repeat="country in countryList | orderBy: 'name'" ng-value="country.id" value="country.id">@{{country.name}}</option>
                            </select>
                        </div>

						<label for="guest">Reviews type</label>
						<br>
						<small>Manual : insert reviews manual to database, Auto: let the guest insert the reviews trough our link</small>
						<div class="form-group">
							<div class="radio" ng-repeat="type in reviewsType">
	                          <label><input type="radio" name="type" ng-model="reviews.Type" ng-value="type.value" value="type.value"> @{{ type.title }}</label>
	                        </div>
						</div>

						<div ng-show="reviews.Type == 'manual' ">
							<label for="key">Reviews</label>
							<div class="form-group">
		                          <div ckeditor="ReviewsComment" ng-model="reviews.Comments" ready="onReady()"></div>
		                    </div>

						</div>

						<label for="period stay">Period of Stay</label>
			            <div class="input-group">
			                <input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="reviews.ArrivalDate" is-open="datepicker.openStart" max-date="maxDate" datepicker-options="dateOptions" close-text="Close" name="StartDate" />                            
			                 <span class="input-group-btn">
			                    <button type="button" class="btn btn-default" ng-click="openStart($event)">
			                    <i class="glyphicon glyphicon-calendar"></i>
			                    </button>
			                 </span>
			            </div>


					</div>
				</div>
				</form>
			</div>
			<div class="box-footer">
	          <button type="submit" ng-click="postReviews(reviews)" ng-disabled="ReviewsForm.$invalid" class="btn btn-primary">Submit</button>
	        </div>
	    </div>

    </div>
    <!-- /Content -->
@stop