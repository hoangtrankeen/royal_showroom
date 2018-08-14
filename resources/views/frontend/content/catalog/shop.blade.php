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

    <section class="bg-img1 txt-center p-lr-15 p-tb-92 banner-category">
        <h2 class="ltext-105 cl0 txt-center">
            {{ $breadname}}
        </h2>
    </section>

    <div class="container flex-top">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('home')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            @if($breadname)
                <span class="stext-109 cl4">{{ $breadname}}</span>
            @else
                <span class="stext-109 cl4">Lọc và Tìm kiếm</span>
            @endif
        </div>
    </div>

    <div class="bg0 m-t-20 p-b-140">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3 p-b-50 side-bar-shop">
                    <div class="leftbar p-r-20 p-r-0-sm">
                        <div class="wrap-title">
                            <h4 class="mtext-112 cl2 p-b-23 p-t-20">
                                Danh mục sản phẩm
                            </h4>
                        </div>
                        <nav id="main-nav">
                            {{RenderHtml::showLeftCategories()}}
                        </nav>

                        <div class="m-t-30">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Combo Nổi bật
                            </h4>
                            <ul>
                                @foreach(StoreManager::getFeaturedProducts() as $product)
                                    <li class="flex-w flex-t p-b-30">
                                        <a href="{{route('catalog.product',['slug'=>$product->slug])}}" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                            <img src="{{getProductImage($product->images)}}" alt="PRODUCT" width="90" height="100">
                                        </a>
                                        <div class="size-215 flex-col-t p-t-8">
                                            <a href="{{route('catalog.product',['slug'=>$product->slug])}}" class="stext-116 cl8 hov-cl1 trans-04">
                                                {{$product->name}}
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-9 p-b-50">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="flex-w flex-sb-m p-b-20 ">
                                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                                </div>
                                <div class="flex-w flex-c-m m-tb-10">
                                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                                        Bộ Lọc
                                    </div>
                                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                                        Tìm kiếm
                                    </div>
                                </div>

                                <!-- Search product -->
                                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                                    <div class="bor8 dis-flex p-l-15">
                                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                        <form id="content" action="{{route('catalog.search')}}" method="get">
                                            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="q" placeholder="Nhập từ khóa...">
                                        </form>
                                    </div>
                                </div>

                                <!-- Filter -->
                                <div class="dis-none panel-filter w-full p-t-10">
                                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                                        <div class="filter-col1 p-r-15 p-b-27">
                                            <div class="mtext-102 cl2 p-b-15">
                                                Lọc theo
                                            </div>

                                            <ul>
                                                <li class="p-b-6">
                                                    <a href="{{url()->current() .'?sort=featured'}}" class="filter-link stext-106 trans-04 {{request()->get('sort') ==  'featured' ? 'filter-link-active' : ''}}">
                                                        Nổi bật
                                                    </a>
                                                </li>

                                                <li class="p-b-6">
                                                    <a href="{{url()->current() .'?sort=price_asc'}}" class="filter-link stext-106 trans-04 {{request()->get('sort') ==  'price_asc' ? 'filter-link-active' : ''}}">
                                                        Giá thấp đến cao
                                                    </a>
                                                </li>

                                                <li class="p-b-6">
                                                    <a href="{{url()->current().'?sort=price_desc'}}" class="filter-link stext-106 trans-04 {{request()->get('sort') ==  'price_desc' ? 'filter-link-active' : ''}}">
                                                        Giá cao đến thấp
                                                    </a>
                                                </li>
                                                <li class="p-b-6">
                                                    <a href="{{url()->current().'?sort=name_asc'}}" class="filter-link stext-106 trans-04 {{request()->get('sort') ==  'name_asc' ? 'filter-link-active' : ''}}">
                                                        Tên từ A - Z
                                                    </a>
                                                </li>
                                                <li class="p-b-6">
                                                    <a href="{{url()->current().'?sort=name_desc'}}" class="filter-link stext-106 trans-04  {{request()->get('sort') ==  'name_desc' ? 'filter-link-active' : ''}}">
                                                        Tên từ Z - A
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        @foreach(StoreManager::getAvailableAttributes() as $attribute)
                                            <div class="filter-col3 p-r-15 p-b-27">
                                                <div class="mtext-102 cl2 p-b-15">
                                                    {{$attribute->name}}
                                                </div>
                                                <ul>
                                                    @foreach($attribute->attributeValue as $val)
                                                        <li class="p-b-6">
                                                            <a href="{{url()->current().'?attribute='.$val->id}}" class="filter-link stext-106 trans-04 {{request()->get('attribute') ==  $val->id ? 'filter-link-active' : ''}}" >
                                                                {{$val->name}}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @forelse($products as $product)
                            <div class="col-sm-6 col-md-6 col-lg-4 p-b-35">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <img src="{{getProductImage($product->images)}}" alt="IMG-PRODUCT">
                                        <a href="#" data-value="{{$product->slug}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                            Xem nhanh
                                        </a>
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="{{route('catalog.product',['slug' => $product->slug])}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{$product->name}}
                                            </a>
                                            <span class="stext-105 cl3">{{presentPrice($product->final_price)}}</span>
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
                        @empty
                            <h5 class="p-l-15">Không có sản phẩm nào tại mục này</h5>
                        @endforelse
                    </div>
                    @if(isset($search_page) )
                        {{ $products->links('frontend.partials.pager.pager') }}
                    @else
                        {{ $products->appends(request()->query())->links('frontend.partials.pager.pager') }}
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    <!-- SmartMenus jQuery init -->
    <script type="text/javascript">
        $(function() {
            $('#main-smartmenu').smartmenus({
                mainMenuSubOffsetX: 10,
                mainMenuSubOffsetY: 0,
                subMenusSubOffsetX: 10,
                subMenusSubOffsetY: 0
            });
        });
    </script>
@endsection
