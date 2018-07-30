<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Giỏ hàng
				</span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full side-cart-wrapper">
                <li class="header-cart-item flex-w flex-t m-b-12 side-cart-item clearfix" id="side-cart-sample">
                    <div class="header-cart-item-img side-cart-wrap">
                        <img src="images/item-cart-01.jpg" class="side-cart-img" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04 side-cart-name">
                            White Shirt Pleat
                        </a>

                        <span class="header-cart-item-info side-cart-price">
								<span class="qty"></span> x <span class="price"></span>
						</span>
                    </div>


                </li>
                @forelse(Cart::content() as $item)
                    <li class="header-cart-item flex-w flex-t m-b-12 side-cart-item " id="side-cart-item-{{$item->rowId}}">
                        <div class="header-cart-item-img">
                            <img src="{{asset(getProductImage($item->model->images))}}" class="side-cart-img" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="{{ route('catalog.product',['slug' => $item->model->slug]) }}" class="header-cart-item-name m-b-18 hov-cl1 trans-04 side-cart-name">
                                {{ $item->model->name }}
                            </a>
                            <span class="header-cart-item-info side-cart-price">
								<span class="qty">{{$item->qty}}</span> x <span class="price">{{ presentPrice($item->model->price) }}</span>
						    </span>
                        </div>
                    </li>
                @empty
                    <h4 class="header-cart-total w-full p-b-40 side-cart-empty">Hiện tại không có sản phẩm nào trong giỏ hàng</h4>
                @endforelse
            </ul>

            @php
                $hide = (Cart::count() == 0 )  ? ' side-cart-hide' : '';
            @endphp

            <div class="w-full side-cart-action {{$hide}} ">
                <div class="header-cart-total w-full p-tb-40 side-cart-total">
                    Tổng giỏ hàng: <span id="value-total">{{presentPrice(Cart::total())}}</span>
                </div>

                <div class="header-cart-buttons flex-w w-full ">
                    <a href="{{route('cart.index')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Giỏ hàng
                    </a>

                    <a href="{{route("checkout")}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Thanh toán
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>