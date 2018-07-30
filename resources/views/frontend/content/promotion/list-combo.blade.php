@extends('frontend/layouts/shop')

@section('title', 'Royal')

@section('css')
@endsection

@section('content')

    <div class="bg0 m-t-20 p-b-140 flex-change">
        <div class="container">
            <div class="flex-w flex-sb-m">
                <div class="flex-w flex-l-m filter-tope-group">
                    <div class="bread-crumb flex-w p-l-25 p-r-15 p-lr-0-lg">
                        <a href="{{route('home')}}" class="stext-109 cl8 hov-cl1 trans-04">
                            Trang chủ
                            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                        </a>
                        <span class="stext-109 cl4">Bộ sưu tập</span>
                    </div>
                </div>
            </div>
            <!-- Product Detail -->
            <section class="sec-product-detail bg0 p-t-65 p-b-60">
                <div class="container">
                    <div class="combo-gallery">
                        @foreach($combos as $combo)
                            <a href="{{asset(getFeaturedImageProduct($combo->image))}}" title="{{$combo->name}}"><img src="{{asset(getFeaturedImageProduct($combo->image))}}" width="205" height="175"></a>
                        @endforeach
                    </div>
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
