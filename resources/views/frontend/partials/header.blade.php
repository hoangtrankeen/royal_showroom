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
                            @foreach($parent_category_list as $parent)
                            <li><a href="{{route('catalog.category',$parent->slug)}}">{{$parent->name}}</a>
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
                    <li><a href="#">News</a>
                        <ul>
                            <li><a href="#">Today</a></li>
                            <li><a href="#">Calendar</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                    </li>
                    <li><a href="/">Contact</a>
                        <ul>
                            <li><a href="#">School</a>
                                <ul>
                                    <li><a href="#">Lidership</a></li>
                                    <li><a href="#">History</a></li>
                                    <li><a href="#">Locations</a></li>
                                    <li><a href="#">Careers</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Study</a>
                                <ul>
                                    <li><a href="#">Undergraduate</a></li>
                                    <li><a href="#">Masters</a></li>
                                    <li><a href="#">International</a></li>
                                    <li><a href="#">Online</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Study</a>
                                <ul>
                                    <li><a href="#">Undergraduate</a></li>
                                    <li><a href="#">Masters</a></li>
                                    <li><a href="#">International</a></li>
                                    <li><a href="#">Online</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Empty sub</a></li>
                        </ul>
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