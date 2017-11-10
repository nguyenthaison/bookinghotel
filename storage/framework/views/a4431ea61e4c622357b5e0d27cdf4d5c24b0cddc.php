<!-- CONTAINER-FLUID -->
		<div class="container-fluid">
			
			<!-- HEADER -->
			<div id="header">
				<!-- TOP-BAR -->
				<div id="top-bar" class="row">
					<div class="navigation col-sm-9">
						<a href="##" class="toggle-nav"></a>
						<?php echo $__env->make('partial.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
				</div>
				<!-- /TOP-BAR -->
				<!-- IMG-HEADER -->
				<div id="map" style="width: 100%; height: 400px;">
				</div>
				<!-- /IMG-HEADER -->
				
				<!-- SEARCH-RESULT -->
				<div id="search-result"> 
					Category: <span><?php echo e($area[0]->title); ?> Villas</span>
				</div>
				<!-- /SEARCH-RESULT -->

			</div>
			<!-- /HEADER -->
		
		</div>
		<!-- /CONTAINER-FLUID -->