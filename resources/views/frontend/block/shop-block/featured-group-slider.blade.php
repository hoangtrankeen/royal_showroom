<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
        <div class="p-b-45">
            <h3 class="ltext-106 cl5 txt-center">
                Combo nổi bật
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
                @foreach(ManagerCatalog::getFeaturedProduct(6) as $product)
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{{getFeaturedImageProduct($product->image)}}" alt="IMG-PRODUCT">
                                <a href="{{route('catalog.product',['slug'=>$product->slug])}}" data-value="{{$product->slug}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                    Xem chi tiết
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{route('catalog.product',['slug' => $product->slug])}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{$product->name}}
                                    </a>

                                    <span class="stext-105 cl3">
										{{--{{presentPrice($product->price)}}--}}
									</span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04" src="{{asset('frontend/images/icons/icon-heart-01.png')}}" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{asset('frontend/images/icons/icon-heart-02.png')}}" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>