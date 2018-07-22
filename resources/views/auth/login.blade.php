

@extends('frontend/layouts/shop')

@section('title', 'Đăng nhập')

@section('css')
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

        .login-container .block .block-title h2, .form-create-account h2 {
            font-size: 18px;
            text-transform: uppercase;
            font-weight: 700;
            margin: 0 0 20px;
            color: #222;
        }

        a#forget-password{
            line-height: 40px;
            color: #999;
            text-transform: capitalize;
            font-weight: normal;
        }
        .title-group{
            color: #222;
            font-weight: 600;
        }
        .log-in-button{
            background-color: #222;
        }

    </style>
@endsection

@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92 banner-category">
        <h2 class="ltext-105 cl0 txt-center">
            Đăng nhập
        </h2>
    </section>
    <div class="bg0 m-t-40 p-b-140 flex-change">
        <div class="container">
            <div class="row">
                <div class="column main col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="login-container row">
                        <div class="col-sm-6 col-xs-12 margin-bottom50">
                            <div class="block block-customer-login">
                                <div class="block-title fieldset">
                                    <h2 class="title" id="login-heading" role="heading" aria-level="2"><span>Khách hàng đã đăng kí</span></h2>
                                </div>
                                <div class="block-content">
                                    <form  method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        <p class="p-b-10 p-t-10 font-italic">Xin quý khách vui lòng đăng nhập với địa chỉ email</p>
                                        <div class="form-group">
                                            <label for="email" class="title-group">Email*</label>
                                            <input type="text" name="email" id="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    {{ $errors->first('email') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="title-group">Mật khẩu*</label>
                                            <input type="password" name="password" id="password" value="">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    {{ $errors->first('password') }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="actions-toolbar p-t-10 clearfix">
                                            <button type="submit" class="pull-left flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 log-in-button" name="send" id="send2">Đăng nhập</button>
                                            <a id="forget-password" class="p-lr-20 hov-cl1 margin-left15 action remind" href="{{ route('password.request') }}"><span>Quên mật khẩu?</span></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 pull-right"><div class="block block-new-customer">
                                <div class="block-title">
                                    <h2 class="title" id="block-new-customer-heading" role="heading" aria-level="2"><span>Khách hàng mới</span></h2>
                                </div>
                                <div class="block-content" aria-labelledby="block-new-customer-heading">
                                    <p class="p-b-10">Tạo tài khoản sẽ giúp quý khách hoàn thành các thủ tục đặt hàng nhanh hơn, xem và theo dõi đơn hàng trong tài khoản của quý khách và nhiều hơn thế nữa. </p>

                                    <div class="p-t-10">
                                        <a href="{{ route('register') }}" class=" pull-left flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04"><span>Tạo tài khoản</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

@endsection
