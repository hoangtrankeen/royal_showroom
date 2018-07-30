<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend/partials/head')
    <!--=======================================Leftnav Style=================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('frontend/web/smartmenu/css/sm-core-css.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('frontend/web/smartmenu/css/sm-mint/sm-mint.css')}}">
        <style>
            input[type=text], input[type=password], input[type=url], input[type=tel], input[type=search], input[type=number], input[type=datetime], input[type=email] {
                background: #fff;
                border: 1px solid #ccc;
                box-sizing: border-box;
                border-radius: 0;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                -o-border-radius: 0;
                font-size: 13px;
                height: 40px;
                line-height: 36px;
                padding: 0 10px;
                vertical-align: baseline;
                width: 100%;
                color: #878787;
                box-shadow: none !important;
            }

            .checker input,label{
                display: initial;
            }

        </style>
</head>

<body class="animsition">

<header class="header-v4">
    @include('frontend/partials/header')
</header>

@include('frontend/partials/panel-cart')

<section class="bg-img1 txt-center p-lr-15 p-tb-92 banner-category">
    <h2 class="ltext-105 cl0 txt-center">
        Tài khoản
    </h2>
</section>

<div class="bg0 m-t-40 p-b-140 flex-change">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <nav id="main-nav">
                        <ul id="main-smartmenu" class="sm sm-vertical sm-mint">
                            <li><h3><a href="{{route('customer.order.list')}}">Đơn hàng của bạn</a></h3></li>
                            <li><h3><a href="{{route('customer.account.edit')}}">Thông tin tài khoản</a></h3></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 p-b-50">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend/partials/footer')
@include('frontend/partials/modal')
@include('frontend/partials/script')

<script>
    $(".wrap-menu-desktop").addClass("how-shadow1");
</script>

<!--Lefnav-->
<script src="{{asset('frontend/web/smartmenu/js/jquery.smartmenus.js')}}"></script>

<!-- SmartMenus jQuery init -->
<script type="text/javascript">
    $(function() {
        $('#main-smartmenu').smartmenus({
            mainMenuSubOffsetX: 10,
            mainMenuSubOffsetY: 0,
            subMenusSubOffsetX: 10,
            subMenusSubOffsetY: 0
        });
    });
</script>
<script>

    $(".group-new-email").hide();
    $(".group-new-password").hide();
    $(".group-current-password").hide();
    $(".group-change-title").hide();

    function openTarget(target) {
        if(target === 'password'){
            var checkBox =  $("#change-password");
            var group = $(".group-new-password");
            var email = $(".group-new-email");
            var password =  $(".group-current-password");
            var title =  $(".group-change-title");
            if (checkBox.is(':checked') == true){
                group.show();
                password.show();
                title.show();
            } else {
                group.hide();
                if(email.is(':hidden')){
                    password.hide();
                    title.hide()
                }
            }
        }
        if(target === 'email'){
            var group = $(".group-new-password");
            var checkBox =  $("#change-email");
            var email = $(".group-new-email");
            var password =  $(".group-current-password");
            var title =  $(".group-change-title");
            if (checkBox.is(':checked') == true){
                email.show();
                password.show();
                title.show();
            } else {
                email.hide();
                if(group.is(':hidden')){
                    password.hide();
                    title.hide();
                }
            }
        }

    }
</script>

</body>

</html>