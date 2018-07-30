@extends('frontend/layouts/shop')

@section('title', 'Royal')

@section('css')
@endsection

@section('content')

    <!-- breadcrumb -->
    <div class="container flex-top">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				Giỏ hàng
			</span>
        </div>
    </div>

    @if (Cart::count() > 0)

    <!-- Shoping Cart -->
    <form class="bg0 p-t-25 p-b-85 form-cart-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 col-md-12 col-sm-12 m-lr-auto m-b-50 table-shopping-cart-desktop">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Sản phẩm</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Giá</th>
                                    <th class="column-4 text-center">Số lượng</th>
                                    <th class="column-5"></th>
                                </tr>

                                @foreach (Cart::content() as $item)

                                <tr class="table_row" id="item-{{$item->model->id}}">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="{{getFeaturedImageProduct($item->model->image)}}" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">{{ $item->model->name }}</td>
                                    <td class="column-3">{{ presentPrice($item->price)}}</td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m change-number">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" data-value="{{$item->model->id}}" type="number" min="1" name="num-product" value="{{$item->qty}}">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m change-number">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5">
                                        <button class="cart-remove cl2 hov-cl1 trans-04" data-value="{{$item->model->id}}"><i class="zmdi zmdi-delete"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 col-xl-7 col-md-12 col-sm-12 m-lr-auto m-b-50 table-shopping-cart-mobile">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart ">
                                @foreach(Cart::content() as $item)
                                    <tr class="header-row" >
                                        <th class="column-custom">Sản phẩm</th>
                                        <td> {{ $item->model->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="column-custom">Hình ảnh</th>
                                        <td><img src="{{getFeaturedImageProduct($item->model->image)}}" alt="IMG" width="100px"></td>
                                    </tr>
                                    <tr>
                                        <th class="column-custom">Giá</th>
                                        <td> {{ ($item->price) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="column-custom ">Số lượng</th>
                                        <td><div class="wrap-num-product flex-w ">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m change-number">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product"  data-value="{{$item->model->id}}" type="number" name="number"  min="1" value="{{$item->qty}}">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m change-number">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="column-custom">Tổng (VNĐ)</th>
                                        <td> {{ ($item->total) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Thông tin giỏ hàng
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
								<span class="stext-110 cl2">
									Số sản phẩm:
								</span>
                            </div>

                            <div class="size-209">
								<span class="mtext-110 cl2">
									<span id="cart-count">{{Cart::count()}}</span>
								</span>
                            </div>
                        </div>


                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
								<span class="mtext-101 cl2">
									Tổng cộng:
								</span>
                            </div>

                            <div class="size-209 p-t-1">
								<span class="mtext-110 cl2 " id="cart-total">
									{{presentPrice(Cart::total())}}
								</span>
                            </div>
                        </div>

                        <a class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" href="{{route('checkout')}}">
                            Tiến hành thanh toán
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
        <div class="bg0 m-b-300 p-t-25 p-b-25">
            <div class="container">
                <h5 class="p-l-15 text-center w-full">Hiện tại không có sản phẩm nào trong giỏ hàng</h5>
            </div>
        </div>
    @endif

@endsection



@section('javascript')
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var customElement = $("<div>", {
                "class" : "loader05"
            });

            $(".cart-remove").on('click',function(e){
                e.preventDefault();

                $.LoadingOverlay("show", {
                    image       : "",
                    custom      : customElement
                });

                var id = $(this).attr('data-value');
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: window.location.origin +'/cart/remove/'+ id,
                    dataType: 'json',
                    data: {
                        id:id,
                        _method: 'DELETE'
                    },
                    success: function( data ) {
                        if(data.success === false){
                            console.log(data.message);
                            location.reload();
                        }else {
                            console.log(data.message);
                            upDateCartPage(data,id);
                            upDateCartPanel(data);
                        }
                    },

                    error: function(xhr, textStatus, error){

                    }
                });

                setTimeout(function(){
                    $.LoadingOverlay("hide");
                }, 1000);

            });

        });

        function upDateCartPage(data,id) {
            if(id !== null){
                $("#item-"+id).remove();
            }
            $("#cart-count").text(data.count);
            $("#cart-total").text(data.total);
            if(!(data.count > 0)){
                var html = ' <div class="bg0 m-b-300 p-t-25 p-b-25"><div class="container"><h5 class="p-l-15 text-center">Hiện tại không có sản phẩm nào trong giỏ hàng</h5></div></div>';
                $(".form-cart-page").replaceWith(html);
            }
        }
        function upDateCartPanel(data) {

            $('.side-cart-item').not(':first').remove();

            var i = 0;
            $.each(data.cart_items, function (key, value) {
                i++;
                var item = $("#side-cart-sample").clone();
                item.css('display','block');
                item.appendTo(".side-cart-wrapper");
                item.attr('id', 'side-cart-sample'+i);

                item.find(".header-cart-item-img").find('.side-cart-img').attr('src',value.image);
                item.find(".header-cart-item-txt").find('.side-cart-name').text(value.name);
                item.find(".header-cart-item-txt").find('.side-cart-price').find('.price').text(value.price);
                item.find(".header-cart-item-txt").find('.side-cart-price').find('.qty').text(value.qty);

            });

            $('.js-hide-modal1').trigger('click');

            $(".js-show-cart").attr("data-notify",data.count);

            $('.side-cart-total').find('#value-total').text(data.subtotal);

            //Update title has item or not
            if(!(data.count > 0) ){
                $('.side-cart-action').hide();
                $('.side-cart-empty').show();
            }else{
                $('.side-cart-action').show();
                $('.side-cart-empty').hide();
            }
        }

        $(".btn-num-product-down").on('click', function () {
            $.LoadingOverlay("show", {
                image       : "",
                custom      : customElement
            });

            var id = $(this).next('.num-product').attr('data-value');
            var quantity = $(this).next('.num-product').val();

            console.log(quantity);
            sendUpdateQty(id, quantity);

            setTimeout(function(){
                $.LoadingOverlay("hide");
            }, 1000);
        });



        var customElement = $("<div>", {
            "class" : "loader05"
        });


        $(".num-product").on('change', function () {
            $.LoadingOverlay("show", {
                image       : "",
                custom      : customElement
            });
            var id = $(this).attr('data-value');
            var quantity = $(this).val();
            console.log(quantity);
            sendUpdateQty(id, quantity);

            setTimeout(function(){
                $.LoadingOverlay("hide");
            }, 1000);
        });

        $(".btn-num-product-up").on('click', function () {
            $.LoadingOverlay("show", {
                image       : "",
                custom      : customElement
            });

            var id = $(this).prev('.num-product').attr('data-value');
            var quantity = $(this).prev('.num-product').val();

            console.log(quantity);
            sendUpdateQty(id, quantity);


            setTimeout(function(){
                $.LoadingOverlay("hide");
            }, 1000);
        });

        function sendUpdateQty(id, quantity) {
            $.ajax({
                type: "POST",
                url: window.location.origin +'/cart/update/'+ id,
                dataType: 'json',
                data: {
                    id:id,
                    quantity: quantity,
                    _method: 'POST'
                },
                success: function( data ) {
                    if(data.success === false){
                        console.log(data.message);
                        location.reload();
                    }else{
                        console.log(data.message);
                        upDateCartPage(data, data.remove_id);
                        upDateCartPanel(data);
                    }
                },

                error: function(xhr, textStatus, error){

                }
            });

        }
    </script>
@endsection
