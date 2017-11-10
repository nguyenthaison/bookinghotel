<?php /**/ $title = $villa[0]->title. ' | '.$area[0]->title. ' villa rentals'; /**/ ?>
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<!-- villa-detail -->
			<div class="villa-detail col-sm-12" ng-app="frontend">
				

				<!-- QUICK CONTACT -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
				<div class="modal-content">

				<div class="modal-header">QUICK CONTACT</div>
				<div class="modal-body">
					<div class="col-xs-12">
					<form class="form-horizontal" action="<?php echo e(url('detail/order')); ?>" method="post">
						<?php echo Form::token(); ?>
						<input type="hidden" name="villa-id" value="<?php echo e($villa[0]->id); ?>"/>
						<div id="form-contact-wrapper">
								<div class="form-group">
									<div class="row">
										<label style="width:80px;">Checkin: </label>
										<a href="#" class="btn small dp4" id="dp4" data-date-format="yyyy-mm-dd" data-date="2017-02-01"><i class="fa fa-calendar"></i></a>
										<input name="check-in" id="startDate" value="2017-02-01"/>
									</div>
									<div class="row">
										<label style="width:80px;">Checkout: </label>
										<a href="#" class="btn small dp5" id="dp5" data-date-format="yyyy-mm-dd" data-date="2017-02-10"><i class="fa fa-calendar"></i></a>
										<input name="check-out" id="endDate" value="2017-02-10"/>
									</div>
								</div>
								<div class="form-group number-guest">
									<label>Number Of Guest </label>
									<div class="row">
										<input type="number" min="1" class="form-control col-sm-6" name="num-guest" placeholder="Adult">
										<input type="number" min="1" class="form-control col-sm-6" name="num-child" placeholder="Child">
									</div>
								</div>
							
								<div class="form-group">
									<input class="form-control" name="user-name" placeholder="Name">
								</div>
								<div class="form-group">
									<input type="email" class="form-control" name="user-email" id="exampleInputEmail1" placeholder="Email">
								</div>
								<div class="form-group">
									<input class="form-control" name="user-phone" placeholder="Phone">
								</div>
								
								<button type="submit" class="btn btn-default btn-submit" style="margin:0px 10%; width:80%;">Order Now</button>
						</div>	
					</form>
					</div>
					<div class="clearfix"></div>
				</div>

				</div>
				</div>
				</div>

				<div id="quick-contact" class="col-sm-3 contact-box hidden-sm hidden-xs">
				<form class="form-horizontal" action="<?php echo e(url('detail/order')); ?>" method="post">
            		<?php echo Form::token(); ?>
					<input type="hidden" name="villa-id" value="<?php echo e($villa[0]->id); ?>"/>
					<h1><a href="#quick-contact">QUICK CONTACT <span class="css-arrow-down"></span></a></h1>
					<div class="arrow-down"><img src="<?php echo e(URL::asset('assets/images/icon-arrow-down.png')); ?>"></div>
					<div id="form-contact-wrapper">
							<div class="form-group">
								<div class="row">
									<label style="width:80px;">Checkin: </label>
									<a href="#" class="btn small dp4" id="dp4" data-date-format="yyyy-mm-dd" data-date="2017-02-01"><i class="fa fa-calendar"></i></a>
									<input name="check-in" id="startDate" value="2017-02-01"/>
								</div>
								<div class="row">
									<label style="width:80px;">Checkout: </label>
									<a href="#" class="btn small dp5" id="dp5" data-date-format="yyyy-mm-dd" data-date="2017-02-10"><i class="fa fa-calendar"></i></a>
									<input name="check-out" id="endDate" value="2017-02-10"/>
								</div>
							</div>
							<div class="form-group number-guest">
								<label>Number Of Guest </label>
								<div class="row">
								    <input type="number" min="1" class="form-control col-sm-6" name="num-guest" placeholder="Adult">
								  	<input type="number" min="1" class="form-control col-sm-6" name="num-child" placeholder="Child">
								</div>
							</div>
						
							<div class="form-group">
								<input class="form-control" name="user-name" placeholder="Name">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="user-email" id="exampleInputEmail1" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="form-control" name="user-phone" placeholder="Phone">
							</div>
							
							<div class="form-group verification-code captcha-container" style="margin:0 auto !important;">
								<div class="g-recaptcha" data-sitekey="<?php echo e(env('RE_CAP_SITE')); ?>" data-callback="capenable" data-expired-callback="capdisable"></div>
							</div>
							<button type="submit" class="btn btn-default btn-submit" style="margin:0px 10%; width:80%;">Order Now</button>
					</div>	
				</form>
				</div>
				<!-- /QUICK CONTACT -->
				
				<!-- DETAIL VILLA -->
				<div id="detail-villa" class="col-sm-9" ng-controller="homeController">
					<h1> <?php echo e(strtoupper($villa[0]->title)); ?> </h1>
					<?php if(isset($villa[0]->intro)): ?>
						<?php echo $villa[0]->intro; ?> <a href="#">More Detail</a>
					<?php else: ?>
						<?php echo str_limit($villa[0]->description, 300); ?> <a href="#">More Detail</a>
					<?php endif; ?>

					<!-- Tabs -->
					<div id="villa-tabs">     
					    <div id="villa-tabs-nav" class="btn-group text-center" role="group" aria-label="...">
							<a href="#location" class="btn btn-default" role="button">Location</a>
							<a href="#gallery" class="btn btn-default active" role="button">Gallery</a>
							<a href="#rates" class="btn btn-default" role="button">Rates</a>
							<a href="#services" class="btn btn-default" role="button">Services & Facilities</a>
							<a href="#staff" class="btn btn-default" role="button">Staff Detail</a>
							<a href="#reviews" class="btn btn-default" role="button">Reviews</a>
						</div>

				        <div class="resp-tabs-container hor_1">
				        	
				        	<!-- location -->
				            <div id="location" class="section">
				            	<h2>Location</h2>
				            	<div id="villa-map" style="width: 100%; height: 300px"></div>
				            </div>

				        	<!-- gallery -->
				            <div>
				            	<div id="gallery" class="section" ng-init="getGalleryByVilla(<?= $villa[0]->id ?>)">
									<h2> Gallery </h2>
										<div class="gallery-image">
										   <span ng-repeat="gallery in galleryByVilla">
											<a href="{{ gallery.url }}" data-lightbox="{{ gallery.name }}" data-title="{{ gallery.caption }}"><img src="<?php echo e(URL::asset('assets/images/lazy-image-detail.png')); ?>" lazy-img="{{ gallery.thumbUrl }}" /></a>
										   </span>
										</div>
								</div>
				            </div>

				            
				            <!-- rates -->
				            <div id="rates" class="section">
				            	<h2>Rates</h2>
				            	<div class="rates-detail">
					            	<?php if(isset($rates)): ?>
					            	<div class="table-responsive">
										<?php foreach($rates as $key => $value): ?>
										<table class="table">
											<thead>
												<th width="50%"></th>
												<th>Minimum Stay</th>
												<th><?php echo e($key); ?></th>
											</thead>
											<?php foreach($value as $rate): ?>
											<tr> 
												<td width="50%"> <?php echo e($rate->season); ?></td>
												<td><?php echo e(isset($rate->min_stay) ? $rate->min_stay . ' Nights' : ''); ?></td>
												<td>USD <?php echo e($rate->rate); ?> <?php echo e($rate->plus === 1 ? '++' : ''); ?> <?php echo e(isset($rate->tax) ? 'Tax: '.str_replace('.00', '%', $rate->tax) : ''); ?></td>
											</tr>
											<?php endforeach; ?>
										</table>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
				            	</div>
				            </div>

				            <!-- services & facilites -->
							<div id="services" class="section">
								<h2>Services &amp; Facilities</h2>
								<div class="services-detail">
					            	<?php if(!empty($villa[0]->services) || !empty($villa[0]->facilities)): ?>
									 <?php echo $villa[0]->services; ?>

									 <?php echo $villa[0]->facilities; ?>

									 <?php endif; ?>
				            	</div>
							</div>

							<div id="staff" class="section">
								<h2>Staff Detail</h2>
								<div class="services-detail">
									<?php if(!empty($villa[0]->staff_detail)): ?>
									 <?php echo $villa[0]->staff_detail; ?>

									 <?php endif; ?>
								</div>
							</div>

				            <!-- reviews -->
				            <div id="reviews" class="section" ng-init="getReviewByVilla(<?= $villa[0]->id ?>)">
								<h2>Reviews</h2>
								<div class="reviews-detail" ng-hide="reviewStatus">
					            	<div class="panel panel-default" ng-repeat="review in reviewByVilla">
										<div class="panel-heading">{{ review.guestName }}, from {{ review.guestCountry }}</div>
										<div class="panel-body">
											{{ review.guestComment | stripTags }}
										</div>
					            	</div>
				            	</div>
				            	<div class="reviews-detail" ng-show="reviewStatus">
				            		<p class="text-center">No reviews available</p>
				            	</div>
				        	</div>

				        </div>
				    </div>
				    <!-- /Tabs -->
					 
				</div>
				<!-- /DETAIL VILLA -->
				
			</div>
			<!-- /villa-detail -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mapjs'); ?>
<script src="<?php echo e(URL::asset('assets/js/jquery.throttle.js')); ?>"></script>
<script type="text/javascript">
	
	var scaleCaptcha = function(elementWidth) {
	// Width of the reCAPTCHA element, in pixels
		var reCaptchaWidth = 304;
		// Get the containing element's width
			var containerWidth = $('.captcha-container').width();
		
		// Only scale the reCAPTCHA if it won't fit
		// inside the container
		if(reCaptchaWidth > containerWidth) {
			// Calculate the scale
			var captchaScale = containerWidth / reCaptchaWidth;
			// Apply the transformation
			$('.g-recaptcha').css({
			'transform':'scale('+captchaScale+')'
			});
		}
	};

	function capenable() {
    	$('.btn-submit').prop('disabled', false);
	}
	function capdisable() {
		$('.btn-submit').prop('disabled', true);
	}
	
	var fixmeTop = $('.contact-box').offset().top;       // get initial position of the element

	$(window).scroll(function() {                  // assign scroll event listener
		var currentScroll = $(window).scrollTop(); // get current position

		if (currentScroll >= fixmeTop) {           // apply position: fixed if you
			$('.contact-box').css({                      // scroll to that element or below it
				position: 'fixed',
				top: '50px',
				left: '15px'
			});
		}
		 else {                                   // apply position: static
			$('.contact-box').css({                      // if you scroll above it
				position: 'fixed',
				top: $("#header-villa").height()+50-currentScroll,
				left: '15px'
			});
		}
		$("#detail-villa").addClass('col-sm-offset-3');
	});
    var locations = [
      ['<?php echo e($villa[0]->title); ?>', <?php echo e($villa[0]->latitude); ?>, <?php echo e($villa[0]->longitude); ?>],
    ];

    var map = new google.maps.Map(document.getElementById('villa-map'), {
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
  <script>
  $(function(){
	  $('#body').removeClass('container');

		//capdisable();
		scaleCaptcha();
		 $(window).resize( $.throttle( 100, scaleCaptcha ) );
		$('.dp4').datepicker()
			.on('changeDate', function(ev){
				if (ev.date.valueOf() > endDate.valueOf()){
					$('#alert').show().find('strong').text('The start date can not be greater then the end date');
				} else {
					$('#alert').hide();
					startDate = new Date(ev.date);
					$('#startDate').val($('#dp4').data('date'));
				}
				$('#dp4').datepicker('hide');
			});
		$('.dp5').datepicker()
			.on('changeDate', function(ev){
				if (ev.date.valueOf() < startDate.valueOf()){
					$('#alert').show().find('strong').text('The end date can not be less then the start date');
				} else {
					$('#alert').hide();
					endDate = new Date(ev.date);
					$('#endDate').val($('#dp5').data('date'));
				}
				$('#dp5').datepicker('hide');
			});
	});
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partial.layout-detail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>