<?php /**/ $title = $area[0]->title. ' Villa Rentals by Bali Home Paradise'; /**/ ?>
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<div class="villa-category row" ng-app="frontend">
				
				<?php if(isset($specialOffers)): ?>
				<!-- SPECIAL OFFERS -->
				<div id="special-offers" class="col-sm-4 col-xs-12">
					<h1><a href="#special-offers">Special offers <span class="css-arrow-down"></span></a></h1>
					<div class="arrow-down"><img src="<?php echo e(url("assets/images/icon-arrow-down.png")); ?>"></div>
					<div id="special">
						
						<?php foreach($specialOffers as $offer): ?>
						<!-- villa-special -->
						<div class="villa-special col-sm-12 col-xs-6">
							<div class="img-villa"><img src="<?php echo e(URL::asset('assets/images/lazy-image.png')); ?>" lazy-img="<?php echo e(url('/thumb/'.$offer->original_name.'/350/temporary')); ?>" alt=""></div>
							<div class="villa-name"><h2><?php echo e($offer->villa_title); ?></h2></div>
							<div class="about-villa">
								<div class="row">
									<div class="col-sm-12">
										<?php echo e($offer->title); ?>

									</div>
									<div class="features col-sm-12">
										<span> <i class="fa fa-bed" aria-hidden="true"></i> <?php echo e($offer->bedrooms_no > 1 ? $offer->bedrooms_no . ' Bedrooms' : $offer->bedrooms_no . ' Bedroom'); ?> </span> 
										<span> <i class="fa fa-users" aria-hidden="true"></i> <?php echo e($offer->occupied_max > 1 ? $offer->occupied_max . ' Peoples' : $offer->occupied_max . ' People'); ?> Max </span>
										<span> <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo e($offer->environment_title); ?> </span>
									</div>
									<div class="col-sm-12">
										<a class="btn btn-default" href="<?php echo e(url($offer->area_slug.'/'.$offer->slug.'.html')); ?>" role="button">VIEW DETAIL</a>
									</div>
								</div>
								
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php else: ?>
					<div id="special-offers" class="col-sm-4 col-xs-12">
						<h1>No Special Offer available yet</h1>
					</div>
				<?php endif; ?>
				<!-- /SPECIAL OFFERS -->

				
				<!-- CATEGORY -->
				<div id="detail-category" class="col-sm-8 col-xs-12" ng-controller="homeController">
					<h1> <?php echo e($area[0]->title); ?> </h1>
					
					<?php if(!empty($area[0]->description)): ?>
						<p><?php echo e($area[0]->description); ?></p>
					<?php endif; ?>
					
					<!-- villa-category -->
					<div class="villa-category row" ng-init="getVillas(<?php echo e($area[0]->id); ?>)">
						
						<!-- villa-item -->
						<div infinite-scroll="getMoreData()">
							<div class="villa-item col-sm-6" ng-repeat="villa in data">
								<div class="img-villa"><img src="<?php echo e(URL::asset('assets/images/lazy-image.png')); ?>" lazy-img="{{ villa.thumbnail }}" alt=""></div>
								<div class="rate">
									<span> From </span>
									<div class="price"> $ {{ villa.rate }} <span>/night</span></div>
								</div>
								<div class="about-villa">
									<div class="villa-name"><h2>{{ villa.title }}</h2></div>
									<div class="short-description">{{ villa.desc | limitTo: 100 | stripTags}} 
									</div>
									<div class="features row"> 
										<div class="features-1 col-sm-6">
											<span> <i class="fa fa-bed" aria-hidden="true"></i> {{ villa.bedroom }} Bedroom </span> 
											<span> <i class="fa fa-users" aria-hidden="true"></i> {{ villa.occupied }} Max </span>
										</div>
										<div class="features-2 col-sm-6">
											<span> <i class="fa fa-check-circle" aria-hidden="true"></i> {{ villa.environment }} </span>
											<span> <i class="fa fa-star" aria-hidden="true"></i> {{ villa.review }} Review </span>
										</div>
									</div>
								</div>
								<a class="btn btn-default" href="{{ villa.url }}" role="button">VIEW DETAIL</a>
							</div>
						</div>
						<!-- villa-item -->
						 		
					</div>
					<!-- /villa-category -->
					
				</div>
				<!-- /DETAIL CATEGORY -->
				
			</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mapjs'); ?>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-2Jq3Bkc9efp29JRYktVjDstk5VBpkGU&libraries=places"></script>
	<script type="text/javascript">
    var locations = [
      <?php foreach($villas as $villa): ?>
      ['<?php echo e($villa->title); ?>', <?php echo e($villa->latitude); ?>, <?php echo e($villa->longitude); ?>],
      <?php endforeach; ?>
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: new google.maps.LatLng(<?php echo e($area[0]->latitude); ?>, <?php echo e($area[0]->longitude); ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partial.layout-category', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>