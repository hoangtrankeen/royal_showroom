<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend/partials/head')
</head>

<body class="animsition">

<header class="header-v4">
    @include('frontend/partials/header')
</header>

@include('frontend/partials/panel-cart')

@yield('content')


@include('frontend/block/shop-block/featured-group-slider')
@include('frontend/partials/footer')
@include('frontend/partials/modal')
@include('frontend/partials/script')

<script>
    $(".wrap-menu-desktop").addClass("");
</script>
</body>

</html>