@extends('frontend/layouts/dashboard')

@section('title', 'Royal')

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
                <h2 class="mtext-109 cl2 p-b-30">Đơn hàng</h2>
                <div class="order-review">
                    <table class="table-review">
                        <thead>
                        <tr>
                            <th class=" mtext-106 cl2">#Mã đơn hàng</th>
                            <th class=" mtext-106 cl2">Ngày</th>
                            <th class=" mtext-106 cl2">Tổng</th>
                            <th class=" mtext-106 cl2">Trạng thái</th>
                            <th class=" mtext-106 cl2"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $item)
                                <tr>
                                    <td class="">#{{$item->id}}</td>
                                    <td class="">{{presentDate($item->created_at)}}</td>
                                    <td class="">{{presentPrice($item->billing_total)}}</td>
                                    <td class="">{{presentPrice($item->statuses->name)}}</td>
                                    <td class="">
                                        <a href="{{route('customer.order.detail', ['id' => $item->id])}}" class="stext-103 cl2 size-102 bg0 bor2 hov-cl1 p-lr-15 trans-04">
                                            Xem
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $orders->links('frontend.partials.pager.pager') }}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

@endsection
