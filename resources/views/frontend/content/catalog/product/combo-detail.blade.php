@extends('frontend/layouts/shop')

@section('title', 'Royal')

@section('css')
    <style>
        .table-group{
            /*border: 1px solid #e9ecef;*/
            width: 100%;
        }

        .table-group th, .table-group td {
            border-bottom: 1px solid #e9ecef;
            padding: 10px;
            border-width: 0 0 1px 0;
        }

        .table-group table{
            border-collapse: separate;
            border-spacing: 0;
            margin: 1.5em 0 1.75em;
            width: 100%;
            border-width: 1px;
        }
        .table-group .product-thumb img{
            width: 95px;
        }
        .logo-sale{
            position: absolute;
            left: -104px;
            width: 95px;
            top: -18px;
        }
        .original-price{
            text-decoration: line-through;
        }
        .discout-price{
            color: red;
        }
    </style>
@endsection

@section('content')
    @if(Session::has('category'))
        @php
            $bread =  Session::get('category');
            $breadname = $bread['name'];
            $breadslug = $bread['slug'];
        @endphp
    @else
        @php
            $breadname = '';
            $breadslug = '';
        @endphp
    @endif

    <div class="bg0 m-t-20 p-b-40 flex-change">
        <div class="container">
            <div class="flex-w flex-sb-m">
                <div class="flex-w flex-l-m filter-tope-group">
                    <div class="bread-crumb flex-w p-l-25 p-r-15 p-lr-0-lg">
                        <a href="{{route('home')}}" class="stext-109 cl8 hov-cl1 trans-04">
                            Trang chủ
                            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                        </a>
                        @if($breadname)
                            <a href="{{route('catalog.category', ['slug' => $breadslug])}}" class="stext-109 cl8 hov-cl1 trans-04">
                                {{ $breadname}}
                                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                            </a>
                            <span class="stext-109 cl4">{{$product->name}}</span>
                        @else
                            <span class="stext-109 cl4">{{$product->name}}</span>
                        @endif

                    </div>
                </div>
            </div>
            <!-- Product Detail -->
            <section class="sec-product-detail bg0 p-t-65 p-b-60">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-7 p-b-30 combo-lightbox">
                            <div class="p-l-25 p-r-30 p-lr-0-lg">
                                <div class="wrap-slick3 flex-sb flex-w">
                                    <div class="wrap-slick3-dots"></div>
                                    <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                    <div class="slick3 gallery-lb">
                                        @if($product->images)
                                            @foreach(json_decode($product->images) as $image)
                                                <div class="item-slick3" data-thumb="{{getFeaturedImageProduct($image)}}">
                                                    <div class="wrap-pic-w pos-relative">
                                                        <img src="{{getFeaturedImageProduct($image)}}" alt="IMG-PRODUCT">
                                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{getFeaturedImageProduct($image)}}">
                                                            <i class="fa fa-expand"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-5 p-b-30">
                            <div class="p-r-50 p-t-5 p-lr-0-lg">
                                <h1 class="mtext-105 cl2 js-name-detail p-b-14">
                                    {{$product->name}}
                                </h1>
                                <img  class="logo-sale" src="{{asset('frontend/images/logo/sale_tag_256.png')}}" alt="">

                                {{--<h3 class="mtext-106 cl2 p-tb-14 original-price" >--}}
                                    {{--Giá niêm yết: 11.560.000đ--}}
                                {{--</h3>--}}

                                <h3 class="mtext-105 cl2 discout-price" style="color: red;">
                                    {{presentPrice($product->final_price)}}
                                </h3>
                                <p class="stext-102 cl3 p-t-23">
                                    {!! $product->description !!}
                                </p>

                                <p class="stext-102 cl2 p-t-23">
                                    Bộ sản phẩm đi kèm
                                </p>
                                <hr>
                                @foreach($child_products as $child)
                                    <table class="table-group ">
                                        <tr>
                                            <td>
                                                <img src="{{getFeaturedImageProduct($child->image)}}" alt="" width="50">
                                            </td>
                                            <td>
                                                <a href="{{route('catalog.product', ['slug'=> $child->slug])}}" class=" stext-103 cl2 hov-cl1 p-b-14">{{$child->name}}</a>
                                            </td>
                                            <td class="data">
                                                <p class="text-right stext-105 cl3">{{presentPrice($child->final_price)}}</p>
                                            </td>
                                        </tr>
                                    </table>

                                @endforeach

                            </div>

                            @if($product->in_stock !== 1)
                                <p>Hết hàng</p>
                            @else
                                <form action="" class="form-cart p-t-40">
                                    <div class=" p-b-10">
                                        <div class="size-204 flex-w flex-m respon6-next">
                                            <input type="hidden" class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" value="1"/>
                                            <input type="hidden" name="id" id="product_id" value="{{$product->id}}">
                                            <input type="hidden" name="name" id="product_name" value="{{$product->name}}">
                                            <input type="hidden" name="final_price" id="product_final_price" value="{{$product->final_price}}">
                                            <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                                Thêm vào giỏ hàng
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>

                    <div class="bor10 m-t-50 p-t-43 p-b-40">
                        <!-- Tab01 -->
                        <div class="tab01">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item p-b-10">
                                    <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô tả sản phẩm</a>
                                </li>

                                <li class="nav-item p-b-10">
                                    <a class="nav-link" data-toggle="tab" href="#information" role="tab">Thông số sản phẩm</a>
                                </li>

                                <!--<li class="nav-item p-b-10">
                                    <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Bình luận</a>
                                </li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-t-43">
                                <!-- - -->
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <div class="how-pos2 p-lr-15-md">
                                        <div class="m-tb-30">
                                            <h4 class="mtext-106 cl4">Bộ combo bao gồm</h4>
                                            <table class="table-group m-tb-20">
                                                <thead>
                                                <tr>
                                                    <th class="name">#</th>
                                                    <th class="name">Tên sản phẩm</th>
                                                    <th class="name">Mô tả</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i = 1;@endphp
                                                @foreach($child_products as $child)

                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>
                                                            <a href="{{route('catalog.product', ['slug'=> $child->slug])}}" class=" stext-103 cl2 hov-cl1 p-b-14">{{$child->name}}</a>
                                                        </td>
                                                        <td>
                                                            <p class="stext-105 cl3">{{presentPrice($child->description)}}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="information" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                            <ul class="p-lr-28 p-lr-15-sm">
                                                @foreach($product->attributeValue as $attr)
                                                    <li class="flex-w flex-t p-b-7">
                                                        <span class="stext-102 cl3 size-205">{{$attr->attribute->name}}</span>
                                                        <span class="stext-102 cl6 size-206">{{$attr->name}}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- -
                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                            <div class="p-b-30 m-lr-15-sm">

                                                <div class="flex-w flex-t p-b-68">
                                                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                        <img src="images/avatar-01.jpg" alt="AVATAR">
                                                    </div>

                                                    <div class="size-207">
                                                        <div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														Ariana Grande
													</span>

                                                            <span class="fs-18 cl11">
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star-half"></i>
													</span>
                                                        </div>

                                                        <p class="stext-102 cl6">
                                                            Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
                                                        </p>
                                                    </div>
                                                </div>


                                                <form class="w-full">
                                                    <h5 class="mtext-108 cl2 p-b-7">
                                                        Add a review
                                                    </h5>

                                                    <p class="stext-102 cl6">
                                                        Your email address will not be published. Required fields are marked *
                                                    </p>

                                                    <div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

                                                        <span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
                                                    </div>

                                                    <div class="row p-b-25">
                                                        <div class="col-12 p-b-5">
                                                            <label class="stext-102 cl3" for="review">Your review</label>
                                                            <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                                        </div>

                                                        <div class="col-sm-6 p-b-5">
                                                            <label class="stext-102 cl3" for="name">Name</label>
                                                            <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
                                                        </div>

                                                        <div class="col-sm-6 p-b-5">
                                                            <label class="stext-102 cl3" for="email">Email</label>
                                                            <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
                                                        </div>
                                                    </div>

                                                    <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                        Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				SKU: {{$product->sku}}
			</span>

                    <span class="stext-107 cl6 p-lr-25">
				Categories: @foreach($product->categories as $category){{$category->name}} @endforeach
			</span>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('.combo-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '';
                    }
                }
            });
        });
    </script>
@endsection

