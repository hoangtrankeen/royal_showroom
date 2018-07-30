@extends('frontend/layouts/shop')

@section('title', 'Royal')

@section('css')
    <!--=======================================Leftnav Style=================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/web/smartmenu/css/sm-core-css.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/web/smartmenu/css/sm-mint/sm-mint.css')}}">

@endsection

@section('content')
    @if(Session::has('topic'))
        @php
            $bread =  Session::get('topic');
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
                <span class="stext-109 cl4">{{$post->title}}</span>
            @else
                <span class="stext-109 cl4">{{$post->title}}</span>
            @endif
        </div>
    </div>

    <!-- Content page -->
    <section class="bg0 p-t-52 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!--  -->
                        <div class="wrap-pic-w how-pos5-parent">
                            <img src="{{getPostImgFeatured($post->image)}}" alt="IMG-BLOG">

                            <div class="flex-col-c-m size-123 bg9 how-pos5">
								<span class="ltext-107 cl2 txt-center">
									{{$post->created_at->format('d')}}
								</span>

                                <span class="stext-109 cl3 txt-center">
									{{$post->created_at->format('M Y')}}
								</span>
                            </div>
                        </div>

                        <div class="p-t-32">
							<span class="flex-w flex-m stext-111 cl2 p-b-19">

								<span>
									{{presentDateFormat($post->created_at)}}
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								{{--<span>--}}
									{{--StreetStyle, Fashion, <Couple></Couple>--}}
									{{--<span class="cl12 m-l-4 m-r-6">|</span>--}}
								{{--</span>--}}

							</span>

                            <h4 class="ltext-109 cl2 p-b-28">
                                {{$post->title}}
                            </h4>

                            <p class="stext-117 cl6 p-b-26">
                                {!! $post->content !!}
                            </p>

                        </div>

                        <div class="flex-w flex-t p-t-16">
							<span class="size-216 stext-116 cl8 p-t-4">
								Tags
							</span>

                            <div class="flex-w size-217">
                                @foreach($post->tags as $tag)
                                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                     {{$tag->name}}
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!--
                        <div class="p-t-40">
                            <h5 class="mtext-113 cl2 p-b-12">
                                Leave a Comment
                            </h5>

                            <p class="stext-107 cl6 p-b-40">
                                Your email address will not be published. Required fields are marked *
                            </p>

                            <form>
                                <div class="bor19 m-b-20">
                                    <textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="cmt" placeholder="Comment..."></textarea>
                                </div>

                                <div class="bor19 size-218 m-b-20">
                                    <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Name *">
                                </div>

                                <div class="bor19 size-218 m-b-20">
                                    <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="email" placeholder="Email *">
                                </div>

                                <div class="bor19 size-218 m-b-30">
                                    <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="web" placeholder="Website">
                                </div>

                                <button class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04">
                                    Post Comment
                                </button>
                            </form>
                        </div>-->
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <!--<div class="bor17 of-hidden pos-relative">
                            <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">

                            <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </div>-->

                        <!--<div class="p-t-55">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Categories
                            </h4>

                            <ul>
                                <li class="bor18">
                                    <a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                        Fashion
                                    </a>
                                </li>

                                <li class="bor18">
                                    <a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                        Beauty
                                    </a>
                                </li>

                                <li class="bor18">
                                    <a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                        Street Style
                                    </a>
                                </li>

                                <li class="bor18">
                                    <a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                        Life Style
                                    </a>
                                </li>

                                <li class="bor18">
                                    <a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                        DIY & Crafts
                                    </a>
                                </li>
                            </ul>
                        </div>-->

                        <div class="">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Combo Nổi bật
                            </h4>

                            <ul>
                               @foreach(ManagerCatalog::getFeaturedProduct() as $product)
                                    <li class="flex-w flex-t p-b-30">
                                        <a href="{{route('catalog.product',['slug'=>$product->slug])}}" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                            <img src="{{getFeaturedImageProduct($product->image)}}" alt="PRODUCT" width="90" height="100">
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

                        <!--<div class="p-t-55">
                            <h4 class="mtext-112 cl2 p-b-20">
                                Archive
                            </h4>

                            <ul>
                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											July 2018
										</span>

                                        <span>
											(9)
										</span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											June 2018
										</span>

                                        <span>
											(39)
										</span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											May 2018
										</span>

                                        <span>
											(29)
										</span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											April  2018
										</span>

                                        <span>
											(35)
										</span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											March 2018
										</span>

                                        <span>
											(22)
										</span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											February 2018
										</span>

                                        <span>
											(32)
										</span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											January 2018
										</span>

                                        <span>
											(21)
										</span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											December 2017
										</span>

                                        <span>
											(26)
										</span>
                                    </a>
                                </li>
                            </ul>
                        </div>-->

                        <div class="p-t-50">
                            <h4 class="mtext-112 cl2 p-b-27">
                                Tags
                            </h4>

                            <div class="flex-w m-r--5">
                                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Fashion
                                </a>

                                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Lifestyle
                                </a>

                                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Denim
                                </a>

                                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Streetstyle
                                </a>

                                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Crafts
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('javascript')
    <!--Lefnav-->
    <script src="{{asset('frontend/web/smartmenu/js/jquery.smartmenus.js')}}"></script>

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
