<!-- CONTAINER-FLUID -->
<?php

use App\Area;
use App\Bedroom;
?>
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
				<div id="img-header">
					<img src="assets/images/img-header.jpg" alt="">
					<img src="assets/images/img-header-2.jpg" alt="">
					<img src="assets/images/img-header-3.jpg" alt="">
				</div>
				<!-- /IMG-HEADER -->
				
				<!-- VILLA-SEARCH -->
				<div id="villa-search" class="clearfix">
					<?php echo Form::open(['action'=>'SearchController@Index', 'method'=>'get']); ?>

					<?php echo Form::token(); ?>
						<div class="form-group col-md-3 col-xs-12 col-md-offset-1">
							<input type="text" class="form-control" name="villa-name" id="exampleInputName2" placeholder="Villa Name">
						</div>
						
						<div class="col-md-3 col-xs-5">
						<?php echo e(Form::select('bedroom-id', Bedroom::orderby('title')->lists('title','id')->prepend('Please select Bedroom'),null, ['class' => 'form-control'])); ?>

						</div>
						<div class="col-md-3 col-xs-5">
						<?php echo e(Form::select('area-id', Area::lists('title','id')->prepend('Please selct Area'), null, ['class' => 'form-control'])); ?>

						</div>
						<div class=" col-xs-2 col-md-1">
							<button type="submit" class="btn btn-default">Search</button>
						</div>
					<?php echo Form::close(); ?>

				</div>
				<!-- /VILLA-SEARCH -->
			</div>
			<!-- /HEADER -->
		
		</div>
		<!-- /CONTAINER-FLUID -->