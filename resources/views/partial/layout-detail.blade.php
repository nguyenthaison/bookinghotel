<!-- Header -->
@include('partial/header-detail')

  <body>
		<div style="position:fixed; top:50px; left:0; width:100%; z-index:999;" class="hidden-md hidden-lg">
				<button type="button" class="btn btn-primary btn-lg col-xs-12" data-toggle="modal" data-target="#myModal">
					QUICK CONTACT
				</button>
		</div>
		<div style="height:85px;" class="hidden-md hidden-lg"></div>
  @include('partial/nav-detail')

  	<!-- BODY -->
		<div id="body" class="container">
			@yield('content')
		</div>
	</div>
	<!-- /BODY -->
	<!-- CONTAINER-FLUID -->
		@include('partial/footer')
		@yield('mapjs')
	<!-- CONTAINER-FLUID -->
	<script src="{{ asset("/assets/js/vendor-frontend.js")}}"></script>
	<script src="{{ asset("/assets/js/frontend/app.js")}}"></script> 
  </body>
</html>