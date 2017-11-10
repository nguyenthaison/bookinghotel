<!-- Header -->
<?php echo $__env->make('partial.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <body style="padding-top:70px;padding-bottom:30px;">
  <?php echo $__env->make('partial/nav-contact', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  	<!-- BODY -->
		<div id="body" class="container">
			<?php echo $__env->yieldContent('content'); ?>
		</div>
	<!-- /BODY -->
	<?php echo $__env->make('partial/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->yieldContent("scripts"); ?>
  </body>
</html>