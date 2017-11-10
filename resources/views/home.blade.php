@extends('partial.layout')
@section('title', 'Bali Home Paradise')
@section('content')
<!-- WELCOME -->
<div ng-app="frontend">
            <div id="welcome" class="container-fluid">
                <div class="description"> 
                    <h1> Bali Home Paradise - Luxury Villas For Rent </h1>
                    Bali Home Paradise has been here helping many discerning guests to find their perfect Bali villas for almost a decade. While assisting, we also keep updating villa listings to give you, our valued customer, better options to choose. Today, we have been compiling a select amount of luxury and private villas for rent in many destinations in Bali. With a simple click you can select one of the best villas in Seminyak, Ubud, Canggu, and other popular destinations.
                </div>
            </div>
            <!-- /WELCOME -->
            <!-- FEATURED-VILLAS -->
            <div id="featured-villas" ng-controller="homeController">
                <div class="container">
                    <div class="row">
                        <h1> Featured Villas </h1>
                        <!-- villa-item -->
                        @foreach( $featuredVillas as $featuredVilla)
                        <div class="villa-item col-sm-4">
                            <?php 
                                if ($featuredVilla->gallery->isEmpty()) {
                                    $image_url = 'assets/images/lazy-image.png';
                                } else {
                                    
                                    foreach ($featuredVilla->gallery as $gallery) {
                                        $image_url = '/thumb/'. $gallery->original_name .'/350/home';
                                    }
                                }
                            ?>
                            <div class="img-villa"><a href="{{ url($featuredVilla->area->slug.'/'.$featuredVilla->slug.'.html') }}"><img src="{{ URL::asset('assets/images/lazy-image.png') }}" lazy-img="{{ url($image_url) }}" alt=""></a></div>
                            <div class="rate">
                                <span> From </span>
                                <div class="price"> 
                                    {{ '$ '.(int)($featuredVilla->min_rate()) }}
                                <span>/night</span></div>
                            </div>
                            <div class="about-villa">
                                <div class="villa-name"><h2>{{ $featuredVilla->title }}</h2></div>
                                <div class="short-description">{{ str_limit(strip_tags($featuredVilla->intro), 125) }}
                                </div>
                                <div class="features row"> 
                                    <div class="features-1 col-sm-6">
                                        <span> <i class="fa fa-bed" aria-hidden="true"></i> {{ $featuredVilla->bedrooms_no > 1 ? $featuredVilla->bedrooms_no . ' Bedrooms' : $featuredVilla->bedrooms_no . ' Bedroom'}}</span> 
                                        <span> <i class="fa fa-users" aria-hidden="true"></i> {{ $featuredVilla->occupied_max > 1 ? $featuredVilla->occupied_max . ' Peoples' : $featuredVilla->occupied_max . ' People'}} </span>
                                    </div>
                                    <div class="features-2 col-sm-6">
                                        <span> <i class="fa fa-check-circle" aria-hidden="true"></i> {{ $featuredVilla->environment->title }} </span>
                                        <span> <i class="fa fa-star" aria-hidden="true"></i> {{ count($featuredVilla->review) > 1 ? count($featuredVilla->review) . ' Reviews' : count($featuredVilla->review) . ' Review'}} </span>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-default" href="{{ url($featuredVilla->area->slug.'/'.$featuredVilla->slug.'.html') }}" style="background-color:#e0e0e0!important;">VIEW DETAIL</a>
                        </div>
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
            <!-- /FEATURED-VILLAS -->
            <!-- TESTIMONIAL -->
            <div id="testimonial-guest">
                <div class="container">
                    <h1> Guest Testimonial </h1>
                    <div class="testimonial row">
                        @foreach ($testimonials as $testimonial)
                        <div class="guest-testi col-sm-4">
                            <h2> {{ $testimonial->guest_name }} </h2>
                            <span> {{ !empty($testimonial->city) ? $testimonial->city .' - ' : '' }} {{ $testimonial->country->name }} </span>
                            <q>{{ str_limit(strip_tags($testimonial->comments), 122) }}</q>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <!-- /TESTIMONIAL -->
</div>
@endsection
