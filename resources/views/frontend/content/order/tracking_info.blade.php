@extends('frontend/layouts/blank')

@section('title', 'Contact')

@section('css')

    <style>
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
    </style>
@endsection

@section('content')
    <div class="order_list">
        <div class="container">
            <div class="col-md-12 col-lg-12">
                <h2 class="mtext-109  p-b-30">Sản phẩm</h2>
                <div class="order-review">
                    <table class="table-review">
                        <thead>
                        <tr>
                            <th class=" mtext-106 ">Tên sản phẩm</th>
                            <th class=" mtext-106 ">Mã sản phẩm</th>
                            <th class=" mtext-106 ">Giá</th>
                            <th class=" mtext-106 ">Số lượng</th>
                            <th class=" mtext-106 ">Tổng</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                            <tr>
                                @php
                                    $total =( $product->pivot->quantity * $product->final_price);
                                @endphp

                                <td class="">{{$product->name}}</td>
                                <td class="">{{$product->sku}}</td>
                                <td class="">{{presentPrice($product->final_price)}}</td>
                                <td class="">{{$product->pivot->quantity}}</td>
                                <td class="">{{presentPrice($total)}}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <th class="mtext-106 ">Tổng cộng</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th class="mtext-106 ">{{presentPrice($order->billing_total)}}</th>
                        </tr>
                        </tbody>
                    </table>

                    <div class="order-info m-t-50 m-b-40">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 p-r-20">
                                <h2 class="mtext-109  p-b-30">Địa chỉ nhận hàng và thanh toán</h2>
                                <div class="method-description">
                                    <table class="table-review">
                                        <tr>
                                            <th>Người nhận hàng: </th>
                                            <td>{{$order->billing_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Di động:</th>
                                            <td>{{$order->billing_phone}}</td>
                                        </tr>
                                        <tr>
                                            <th>Địa chỉ chi tiết:</th>
                                            <td>{{$order->billing_address}}</td>
                                        </tr>
                                        <tr>
                                            <th>Quận/Huyện:</th>
                                            <td>{{$order->billing_province}}</td>
                                        </tr>
                                        <tr>
                                            <th>Thành phố:</th>
                                            <td>{{$order->billing_city}}</td>
                                        </tr>
                                        <tr>
                                            <th>Postal code:</th>
                                            <td>{{$order->billing_postalcode}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 p-l-20">
                                <h2 class="mtext-109  p-b-30">Phương thức thanh toán</h2>
                                <div class="method-description">
                                    <p class="mtext-107 ">{{$order->payment_methods->name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="action col-md-5">
                        <a href="{{route('customer.order.list')}}" class=" p-tb-10 pull-left  flex-c-m stext-103 cl0 size-102 bg3 bor14 hov-btn3 p-lr-15 trans-04 ">
                            Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('javascript')

    <!--===============================================================================================-->
    <script src="{{asset('frontend/js/map-custom.js')}}"></script>
@endsection
