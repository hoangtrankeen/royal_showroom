@extends('frontend/layouts/shop')

@section('title', 'Royal')

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
    </style>
@endsection

@section('content')

    <!-- breadcrumb -->
    <div class="container flex-top">

    </div>

    <div class="checkout-success flex-w p-l-25 p-r-15 p-t-30 p-b-200 p-lr-0-lg">
        <div class="container">
            <div class="col-md-12 col-lg-12 col-sm-12 ">
                <div class="col-md-12 col-lg-12">
                    <h2 class="mtext-106 w-full p-b-20 p-t-30">Quý khách đã đặt hàng thành công</h2>
                    <div class="info-bill">
                        <ul>
                            <li>Mã đơn hàng: <strong>{{$bill->id}}</strong></li>
                            <li>Ngày đặt hàng: <strong>{{presentDate($bill->created_at)}}</strong></li>
                            <li>Email: <strong>{{$bill->billing_email}}</strong></li>
                            <li>Phương thức thanh toán: <strong>{{$bill->payment_methods->name}}</strong></li>
                            <li>Ngày nhận hàng: <strong>{{presentDate($bill->delivery_date)}}</strong></li>
                        </ul>
                    </div>



                    <div class="instruction m-t-20">
                        <p>{!!$bill->payment_methods->detail!!}</p>
                    </div>

                    <h2 class="mtext-106 w-full p-b-20 p-t-30">Chi tiết đơn hàng</h2>
                    <div class="bill-product">
                        <table class="table-review">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                            </tr>
                            @foreach($order_products as $item)
                                <tr>
                                    <td class="product-name">{{$item->name}}</td>
                                    <td>{{$item->pivot->quantity}}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <th>Tổng</th>
                                    <td>{{presentPrice($bill->billing_total)}}</td>
                                </tr>
                        </table>
                    </div>
                    <h2 class="mtext-106 w-full p-b-20 p-t-30 ">Địa chỉ thanh toán</h2>
                    <div class="billing-address">
                        <table class="table-review">
                            <tr>
                                <td>Địa chỉ </td>
                                <td>{{$bill->billing_address}}</td>
                            </tr>
                            <tr>
                                <td>Thành phố</td>
                                <td>{{$bill->billing_city}}</td>
                            </tr>
                            <tr>
                                <td>Quận/ Huyện</td>
                                <td>{{$bill->billing_province}}</td>
                            </tr>
                            <tr>
                                <td>Postal code</td>
                                <td>{{$bill->billing_postalcode}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

@endsection
