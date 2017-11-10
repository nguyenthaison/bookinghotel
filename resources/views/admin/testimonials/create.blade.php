@extends('admin.partial.layout')
@section('title', 'Add Guest Testimonial')
@section('heading_breadcrumb')
  <h1>Add Guest Testimonial</h1>
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
	            <h3 class="box-title">Testimonial: add guest testimonial manually</h3>
	        </div>

	        <div class="box-body">
	        	<form name="TestimonialForm">
	        	<div class="row">
	        		<div class="col-xs-12 col-md-5">

						<label for="guest">Guest Name</label>
						<div class="form-group">
							<input type="text" class="form-control" ng-model="testimonials.GuestName" name="GuestName" ng-required="true"></input>
						</div>

						<label for="city">City</label>
						<div class="form-group">
                            <input type="text" class="form-control" ng-model="testimonials.City" name="City"></input>
                        </div>

						<label for="country">Country</label>
						<div class="form-group" ng-init="countries()">
                            <select class="form-control" name="role" ng-model="testimonials.Country_id" ng-required="true">
                              <option ng-repeat="country in countryList | orderBy: 'name'" ng-value="country.id" value="country.id">@{{country.name}}</option>
                            </select>
                        </div>

						<label for="key">Testimonial</label>
						<div class="form-group">
		                    <div ckeditor="TestimonialComment" ng-model="testimonials.Comments" ready="onReady()"></div>
		                </div>

					</div>
				</div>
				</form>
			</div>
			<div class="box-footer">
	          <button type="submit" ng-click="postTestimonials(testimonials)" ng-disabled="TestimonialForm.$invalid" class="btn btn-primary">Submit</button>
	        </div>
	    </div>

    </div>
    <!-- /Content -->
@stop