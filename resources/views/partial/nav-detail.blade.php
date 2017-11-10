<!-- CONTAINER-FLUID -->
<div ng-app="frontend">
		<div class="container-fluid" ng-controller="homeController">
			
			<!-- HEADER -->
			<div id="header">
				<!-- TOP-BAR -->
				@include('partial.menu')
				<!-- /TOP-BAR -->
				<!-- IMG-HEADER -->
				<div id="header-villa">
						<img src="{{ URL::asset('assets/images/lazy-image-large.png') }}" alt="{{ isset($villa) ? $villa[0]->title : '' }}" lazy-img="{{ 
						!empty($ImageDetail) ?
						url('/thumb-detail/'.$ImageDetail[0]->original_name.'/1280') : '' }}">

				</div>
				<!-- /IMG-HEADER -->
				
				
			</div>
			<!-- /HEADER -->
		
		</div>
		<!-- /CONTAINER-FLUID -->