<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="p-b-45">
            <h3 class="ltext-106 cl5 txt-center">
                Danh mục sản phẩm
            </h3>
        </div>
        <div class="row">
            @foreach(StoreManager::getCategories() as $category)

            <div class="col-md-6 col-xl-4 p-b-30 ">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w banner-wrapper-image">
                    <img src="{{getCategoryImage($category->image)}}" alt="IMG-BANNER">

                    <a href="{{route('catalog.category', ['slug' => $category->slug])}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									{{$category->name}}
								</span>

                                {{--<span class="block1-info stext-102 trans-04">--}}
                                        {{--{{$category->description}}--}}
                                {{--</span>--}}
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Xem thêm
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>