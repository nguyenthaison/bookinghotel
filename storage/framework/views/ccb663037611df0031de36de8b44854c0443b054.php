<?php $__env->startSection('title', 'Contact Us'); ?>

<?php $__env->startSection('head-scripts'); ?>
	<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-9 col-sm-8">
        <div class="contact-bali-symbol">
            <i class="fa fa-bank"></i>
        </div>

        <div class="help row">
            <div class="col-sm-12">
                <h2>About Us</h2>
                <p>
                    In July 2015 UKIN Business Consulting based in Jakarta, Indonesia, with a branch office in Denpasar, Bali, acquired and now manages Bali Home Paradise, which has been established in 2008. UKIN Consulting specializes in tourism related services with a focus on business analysis, hospitality management and training. 
                    UKIN is committed to provide the guest and clients of Bali Home Paradise comprehensive and international-level hospitality service along the complete journey. We are highly dedicated to make every holiday a unique and lasting experience. Our commitment goes beyond your vacation at one of our villas. We will gladly welcome back and strive to make your stay even more pleasant and memorable. We also offer a reward program for loyal customers.
                </p><br/><br/><br/><br/>
                <h2>Bali Home Paradise</h2>
                <p> Managed By.
                    PT. Unik Kreatif Inovatif (UKIN) 
                    World Trade Centre 5 Level 3A
                    Jl. Jendral Sudirman Kav. 29 - 31
                    Jakarta 12920
                    Indonesia<br/>
                    <strong>Telp. +62 21 2598 5188</strong>
                    <br/>
                    <strong>Fax. +62 21 2598 5001</strong>
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-4">
        <div id="villa-map" style="width: 100%; height: 300px"></div>
        <br/>
        <img src
        <p class="text-center">Managed By: <br/>
            PT. Unik Kreatif Inovatif</p>
        <p class="text-center">Jl. Tukad Citarum O No. 17 <br/>
            Denpasar 80226 <br/>
            Bali</p>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<script type="text/javascript">
    var locations = [
      ['PT. Unik Kreatif Inovatif', -6.2116791, 106.8209164],
    ];

    var map = new google.maps.Map(document.getElementById('villa-map'), {
      zoom: 14,
      center: new google.maps.LatLng(-6.2116791, 106.8209164),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(-6.2116791,106.8209164),
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
	<script src="<?php echo e(asset("/assets/js/vendor-frontend.js")); ?>"></script>
	<script src="<?php echo e(asset("/assets/js/frontend/app.js")); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partial.layout-contact', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>