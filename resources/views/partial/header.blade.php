<!DOCTYPE html>
<html>
<head>
	  	<meta charset="utf-8">
	 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
		<title>@yield('title')</title>
		
		<!-- FONT -->
		<link href='https://fonts.googleapis.com/css?family=Biryani:400,200,300,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="{{ url("assets/css/font-awesome.min.css") }}">
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{ url("/assets/css/style.css")}}">
		<link rel="stylesheet" href="{{ url("/assets/css/bootstrap-theme.css")}}">
		<link rel="stylesheet" href="{{ url("/assets/css/superfish.css")}}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{ url("/assets/css/slick.css")}}">
		<link rel="stylesheet" type="text/css" href="{{ url("/assets/css/slick-theme.css")}}">
		 <link rel="stylesheet" type="text/css" href="{{ url('/assets/css/contact.css') }}">
		 
		<!-- SCRIPT -->
		<script src="{{ url("/assets/js/jquery-3.0.0.min.js")}}"></script>
		<script src="{{ url("/assets/js/jquery-migrate-3.0.0.min.js")}}"></script>
		<script src="{{ url("/assets/js/superfish.js")}}"></script>
		<script src="{{ url("/assets/js/slick.min.js")}}"></script>
		
		<script src="{{ url("/assets/js/function.min.js")}}"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		 @yield('head-scripts')
		
		@if(Request::is('area/*'))
			  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
         @endif
	</head>