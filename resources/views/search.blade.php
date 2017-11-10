<?php

use App\Area;
use App\Bedroom;
?>
@extends('partial.layout-contact')
@section('title', 'Search')
@section('content')
<div class="container">
    <div id="villa-search" class="clearfix">
            {!! Form::open(['action'=>'SearchController@Index', 'method'=>'get', 'id'=>'form-search']) !!}
            <?php echo Form::token(); ?>
                <div class="form-group col-sm-3 col-xs-12">
                    <input type="text" class="form-control" name="villa-name" id="exampleInputName2" placeholder="Villa Name" value="{{ $vname }}">
                </div>
                <input type="hidden" name="sort-type" id="sort-type" value="{{ $sort_type }}"/>
                <div class="col-sm-3 col-xs-6">
                {{ Form::select('bedroom-id', Bedroom::lists('title','id')->prepend('Bedroom'), $bedroom_id, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-3 col-xs-6">
                {{ Form::select('area-id', Area::lists('title','id')->prepend('Area'), $area_id, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-1 col-xs-6">
                    <button type="submit" class="btn btn-default">Search</button>
                </div>
                <div class="btn-group group-sort col-md-2 col-xs-6" role="group" aria-label="...">
                    <button type="button" class="btn btn-default sort-no"><i class="fa fa-close"></i></button>
                    <button type="button" class="btn btn-default sort-asc"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-default sort-desc"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i></button>
                </div>
            {!! Form::close() !!}
        </div>
        <!-- /VILLA-SEARCH -->
    <div ng-app="frontend">
    <div class="row">
       <hr/>
        <!-- villa-item -->
        @foreach( $villas as $villa)
        <div class="villa-item col-sm-12 col-md-4">
            <?php 
                if ($villa->gallery->isEmpty()) {
                    $image_url = 'assets/images/lazy-image.png';
                } else {
                    
                    foreach ($villa->gallery as $gallery) {
                        $image_url = '/thumb/'. $gallery->original_name .'/350/home';
                    }
                }
            ?>
            <div class="img-villa"><a href="{{ url($villa->area->slug.'/'.$villa->slug.'.html') }}"><img src="{{ URL::asset('assets/images/lazy-image.png') }}" lazy-img="{{ url($image_url) }}" ></a></div>
            <div class="rate">
                <span> From </span>
                <div class="price"> 
                    {{ '$ '.(int)($villa->min_rate()) }}
                <span>/night</span></div>
            </div>
            <div class="about-villa">
                <div class="villa-name"><h2>{{ $villa->title }}</h2></div>
                <div class="short-description">{{ str_limit(strip_tags($villa->intro), 125) }}
                </div>
                <div class="features row"> 
                    <div class="features-1 col-sm-6">
                        <span> <i class="fa fa-bed" aria-hidden="true"></i> {{ $villa->bedrooms_no > 1 ? $villa->bedrooms_no . ' Bedrooms' : $villa->bedrooms_no . ' Bedroom'}}</span> 
                        <span> <i class="fa fa-users" aria-hidden="true"></i> {{ $villa->occupied_max > 1 ? $villa->occupied_max . ' Peoples' : $villa->occupied_max . ' People'}} </span>
                    </div>
                    <div class="features-2 col-sm-6">
                        <span> <i class="fa fa-check-circle" aria-hidden="true"></i> {{ $villa->environment->title }} </span>
                        <span> <i class="fa fa-star" aria-hidden="true"></i> {{ count($villa->review) > 1 ? count($villa->review) . ' Reviews' : count($villa->review) . ' Review'}} </span>
                    </div>
                </div>
            </div>
            <a class="btn btn-default" href="{{ url($villa->area->slug.'/'.$villa->slug.'.html') }}" style="background-color:#e0e0e0!important;">VIEW DETAIL</a>
        </div>
        @endforeach
        
        </div>
    </div>
</div>
</div>
@endsection
@section("scripts")
    <script>
        $(function(){
            var sort_type = $('#sort-type').val();
            if (sort_type == "NO")
                $('.sort-no').addClass('active');
            if (sort_type == "ASC")
                $('.sort-asc').addClass('active');
            if (sort_type == "DESC")
                $('.sort-desc').addClass('active');
        });
        $('.group-sort .sort-no').click(function(){
            $('#sort-type').val('NO');
            $('#form-search').submit();
        });
        $('.group-sort .sort-asc').click(function(){
            $('#sort-type').val('ASC');
            $('#form-search').submit();
        });
        $('.group-sort .sort-desc').click(function(){
            $('#sort-type').val('DESC');
            $('#form-search').submit();
        });
    </script>
	<script src="{{ asset("/assets/js/vendor-frontend.js")}}"></script>
	<script src="{{ asset("/assets/js/frontend/app.js")}}"></script> 
@endsection