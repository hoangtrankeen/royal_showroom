<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    <link rel="stylesheet" href="{{asset('backend/assets/styles/style.min.css')}}">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/waves/waves.min.css')}}">

</head>

<body>

<div id="single-wrapper">
   @yield('content')
</div><!--/#single-wrapper -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="{{asset('backend/assets/script/html5shiv.min.js')}}"></script>
<script src="{{asset('backend/assets/script/respond.min.js')}}"></script>
<![endif]-->
<!--
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('backend/assets/scripts/jquery.min.js')}}"></script>
<script src="{{asset('backend/assets/scripts/modernizr.min.js')}}"></script>
<script src="{{asset('backend/assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/assets/plugin/nprogress/nprogress.js')}}"></script>
<script src="{{asset('assets/plugin/waves/waves.min.js')}}"></script>

<script src="{{asset('backend/assets/scripts/main.min.js')}}"></script>
</body>
</html>
