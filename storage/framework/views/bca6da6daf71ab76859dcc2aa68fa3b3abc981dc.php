<!-- CONTAINER-FLUID -->
<div ng-app="frontend">
		<div class="container-fluid" ng-controller="homeController">
			
			<!-- HEADER -->
			<div id="header">
				<!-- TOP-BAR -->
				<?php echo $__env->make('partial.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<!-- /TOP-BAR -->
				<!-- IMG-HEADER -->
				<div id="header-villa">
						<img src="<?php echo e(URL::asset('assets/images/lazy-image-large.png')); ?>" alt="<?php echo e(isset($villa) ? $villa[0]->title : ''); ?>" lazy-img="<?php echo e(!empty($ImageDetail) ?
						url('/thumb-detail/'.$ImageDetail[0]->original_name.'/1280') : ''); ?>">

				</div>
				<!-- /IMG-HEADER -->
				
				
			</div>
			<!-- /HEADER -->
		
		</div>
		<!-- /CONTAINER-FLUID -->