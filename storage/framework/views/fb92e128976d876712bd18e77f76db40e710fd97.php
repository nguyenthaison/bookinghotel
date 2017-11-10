<!-- Header -->
<?php echo $__env->make('partial/header-detail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <body>
		<div style="position:fixed; top:50px; left:0; width:100%; z-index:999;" class="hidden-md hidden-lg">
				<button type="button" class="btn btn-primary btn-lg col-xs-12" data-toggle="modal" data-target="#myModal">
					QUICK CONTACT
				</button>
		</div>
		<div style="height:85px;" class="hidden-md hidden-lg"></div>
  <?php echo $__env->make('partial/nav-detail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  	<!-- BODY -->
		<div id="body" class="container">
			<?php echo $__env->yieldContent('content'); ?>
		</div>
	</div>
	<!-- /BODY -->
	<!-- CONTAINER-FLUID -->
		<?php echo $__env->make('partial/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->yieldContent('mapjs'); ?>
	<!-- CONTAINER-FLUID -->
	<script src="<?php echo e(asset("/assets/js/vendor-frontend.js")); ?>"></script>
	<script src="<?php echo e(asset("/assets/js/frontend/app.js")); ?>"></script> 
  </body>
</html>