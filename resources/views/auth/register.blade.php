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

        .login-container .block .block-title h2, .register-header {
            font-size: 18px;
            text-transform: uppercase;
            font-weight: 700;
            margin: 0 0 20px;
            color: #222;
        }
        .main-block{
            border: 1px solid #e8e8e8;
            padding: 50px;
        }
        .register-container{
            padding: 0 50px;
        }
        #register-form{
            width: 100%;
        }
        .title-group{
            color: #222;
            font-weight: 600;
        }
        .group-form{
            margin-top: 25px;
        }

        .wrap-form{
            margin: 0 auto;
        }
        .register-button{
            width: 100%;
            background-color: #333;

        }
        .register-button:hover{
            background-color: #e65540;

        }


    </style>
@endsection

@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92 banner-category">
        <h2 class="ltext-105 cl0 txt-center">
            Đăng kí
        </h2>
    </section>
    <div class="bg0 m-t-40 p-b-140 flex-change">
        <div class="container">
            <div class="row">
                <div class="column main-block col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-8 wrap-form">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="section-1">
                                <h2 class="register-header">Thông tin cơ bản</h2>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 field p-t-10">
                                        <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="Tên" required>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                            {{ $errors->first('name') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 field p-t-10">
                                        <input type="text" id="phone" class=""  name="phone" value="{{old('phone')}}" placeholder="Số điện thoại">
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                            {{ $errors->first('phone') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="section-2 m-t-40">
                                <h2 class="register-header m-t-30">Thông tin đăng nhập</h2>
                                <div class="">
                                    <div class="group-formm">
                                        <label for="email" class="title-group">Email*</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="group-form">
                                        <label for="password" class="title-group">Mật khẩu*</label>
                                        <input id="password" type="password" class="form-control" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                            {{ $errors->first('password') }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="group-form">
                                        <label for="password-confirm" class="title-group">Xác nhận mật khẩu*</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>

                                    <div class="actions-toolbar m-t-25 clearfix">
                                        <button type="submit" class="pull-left flex-c-m stext-103 cl2 size-102  bg0 bor2 hov-btn1 p-lr-15 trans-04 register-button" >Đăng kí</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

@endsection

