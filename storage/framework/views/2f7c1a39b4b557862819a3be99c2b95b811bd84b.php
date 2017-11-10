<!DOCTYPE html>
<html>
<head>
	  	<meta charset="utf-8">
	 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
		<title><?php echo $__env->yieldContent('title'); ?></title>
		
		<!-- FONT -->
		<link href='https://fonts.googleapis.com/css?family=Biryani:400,200,300,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/font-awesome.min.css')); ?>">
		
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/css/style.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(url("/assets/css/bootstrap-theme.css")); ?>">
		<link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/superfish.css')); ?>" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/css/slick.css')); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/css/slick-theme.css')); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/css/frontend.css')); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/css/datepicker.css')); ?>">
		<!-- SCRIPT -->
		<script src="<?php echo e(URL::asset('assets/js/jquery-3.0.0.min.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('assets/js/jquery-migrate-3.0.0.min.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('assets/js/superfish.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('assets/js/slick.min.js')); ?>"></script>
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="<?php echo e(URL::asset('assets/js/bootstrap-datepicker.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('assets/js/function.min.js')); ?>"></script>
		
		<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
		<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-2Jq3Bkc9efp29JRYktVjDstk5VBpkGU&libraries=places"></script>
		<style>
			.g-recaptcha {
				transform-origin: left top;
				-webkit-transform-origin: left top;
			}
			.captcha-container {
				max-width: 300px;
				padding: 20px;
			}
			.footer {
				position: relative;
				bottom: 0;
				width: 100%;
				/* Set the fixed height of the footer here */
				height: 100px;
				background-color: #f5f5f5;
			}
		</style>
	</head>