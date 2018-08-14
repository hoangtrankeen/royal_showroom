<title>Laravel Ecommerce | @yield('title', '')</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="{{asset('frontend/images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/linearicons-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/slick/slick.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/MagnificPopup/magnific-popup.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/main.css')}}">


<!--=======================================Custom Style=================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/custom.css')}}">

<!--=======================================MEGA-MENU=================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/web/mega-menu/css/mega-menu.css')}}">

<!--=======================================SMART-MENU=================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/web/smartmenu/css/sm-core-css.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/web/smartmenu/css/sm-mint/sm-mint.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/web/smartmenu/css/sm-blue/sm-blue.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/web/smartmenu/css/sm-clean/sm-clean.css')}}">

@yield('css')