<!-- Header -->
@include('partial/header')

  <body>
  @include('partial/nav-category')

  	<!-- BODY -->
		<div id="body" class="container">
			@yield('content')
		</div>
	<!-- /BODY -->
	<!-- CONTAINER-FLUID -->
	@include('partial/footer')
	<!-- CONTAINER-FLUID -->
	@yield('mapjs')

	<script src="{{ asset("/assets/js/vendor-frontend.js")}}"></script>
	<script src="{{ asset("/assets/js/frontend/app.js")}}"></script> 
  </body>
</html>