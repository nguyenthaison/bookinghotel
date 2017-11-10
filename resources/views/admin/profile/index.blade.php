@extends('admin.partial.layout')
@section('title', 'User Profile')
@section('heading_breadcrumb')
  <h1>User Profile</h1>
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
    <div class="row" ng-controller="profileController">


        <!-- Left Profile -->
        <div class="col-xs-12 col-md-3">
            <div class="box box-primary">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{ URL::asset('assets/images/blank_user.png') }}" lazy-img="@{{ profile.photo }}" alt="User profile picture">
                
                <div ng-hide="isUpload">
                  <h3 class="profile-username text-center">@{{ profile.first_name }}</h3>
                  <button class="btn btn-primary btn-block" ng-click="uploadPhoto(profile.photo, profile.id)"><b>Change Photo</b></button>
                </div>

                <div ng-show="isUpload">
                    <div class="row">
                      <div class="col-xs-12 col-md-12">

                        <div class="form-group">
                            <button class="btn btn-primary btn-block" ngf-select ngf-change="doUpload($files, profile.id)">click to upload</button>
                        </div>
                        <div class="form-group">
                              <button class="btn btn-danger btn-block" ng-click="cancelPhoto()"><b>Cancel</b></button>
                        </div>
                      </div>
                    </div>
                </div>

              </div>
              <!-- /.box-body -->

            </div>
        </div>
        <!-- /Left Profile -->
        
        <!-- Right Profile -->
        <div class="col-xs-12 col-md-9">
            <div class="box box-warning">
              
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                    <li><a href="#password" data-toggle="tab">Change Password</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="active tab-pane" id="profile" ng-init="getProfile(<?=Auth::user()->id?>)">
                        <!-- Alert -->
                        <uib-alert type="success" close ng-show="alertProfile">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4><i class="icon fa fa-check"></i> Success</h4>
                          @{{ alertMessage }}
                        </uib-alert>
                        <!-- /Alert -->
                        <form class="form-horizontal" name="profileForm">
                        
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">First Name</label>

                          <div class="col-sm-10">
                            <input type="text" ng-model="profile.first_name" class="form-control" id="inputFirstName" placeholder="First Name" ng-required="true">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                          <div class="col-sm-10">
                            <input type="text" ng-model="profile.last_name" class="form-control" id="inputLastName" placeholder="Last Name">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="inputExperience" class="col-sm-2 control-label">Date of Birth</label>

                          <div class="col-sm-10">
                            <p class="input-group">
                              <input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="profile.dob" is-open="datepicker.openedDOB" max-date="maxDate" datepicker-options="dateOptions" close-text="Close" name="dob" ng-required="true" />                            
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default" ng-click="openDOB($event)">
                                  <i class="glyphicon glyphicon-calendar"></i>
                                  </button>
                                </span>
                            </p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Country</label>

                          <div class="col-sm-10">
                            <select class="form-control" name="role" ng-model="profile.country_id" ng-required="true">
                              <option ng-repeat="country in countryList | orderBy: 'name'" ng-value="country.id" value="country.id" ng-selected="profile.country_id == country.id">@{{country.name}}</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">State</label>

                          <div class="col-sm-10">
                            <input type="text" ng-model="profile.state" class="form-control" id="inputState" placeholder="State">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">City</label>

                          <div class="col-sm-10">
                            <input type="text" ng-model="profile.city" class="form-control" id="inputCity" placeholder="City">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" ng-disabled="profileForm.$invalid" ng-click="updateProfile(profile, profile.id)" class="btn btn-danger">Update</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.profile -->
                    

                    <div class="tab-pane" id="password">
                      <!-- Alert -->
                        <uib-alert type="success" close ng-show="alertPassword">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4><i class="icon fa fa-check"></i> Success</h4>
                          @{{ alertMessage }}
                        </uib-alert>
                        <uib-alert type="danger" close ng-show="alertPasswordWrong">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4><i class="icon fa fa-check"></i> Failed</h4>
                          @{{ alertMessageWrong }}
                        </uib-alert>
                        <!-- /Alert -->
                      <form class="form-horizontal" name="changePassword">
                        <div class="form-group">
                          <label for="currPassword" class="col-sm-2 control-label">Current Password</label>

                          <div class="col-sm-10">
                            <input type="password" ng-model="password.current" ng-required="true" class="form-control" id="currPassword" placeholder="Enter your current password">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="newPassword1" class="col-sm-2 control-label">New Password</label>

                          <div class="col-sm-10">
                            <input type="password" ng-model="password.new1" ng-required="true" class="form-control" id="newPassword1" name="newPassword1" placeholder="Enter your new password">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="newPassword2" class="col-sm-2 control-label">Re-type new Password</label>

                          <div class="col-sm-10">
                            <input type="password" ng-model="password.new2" compare="password.new1" ng-required="true" class="form-control" id="newPassword2" name="newPassword2" placeholder="Re-type your new password">
                            <span ng-show="changePassword.newPassword2.$touched">
                                <span class="error" ng-show="changePassword.newPassword2.$error.compare">Re-enter correct password</span>
                            </span>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" ng-disabled="changePassword.$invalid" ng-click="updatePassword(password, <?=Auth::user()->id?>)" class="btn btn-danger">Update</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.password -->
                  </div>
                  <!-- /.tab-content -->
                </div>

              <!-- /.box-body -->
            </div>
        </div>
        <!-- /Right Profile -->

    </div>
    <!-- /Content -->

    
@stop
