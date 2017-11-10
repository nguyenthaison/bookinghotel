@extends('admin.partial.layout')
@section('title', 'Rate')
@section('heading_breadcrumb')
  <h1>Rate Configuration</h1>
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
      <div class="callout callout-danger lead" ng-hide="rateFailed">
            @{{ rateMessage }}
            <ul>
            <li ng-repeat="error in errors">@{{ error }}</li>
            </ul>
      </div>
      <div class="callout callout-success lead" ng-hide="rateSuccess">
            @{{ rateMessage }}
      </div>
      <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Rates: Add rate </h3>
        </div>
        <form name="bedroom_season">
        <div class="box-body">
          <div class="col-xs-12 col-md-4">
            <div class="form-group" ng-init="getVillaBedrooms(<?=$id?>)">
              <label for="key">Choose Bedroom Type</label>
                <select class="form-control" name="area" ng-model="form.Bedrooms" ng-required="true">
                          <option ng-repeat="bedroomList in villaBedroomList | orderBy: 'title'" ng-value="bedroomList.id" value="bedroomList.id">@{{bedroomList.title}}</option>
                </select>
            </div>
          </div>
          <div class="col-xs-12 col-md-4" ng-init="getSeasons()">
            <div class="form-group">
              <label for="key">Choose Season Type</label>
                <select class="form-control" name="area" ng-model="form.Seasons" ng-required="true">
                          <option ng-repeat="season in seasonList | orderBy: 'title'" ng-value="season.id" value="season.id">@{{season.title}}</option>
                </select>
            </div>
          </div>
          <div class="col-xs-12 col-md-12">
            <button type="submit" ng-click="addRates(form, <?=$id?>)" ng-disabled="bedroom_season.$invalid" class="btn btn-primary">Add</button>
         <!--   <input type="text" ng-model="totalrate"/> <button type="submit" ng-click="addTotalRate(<?=$id?>)">+</button> -->
          </div>
        </div>
        </form>
        <!-- /.box-body -->
        <form name="save_rate">
        <div class="box-body">

          <div class="row" ng-repeat="rate in itemRate">
            <div class="col-xs-12 col-md-12">
              <span class="label label-info">@{{ rate.BedroomTitle }} - @{{ rate.SeasonTitle }}</span>
            </div>
            <div class="col-xs-12 col-md-3">
               <label for="Start Date">Start Date</label>
                <div class="input-group">
                  <input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="rate.StartDate" is-open="datepicker.openStart" max-date="maxDate" datepicker-options="dateOptions" close-text="Close" name="StartDate" />                            
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="openStart($event)">
                        <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                      </span>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
              <label for="Start Date">End Date</label>
                <div class="input-group">
                
                   <input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="rate.EndDate" is-open="datepicker.endStart" max-date="maxDate" datepicker-options="dateOptions" close-text="Close" name="EndDate" />                            
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="endStart($event)">
                        <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                      </span>
                </div>
            </div>
            <div class="col-xs-12 col-md-1">
                <label for="Start Date">Min Stay</label>
                <div class="input-group">
                  <input type="text" class="rate_form" name="minimum" ng-model="rate.MinimumStay" ng-value="rate.MinimumStay"></input>
                </div>
            </div>
            <div class="col-xs-12 col-md-1">
                <label for="Start Date">Service-$</label>
                <div class="input-group">
                  <input type="text" class="rate_form" name="tax" ng-model="rate.Tax" ng-value="rate.Tax"></input>
                </div>
            </div>
            <div class="col-xs-12 col-md-1">
              <label for="Start Date">++</label>
                <div class="input-group">
                  <input type="checkbox" name="plusplus" ng-model="rate.Plus" ng-value="rate.Plus"></input>
                </div>
            </div>
            <div class="col-xs-12 col-md-1">
              <label for="Start Date">Rate</label>
                <div class="input-group">
                  <input type="text" class="rate_form" name="rate" ng-model="rate.Rate" ng-value="rate.Rate" ></input>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-2">
                <div class="form-group button-margin-top">
                  <button type="submit" ng-click="saveRates(rate)" class="btn btn-default btn-sm"><i class="fa fa-save"></i></button>
                  <button type="submit" ng-click="deleteRates(rate)"  class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                </div>
            </div>
          </div>
          </form>
        </div>
        <div class="box-footer">
  <!--         <button type="submit" class="btn btn-primary">Submit</button>
   -->      </div>
      </div>
    </div>
@stop
        