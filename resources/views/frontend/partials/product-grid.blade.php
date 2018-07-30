<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Product Overview
            </h3>
        </div>

        {{--<div class="flex-w flex-sb-m p-b-52">--}}
            {{--<div class="flex-w flex-l-m filter-tope-group m-tb-10">--}}

                {{--@foreach($categories as $category)--}}
                    {{--<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{$category->slug}}">--}}
                        {{--{{$category->name}}--}}
                    {{--</button>--}}
                {{--@endforeach--}}
            {{--</div>--}}

            {{--@include('frontend/partials/filter')--}}
        {{--</div>--}}

        <div class="row ">

            @foreach($categories as $category)
                <div class="col-md-6 col-xl-4 p-b-30 ">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{getCategoryImgFeatured($category->image)}}" alt="IMG-BANNER">

                        <a href="product.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									{{$category->name}}
								</span>

                                <span class="block1-info stext-102 trans-04">
									Spring 2018
								</span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Xem thêm
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        @foreach($category['products'] as $product)
                            <div class="col-sm-6 col-md-4 col-lg-3 ">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <img src="{{getFeaturedImageProduct($product->image)}}" alt="IMG-PRODUCT">

                                        <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                            Chi tiết
                                        </a>
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{$product->name}}
                                            </a>

                                            {{--<span class="stext-105 cl3">--}}
                                            {{--{{presentPrice($product->price)}}--}}
                                            {{--</span>--}}
                                        </div>

                                        <div class="block2-txt-child2 flex-r p-t-3">
                                            <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                                <img class="icon-heart1 dis-block trans-04" src="{{asset('frontend/images/icons/icon-heart-01.png')}}" alt="ICON">
                                                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{('frontend/images/icons/icon-heart-02.png')}}" alt="ICON">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>


            @endforeach
        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Load More
            </a>
        </div>
    </div>
</section>