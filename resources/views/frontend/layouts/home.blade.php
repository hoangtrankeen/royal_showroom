<!DOCTYPE html>
<html lang="en">
<head>
	@include('frontend/partials/head')
</head>

<body class="animsition">
    <header>
        @include('frontend/partials/header')
    </header>
    @include('frontend/partials/panel-cart')
	@include('frontend/block/home-block/slider')
    @include('frontend/block/home-block/policy')
    @include('frontend/block/home-block/banner')
    @include('frontend/block/home-block/group-product')
	{{--@include('frontend/partials/product-grid')--}}
	@include('frontend/block/home-block/slide-product')
	@include('frontend/partials/footer')
	@include('frontend/partials/modal')
	@include('frontend/partials/script')
</body>

</html>