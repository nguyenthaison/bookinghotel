<!-- Header -->
@include('partial.header')
  <body style="padding-top:70px;padding-bottom:30px;">
  @include('partial/nav-contact')

  	<!-- BODY -->
		<div id="body" class="container">
			@yield('content')
		</div>
	<!-- /BODY -->
	@include('partial/footer')
	@yield("scripts")
  </body>
</html>