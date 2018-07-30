@extends('frontend/layouts/blank')

@section('title', 'Contact')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{asset('media/banner/banner4.jpg')}}); background-position: top;">
        <h2 class="ltext-105 cl0 txt-center">
            Tra cứu thông tin đơn hàng
        </h2>
    </section>
    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form action="{{route('tracking.order.info')}}" method="GET">
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Tra cứu đơn hàng
                        </h4>
                        <div class="bor8 m-b-30">
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="order_id">
                        </div>
                        <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            Gửi
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </section>


    <!-- Map -->


@endsection

@section('javascript')

    <!--===============================================================================================-->
    <script src="{{asset('frontend/js/map-custom.js')}}"></script>
@endsection
