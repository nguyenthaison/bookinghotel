@extends('admin.partial.layout')
@section('title', 'Create New Villa')
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
    <!-- Content -->
    <div ng-controller="adminController">
      <div class="callout callout-danger lead" ng-show="contentFailed">
            @{{ failedMessage }}
            <ul>
            <li ng-repeat="error in errors">@{{ error }}</li>
            </ul>
      </div>
      <div class="callout callout-success lead" ng-show="contentSuccess">
            @{{ successMessage }}
      </div>
      <div class="box box-default" ng-init="getBedrooms()">
        
        <div class="box-header with-border">
            <h3 class="box-title">Villa: Add</h3>
        </div>
        <div class="box-body">
        <form name="villaform">
          <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="#content" data-toggle="tab">Content</a></li>
              <li role="presentation"><a href="#bedroom" data-toggle="tab">Bedrooms</a></li>
              <li role="presentation"><a href="#services_facilities" data-toggle="tab">Services &amp; Facilities</a></li>
              <li role="presentation"><a href="#term_conditions" data-toggle="tab">Term &amp; Condition</a></li>
              <li role="presentation"><a href="#other" data-toggle="tab">Other</a></li>
          </ul>

          <div class="panel-body no-gutter">
              <div class="tab-content">
              <!-- Content -->
              <div class="tab-pane fade in active" id="content">
                <div class="row">
                  <div class="col-xs-12 col-md-4">
                       <div class="form-group">
                        <label for="key">Status</label>
                          <div class="radio" ng-repeat="status in statusList">
                          <label><input type="radio" name="status" ng-model="villas.Status" ng-value="status.value" value="status.value"> @{{ status.title }}</label>
                          </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="featured">Featured</label>
                        <div class="checkbox">
                          <label><input type="checkbox" name="featured" ng-model="villas.Featured"> Yes</label>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="key">Title</label>
                          <input type="text" class="form-control" ng-model="villas.Title" villaavail ng-model-options="{ debounce: 600 }" ng-required="true" name="title" id="title" placeholder="Enter Villa Name">
                          <span ng-show=".title.$touched">
                            <span class="text-primary" ng-show="villaform.title.$pending.villaavail">checking villa status ...</span>
                            <span class="text-danger" ng-show="villaform.title.$error.villaavail">Villa name has been used, enter different name</span>
                            <span class="text-primary" ng-show="villaform.title.$valid">Villa name can be used</span>
                          </span>
                      </div>

                      <div class="form-group" ng-init="getAreas()">
                      <label for="key">Area</label>
                      <select class="form-control" name="area" ng-model="villas.Area" ng-required="true">
                          <option ng-repeat="area in areaList | orderBy: 'title'" ng-value="area.id" value="area.id">@{{area.title}}</option>
                    </select>
                  </div>
                     
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-md-9">
                    <div class="form-group">
                      <label for="key">Short Description / Intro</label>
                          <div ckeditor="intro" ng-model="villas.Intro" ready="onReady()"></div>
                    </div>
                    <div class="form-group">
                      <label for="key">Description</label>
                          <div ckeditor="description" ng-model="villas.Description" ready="onReady()"></div>
                    </div>
                  </div>  
                </div>

              </div>
              <!-- /Content -->
              <!-- Bedroom -->
              <div class="tab-pane fade" id="bedroom">
                <span>Please select room types</span>
                    <ui-select multiple ng-model="villas.multipleBedroom" theme="bootstrap"  close-on-select="false"  title="Choose bedroom">
                      <ui-select-match placeholder="Select Bedroom...">@{{$item.title}} &lt;@{{$item.number}}&gt;</ui-select-match>
                      <ui-select-choices group-by="someGroupFn" repeat="bedroom in bedroomList | propsFilter: {title: $select.search}">
                        <div ng-bind-html="bedroom.title | highlight: $select.search"></div>
                        <small>
                          Type: @{{bedroom.title}}
                          Number: <span ng-bind-html="''+bedroom.number | highlight: $select.search"></span>
                        </small>
                      </ui-select-choices>
                    </ui-select>
              </div>
              <!-- /Bedroom -->
              <!-- Services & Facilities -->
              <div class="tab-pane fade" id="services_facilities">
                <div class="row">
                  <div class="col-xs-12 col-md-9">
                      <div class="form-group">
                        <label for="key">services</label>
                          <div ckeditor="services" ng-model="villas.Services" ready="onReady()"></div>
                      </div>
                      <div class="form-group">
                        <label for="key">facilities</label>
                          <div ckeditor="facilities" ng-model="villas.Facilities" ready="onReady()"></div>
                      </div>
                      <div class="form-group">
                        <label for="key">Staff Detail</label>
                          <div ckeditor="staff_detail" ng-model="villas.Staff_detail" ready="onReady()"></div>
                      </div>
                  </div>
                </div>  
              </div>
              <!-- /Services & Facilities -->
              <!-- Term & Condition -->
              <div class="tab-pane fade" id="term_conditions">
                <div class="row">
                  <div class="form-group">
                        <label for="key">Terms &amp; Conditions</label>
                          <div ckeditor="term_condition" ng-model="villas.Term_condition" ready="onReady()"></div>
                  </div>
                </div>
              </div>
              <!-- /Term & Condition -->
              <!-- Other -->
              <div class="tab-pane fade" id="other">
                <div class="col-xs-12 col-md-5">
                  <div class="form-group">
                      <label for="key">Latitude Coordinate (Google Map)</label>
                      <input type="text" class="form-control" name="latitude" ng-model="villas.Latitude" id="latitude" placeholder="Enter latitude coordinate">
                  </div>
                  <div class="form-group">
                      <label for="key">Longitude Coordinate (Google Map)</label>
                      <input type="text" class="form-control" name="longitude" id="longitude" ng-model="villas.Longitude" placeholder="Enter longitude coordinate">
                  </div>
                  <div class="form-group">
                      <label for="key">Occupied Maximum</label>
                      <input type="text" class="form-control" name="occupied_max" id="occupied_max" ng-model="villas.Occupied_max" placeholder="Enter occupied maximum">
                  </div>
                  <div class="form-group">
                      <label for="key">Bedrooms Number</label>
                      <input type="text" class="form-control" name="bedrooms_no" id="bedrooms_no" ng-model="villas.Bedrooms_no" placeholder="Enter bedrooms number">
                  </div>
                  <div class="form-group">
                      <label for="key">Staff Number</label>
                      <input type="text" class="form-control" name="staff_no" id="staff_no" ng-model="villas.Staff_no" placeholder="Enter staff number">
                  </div>
                  <div class="form-group" ng-init="getEnvironments()">
                      <label for="key">Villa Environment</label>
                      <select class="form-control" name="role" ng-model="villas.Environment">
                          <option ng-repeat="environment in environmentList | orderBy: 'title'" ng-value="environment.id" value="environment.id">@{{environment.title}}</option>
                    </select>
                  </div>
                  
                </div>
              </div>
              <!-- /Other -->
              </div>
          </div>
        </div>
        </form>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" ng-click="postVillas(villas)" ng-disabled="villaform.$invalid" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
@stop
        