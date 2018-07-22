<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Royal | @yield('title')</title>

	<!-- Main Styles -->
	<link rel="stylesheet" href="{{asset('backend/assets/styles/style.min.css')}}">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css')}}">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/waves/waves.min.css')}}">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/sweet-alert/sweetalert.css')}}">

	<!-- Toastr -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/toastr/toastr.css')}}">

	<!-- Color Picker -->
	<link rel="stylesheet" href="{{asset('backend/assets/color-switcher/color-switcher.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/styles/color/chocolate.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('backend/web/custom.css')}}">

	@yield('css')
</head>

<body>
	@include('partials/backend/main-menu')
	<!-- /.main-menu -->

	@include('partials/backend/top-nav')
	<!-- /#message-popup -->

	{{-- @include('partials/backend/color-switcher') --}}
	<!-- #color-switcher -->

	<div id="wrapper">
		<div class="main-content">

			@yield('content')

			<!-- /.row small-spacing -->		
			<footer class="footer">
				<ul class="list-inline">
					<li>2018 © Showroom Royal.</li>
				</ul>
			</footer>
		</div>
		<!-- /.main-content -->
	</div><!--/#wrapper -->


	@yield('modal')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
	<!--

		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="{{asset('backend/assets/scripts/jquery.min.js')}}"></script>
		<script src="{{asset('backend/assets/scripts/modernizr.min.js')}}"></script>
		<script src="{{asset('backend/assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('backend/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
		<script src="{{asset('backend/assets/plugin/nprogress/nprogress.js')}}"></script>
		<script src="{{asset('backend/assets/plugin/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{asset('backend/assets/plugin/waves/waves.min.js')}}"></script>
		<!-- Full Screen Plugin -->
		<script src="{{asset('backend/assets/plugin/fullscreen/jquery.fullscreen-min.js')}}"></script>

		<!-- Toastr -->
		<script src="{{asset('backend/assets/plugin/toastr/toastr.min.js')}}"></script>
		<script src="{{asset('backend/assets/scripts/toastr.demo.min.js')}}"></script>

		<script src="{{asset('backend/assets/scripts/main.min.js')}}"></script>
		<script src="{{asset('backend/assets/color-switcher/color-switcher.min.js')}}"></script>

		@yield('javascript')
	</body>
</html>