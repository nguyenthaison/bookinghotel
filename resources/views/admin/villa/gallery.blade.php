@extends('admin.partial.layout')
@section('title', 'Gallery')
@section('heading_breadcrumb')
  <h1>Gallery Configuration</h1>
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

      <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Gallery: Add images </h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12 col-md-12">
                <button ng-click="addImages(<?= $id ?>, count = count + 1)" ng-init="count = 0" class="btn btn-info">Add Images</button>
            </div>
          </div>
        
        <!-- /.box-body -->
        <form name="gallery_container">
        <div class="box-body" ng-init="getGalleryGroups()">
          <div class="row" ng-hide="ifImages" ng-repeat="gallery in itemGallery">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="key">Caption *</label>
                      <input type="text" class="form-control" ng-model="gallery.Caption">
                  </div>
                </div>
                <div class="col-xs-12 col-md-2">
                  <div class="form-group">
                    <label for="key">Group *</label>
                    <select class="form-control" name="area" ng-model="gallery.Group" ng-required="true">
                          <option ng-repeat="groupList in galleryGroupList | orderBy: 'title'" ng-value="groupList.id" value="groupList.id">@{{groupList.title}}</option>
                </select>
                  </div>
                </div>
                <div class="col-xs-12 col-md-2">
                    <label for="key">Main Image</label>
                    <div class="input-group">
                      <input type="checkbox" name="mainImage" ng-model="gallery.MainImage"></input>
                    </div>
                </div> 
                <div class="col-xs-12 col-md-4" ng-init="">
                  <div class="form-group">
                    <label for="key">Choose File</label>
                      <input type="file" ngf-select ng-model="gallery.Images" name="file"    
                         accept="image/*" ngf-max-size="3MB" required
                         ngf-model-invalid="errorFile">
                      <i ng-show="gallery_container.file.$error.required">*required</i><br>
                      <i ng-show="gallery_container.file.$error.maxSize">File too large 
                       @{{errorFile.size / 1000000|number:1}}MB: max 2M</i>
                  </div>
                </div>
                <input type="hidden" ng-model="gallery.VillaId">
                <input type="hidden" ng-model="gallery.VillaName">
              </div>
          </div>
        </div>
        
        <div class="box-footer">
           <button type="submit" ng-disabled="!gallery_container.$valid" ng-click="doUpload(itemGallery)" class="btn btn-primary" ng-hide="ifImages">Upload</button>
           
        </div>
        </form>
        <div class="box-body" ng-init="listGallery(<?= $id ?>)">
          <div class="col-xs-12 col-md-3 gallery_wrap" ng-repeat="list in galleryList">
              <div class="img_container">
               <img src="{{ URL::asset('assets/images/flickr.svg') }}" lazy-img="@{{ list.Image }}" class="img-rounded" />
              </div>
              <div class="form-group">
                  <label for="caption">Caption</label>
                  <input type="text" class="form-control" ng-model="list.Caption">
                  <input type="hidden" ng-model="list.Id">
              </div>
              <div class="form-group">
                  <label for="group">Group *</label>
                  <select class="form-control" name="area" ng-model="list.Group" ng-required="true">
                          <option ng-repeat="groupList in galleryGroupList | orderBy: 'title'" ng-value="groupList.id" value="groupList.id" ng-selected="list.Group == groupList.id">@{{groupList.title}}</option>
                  </select>
              </div>
              <div class="checkbox">
                <label>
                <input type="checkbox" name="mainImage" ng-model="list.MainImage" ng-checked="list.MainImage"> Main file
                </label>
              </div>
              <div class="form-group">
                  <button type="submit" ng-click="editGallery(list)" class="btn btn-default btn-sm">Edit</button>
                  <button type="submit" ng-click="galleryModal(list)" class="btn btn-default btn-sm">Delete</button>
              </div>
          </div>
        </div>
        
      </div>
    </div>
@stop
        