@extends('frontend/layouts/shop')

@section('title', 'Royal')

@section('css')
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
                        <div class="col-md-6 col-lg-7 p-b-30">
                            <div class="p-l-25 p-r-30 p-lr-0-lg">
                                <div class="wrap-slick3 flex-sb flex-w">
                                    <div class="wrap-slick3-dots"></div>
                                    <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                    <div class="slick3 gallery-lb">
                                        @foreach(getAllProductImages($product->images) as $image)
                                            <div class="item-slick3" data-thumb="{{$image}}">
                                                <div class="wrap-pic-w pos-relative">
                                                    <img src="{{$image}}" alt="IMG-PRODUCT">
                                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{$image}}">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-5 p-b-30">
                            <div class="p-r-50 p-t-5 p-lr-0-lg">
                                <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                    {{$product->name}}
                                </h4>
                                <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                    {{$product->sku}}
                                </h4>

                                <span class="mtext-106 cl2">
                                    {{presentPrice($product->final_price)}}
                                </span>

                                <p class="stext-102 cl3 p-t-23">
                                    {!! $product->description !!}
                                </p>

                                <!--  -->
                                @if(!$product->in_stock || !($product->quantity > 0))
                                    <p>Hết hàng</p>
                                @else
                                    <form action="" class="form-cart">
                                        <div class="flex-w p-b-10">
                                            <div class="flex-w flex-m">
                                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>
                                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" value="1">
                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" id="product_id" value="{{$product->id}}">
                                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                                    Thêm vào giỏ hàng
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                 @endif
                            </div>
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
                                        <p class="stext-102 cl6">
                                            {!! $product->details !!}
                                        </p>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="information" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                            <ul class="p-lr-28 p-lr-15-sm">
                                                @foreach($product->attributeValue as $attr)
                                                    @if($attr->attribute->status == 1)
                                                    <li class="flex-w flex-t p-b-7">
                                                        <span class="stext-102 cl3 size-205">{{$attr->attribute->name}}</span>
                                                        <span class="stext-102 cl6 size-206">{{$attr->name}}</span>
                                                    </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!--
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
				Danh mục: @foreach($product->categories as $category){{$category->name}} @endforeach


			</span>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('javascript')

@endsection
