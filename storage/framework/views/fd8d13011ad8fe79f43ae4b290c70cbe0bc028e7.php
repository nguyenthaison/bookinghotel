<!-- Header -->
<?php echo $__env->make('partial/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <body>
  <?php echo $__env->make('partial/nav-category', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  	<!-- BODY -->
		<div id="body" class="container">
			<?php echo $__env->yieldContent('content'); ?>
		</div>
	<!-- /BODY -->
	<!-- CONTAINER-FLUID -->
	<?php echo $__env->make('partial/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- CONTAINER-FLUID -->
	<?php echo $__env->yieldContent('mapjs'); ?>

	<script src="<?php echo e(asset("/assets/js/vendor-frontend.js")); ?>"></script>
	<script src="<?php echo e(asset("/assets/js/frontend/app.js")); ?>"></script> 
  </body>
</html>