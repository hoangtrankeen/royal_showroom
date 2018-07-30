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
            Liên hệ
        </h2>
    </section>
    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    {{--<form>--}}
                        {{--<h4 class="mtext-105 cl2 txt-center p-b-30">--}}
                            {{--Gửi lời nhắn cho chúng tôi--}}
                        {{--</h4>--}}

                        {{--<div class="bor8 m-b-20 how-pos4-parent">--}}
                            {{--<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Email của bạn">--}}
                            {{--<img class="how-pos4 pointer-none" src="{{asset('frontend/images/icons/icon-email.png')}}" alt="ICON">--}}
                        {{--</div>--}}

                        {{--<div class="bor8 m-b-30">--}}
                            {{--<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="Bạn muốn tư vấn về sản phẩm ? Xin vui lòng gửi mail cho chúng tôi"></textarea>--}}
                        {{--</div>--}}

                        {{--<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">--}}
                            {{--Gửi--}}
                        {{--</button>--}}
                    {{--</form>--}}
                    <div class="map">
                        <div class="size-303" id="google_map" data-map-x="21.0067355" data-map-y="105.7752803" data-pin="{{asset('frontend/images/icons/pin2.png')}}"  data-scrollwhell="0" data-draggable="1" data-zoom="15"></div>
                    </div>
                </div>

                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

                        <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Địa chỉ
							</span>

                            <p class="stext-115 cl6 size-213 p-t-18">
                                18/73 Mễ Trì Thượng
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

                        <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Gọi cho chúng tôi
							</span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                +84 912229992
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

                        <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Bộ phận chăm sóc khách hàng
							</span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                royalshowroom@furniture.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Map -->


@endsection

@section('javascript')
    <script>
        $('.js-pscroll').each(function(){
            $(this).css('position','relative');
            $(this).css('overflow','hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function(){
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
    <script src="{{asset('frontend/js/map-custom.js')}}"></script>
@endsection
