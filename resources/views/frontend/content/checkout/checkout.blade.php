@extends('frontend/layouts/shop')

@section('title', 'Royal')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">    <style>
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

        .table-review{

            border: 1px solid #e9ecef;
            width: 100%;
        }

        .table-review th, .table-review td {
            border: 1px solid #e9ecef;
            padding: 15px;
            border-width: 0 0 1px 0;
        }

        .table-review table{
            border-collapse: separate;
            border-spacing: 0;
            margin: 1.5em 0 1.75em;
            width: 100%;
            border-width: 1px;
        }
        .table-review .product-thumb img{
            width: 95px;
        }
        .checkout-page{
            font-family: Roboto-Regular;
        }

        .place-order-wrapper{
            border: 1px solid #e9ecef;
        }
        .shipping-method .description{
            background-color: #f1f1f1;
            border-radius: 2px;
            box-sizing: border-box;
            color: #999;
            font-size: 0.92em;
            line-height: 1.5;
            padding: 1em;
            width: 100%;
        }

        input[type=checkbox]{
            display: initial;
        }
        .ui-datepicker-trigger { position:relative;top:-31px ; width: 20px; right: -630px; }
    </style>
@endsection

@section('content')

    <!-- breadcrumb -->
    <div class="container flex-top">

    </div>

    <div class="checkout-page">
        <div class="container">
            <!-- Shoping Cart -->
            <form class="bg0 p-t-25 p-b-85 form-cart-page"  action="{{route('checkout.placeorder')}}" method="POST"  id="payment-form">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-lg-7">
                        <h2 class="mtext-109 cl2 p-b-30">Thông tin giao hàng</h2>
                        @if(Auth::guard('web')->check())
                            <div class="form-group">
                                <label for="name">Họ Tên*</label>
                                <input type="text" id="name" name="name" value="{{ Auth::guard('web')->user()->name }}" required />
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Email*</label>
                                <input type="email" name="email" id="email" value="{{ Auth::guard('web')->user()->email }}" required />
                                @if ($errors->has('email'))
                                    <span class="help-block"> {{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">Số điện thoại*</label>
                                <input type="tel" name="phone" id="phone" value="{{ Auth::guard('web')->user()->phone }}" required />
                                @if ($errors->has('phone'))
                                    <span class="help-block"> {{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="city">Tỉnh/ Thành phố*</label>
                                <input type="text" name="city" id="city" value="{{old('city')}}" required />
                                @if ($errors->has('city'))
                                    <span class="help-block"> {{ $errors->first('city') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="province">Quận/ Huyện*</label>
                                <input type="text" name="province" id="province" value="{{old('province')}}" required />
                                @if ($errors->has('province'))
                                    <span class="help-block"> {{ $errors->first('province') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address">Địa chỉ nhận hàng(Số nhà, ngõ,...)*</label>
                                <input type="text" name="address" id="address" value="{{old('address')}}" required />
                                @if ($errors->has('address'))
                                    <span class="help-block"> {{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="postalcode">Postal Code</label>
                                <input type="text" name="postalcode" id="postalcode" value="{{old('postalcode')}}" required />
                                @if ($errors->has('postalcode'))
                                    <span class="help-block"> {{ $errors->first('postalcode') }}</span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="delivery_date">Ngày nhận hàng</label>
                                <input type="text" name="delivery_date" id="delivery_date" value="{{old('delivery_date')}}" required />

                                @if ($errors->has('delivery_date'))
                                    <span class="help-block"> {{ $errors->first('delivery_date') }}</span>
                                @endif
                            </div>
                        @else
                            <div class="form-group">
                                <label for="name">Họ Tên*</label>
                                <input type="text" id="name" name="name" value="{{old('name')}}" required />
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Email*</label>
                                <input type="email" name="email" id="email" value="{{old('email')}}" required />
                                @if ($errors->has('email'))
                                    <span class="help-block"> {{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">Số điện thoại*</label>
                                <input type="tel" name="phone" id="phone" value="{{old('phone')}}" required />
                                @if ($errors->has('phone'))
                                    <span class="help-block"> {{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="city">Tỉnh/ Thành phố*</label>
                                <input type="text" name="city" id="city" value="{{old('city')}}" required />
                                @if ($errors->has('city'))
                                    <span class="help-block"> {{ $errors->first('city') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="province">Quận/ Huyện*</label>
                                <input type="text" name="province" id="province" value="{{old('province')}}" required />
                                @if ($errors->has('province'))
                                    <span class="help-block"> {{ $errors->first('province') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ nhận hàng(Số nhà, ngõ...)*</label>
                                <input type="text" name="address" id="address" value="{{old('address')}}" required />
                                @if ($errors->has('address'))
                                    <span class="help-block"> {{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="postalcode">Postal Code</label>
                                <input type="text" name="postalcode" id="postalcode" value="{{old('postalcode')}}" required />
                                @if ($errors->has('postalcode'))
                                    <span class="help-block"> {{ $errors->first('postalcode') }}</span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="delivery_date">Ngày nhận hàng</label>
                                <input type="text" name="delivery_date" id="delivery_date" value="{{old('delivery_date')}}" required />

                                @if ($errors->has('delivery_date'))
                                    <span class="help-block"> {{ $errors->first('delivery_date') }}</span>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-12 ">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <h2 class="mtext-109 cl2 p-b-30">Đơn hàng</h2>
                                <div class="order-review">
                                    <table class="table-review">
                                        <thead>
                                        <tr>
                                            <th class="product-thumb mtext-106 cl2">Sản phẩm</th>
                                            <th class="product-name mtext-106 cl2"></th>
                                            <th class="product-total mtext-106 cl2">Tổng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(Cart::content() as $item)
                                            <tr>
                                                <td class="product-thumb">
                                                    <img src="{{getFeaturedImageProduct($item->model->image)}}" alt="{{$item->name}}">
                                                </td>
                                                <td class="product-name">{{$item->name}} x {{$item->qty}}</td>
                                                <td class="product-total">{{presentPrice($item->total)}}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th class="mtext-106 cl2">Free Ship</th>
                                            <td></td>
                                            <td class="">0</td>
                                        </tr>
                                        <tr>
                                            <th class="mtext-106 cl2">Tổng cộng</th>
                                            <td></td>
                                            <th class="mtext-106 cl2">{{presentPrice(Cart::total())}}</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 m-t-20">
                                <div class="place-order-wrapper p-t-30 p-b-20 p-lr-15">
                                    <div class="shipping-method">
                                        <h4 class="mtext-101 cl2 p-b-20">Phương thức thanh toán</h4>
                                        @foreach($payments as $payment)
                                        <label for="cod">
                                            <input type="checkbox" name="payment_method" value="{{$payment->id}}" class="payment_method"/>
                                            {{$payment->name}}
                                        </label>
                                        <div class="description m-t-15 m-b-20 cod-desc .trans-04" style="">
                                            {{$payment->description}}
                                        </div>
                                        @endforeach

                                    </div>
                                    <div class="place-order-action ">
                                        <button type="submit" class="flex-c-m stext-101 cl0 size-115 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Đặt hàng</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>




@endsection



@section('javascript')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(".payment_method").click(function () {
            if ($(this).is(":checked")) {
                $(".payment_method").prop('checked', false);
                $(this).prop('checked', true);
            }
        });

        $('#delivery_date').datepicker({
            showOn: "button",
            buttonImage: "frontend/images/icons/calendar.svg",
            buttonImageOnly: true,
            buttonText: "Select date"
        });
    </script>
@endsection
