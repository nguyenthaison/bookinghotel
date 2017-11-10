<!-- Header -->
@include('partial/header')

  <body>
  @include('partial/nav')

  	<!-- BODY -->
		<div id="body">
			@yield('content')
		</div>
	<!-- /BODY -->
	<!-- CONTAINER-FLUID -->
		@include('partial/footer')
	<!-- CONTAINER-FLUID -->
	<script src="{{ asset("/assets/js/vendor-frontend.js")}}"></script>
	<script src="{{ asset("/assets/js/frontend/app.js")}}"></script> 
  </body>
</html>