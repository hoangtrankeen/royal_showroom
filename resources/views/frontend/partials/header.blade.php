<div class="container-menu-desktop">
    <!-- Topbar -->
    <div class="top-bar">
        <div class="content-topbar flex-sb-m h-full container">
            <div class="left-top-bar">
                Free shipping for standard order over $100
            </div>

            <div class="right-top-bar flex-w h-full">
                <a href="#" class="flex-c-m trans-04 p-lr-25">
                    Help & FAQs
                </a>

                <a href="#" class="flex-c-m trans-04 p-lr-25">
                    My Account
                </a>

                <a href="#" class="flex-c-m trans-04 p-lr-25">
                    EN
                </a>

                <a href="#" class="flex-c-m trans-04 p-lr-25">
                    USD
                </a>
            </div>
        </div>
    </div>
    <div class="menu-container wrap-menu-desktop">
        <div class="limiter-menu-desktop container">
            <a href="#" class="logo">
                <img src="{{asset('frontend/images/icons/logo-01.png')}}" alt="IMG-LOGO">
            </a>
            <div class="menu menu-desktop ">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="javaScript:void(0);">Danh mục sản phẩm</a>
                        <ul>
                            @foreach($share_parent_categories as $parent)
                                <li>
                                    <a href="{{route('catalog.category',$parent->slug)}}">{{$parent->name}}</a>
                                    @if(count($parent->children))
                                        <ul>
                                            @foreach($parent->children as $child)
                                                <li><a href="{{route('catalog.category',$child->slug)}}">{{$child->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#">Bài viết</a>
                        <ul>
                            <li><a href="#">Today</a></li>
                            <li><a href="#">Calendar</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                    </li>
                    <li><a href="/">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="/">Liên hệ</a>
                    </li>
                </ul>
            </div>
            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{Cart::count()}}">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div>
            <!-- Modal Search -->
            <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
                <div class="container-search-header">
                    <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                        <img src="{{asset('frontend/images/icons/icon-close2.png')}}" alt="CLOSE">
                    </button>
                    <form class="wrap-search-header flex-w p-l-15" action="{{route('catalog.search')}}">
                        <button class="flex-c-m trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                        <input class="plh3" type="text" name="q" placeholder="Nhập từ khóa...">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Header Mobile -->
<div class="wrap-header-mobile">
    <!-- Logo moblie -->
    <div class="logo-mobile">
        <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
    </div>

    <!-- Icon header -->
    <div class="wrap-icon-header flex-w flex-r-m m-r-15">
        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
            <i class="zmdi zmdi-search"></i>
        </div>

        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
            <i class="zmdi zmdi-shopping-cart"></i>
        </div>

        <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
            <i class="zmdi zmdi-favorite-outline"></i>
        </a>
    </div>

    <!-- Button show menu -->
    <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
    </div>
</div>

<!-- Menu Mobile -->
<div class="menu-mobile">
    <nav class="main-nav" role="navigation">
        <!-- Sample menu definition -->
        <ul id="main-menu" class="sm sm-blue">
            <li>
                <a href="">Danh mục sản phẩm</a>
                {{RenderHtml::showMobileCategories()}}
            </li>
            <li><a href="">Khuyến mại</a></li>
            <li><a href="">Giới thiệu</a></li>
            <li><a href="">Liên hệ</a></li>
        </ul>

    </nav>
</div>

<!-- Modal Search -->
<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
    <div class="container-search-header">
        <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
            <img src="{{asset("frontend/images/icons/icon-close2.png")}}" alt="CLOSE">
        </button>

        <form class="wrap-search-header flex-w p-l-15" action="{{route('catalog.search')}}">
            <button class="flex-c-m trans-04">
                <i class="zmdi zmdi-search"></i>
            </button>
            <input class="plh3" type="text" name="q" placeholder="Nhập từ khóa...">
        </form>
    </div>
</div>