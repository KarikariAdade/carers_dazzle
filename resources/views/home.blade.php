@extends('layouts.website')
@section('content')
    <style>
        .intro-slide{
            position: relative !important;
        }
        .intro-slide .container::after{
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            background: rgba(0,0,0,.5) !important;
        }
        @media(max-width: 700px){
            .intro-slider-container, .intro-slide{
                min-height: 84vh !important;
            }
        }
        @media(min-width: 400px){
            .intro-slider-container, .intro-slide{
                min-height: 76vh !important;
            }
        }
         #categoryBanner{
             position:relative;
             border-radius: 10px;
         }

        #categoryBanner:hover::after{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,.5);
            border-radius: 10px;
        }
        #bannerContent h3{
            position: relative;
            z-index: 3;
        }
    </style>
        <div class="intro-slider-container mb-3 mb-lg-5">
            <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{"dots": true, "nav": false}'>



                @if($promotional_banners->count() > 0)
                    @foreach($promotional_banners as $banner)
                        <div class="intro-slide" style="background-image: url('{{ asset($banner->banner) }}'); background-position: center; background-size: 100%;background-repeat:no-repeat;">
                            <div class="container">
                                <div class="intro-content text-center">
                                    <h3 class="intro-subtitle cross-txt" style="color: #c96;">{{ $banner->header_message }}</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title text-white">{{ $banner->content_message }}</h1><!-- End .intro-title -->
                                    <div class="intro-text text-white">{{ $banner->footer_message }}</div><!-- End .intro-text -->
                                    <div class="intro-action cross-txt">
                                        <a href="{{ !empty($banner->product_id) ? $banner->getProducts()->first()->generateRoute() : route('website.shop.index') }}" class="btn btn-outline-white">
                                            <span>Discover More</span>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- End .intro-content -->
                        </div><!-- End .intro-slide -->
{{--                <div class="intro-slide" style="background-image: url('website_assets/images/demos/demo-18/slider/slide-1.jpg');">--}}
{{--                    <div class="container">--}}
{{--                        <div class="intro-content text-center">--}}
{{--                            <h3 class="intro-subtitle cross-txt" style="color: #c96;">SEASONAL PICKS</h3><!-- End .h3 intro-subtitle -->--}}
{{--                            <h1 class="intro-title text-white">Summer Sale</h1><!-- End .intro-title -->--}}
{{--                            <div class="intro-text text-white">up to 70% off</div><!-- End .intro-text -->--}}
{{--                            <div class="intro-action cross-txt">--}}
{{--                                <a href="category.html" class="btn btn-outline-white">--}}
{{--                                    <span>Discover More</span>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div><!-- End .intro-content -->--}}
{{--                </div><!-- End .intro-slide -->--}}
                    @endforeach
                @else

                <div class="intro-slide" style="background-image: url('website_assets/images/demos/demo-18/slider/slide-2.jpg');">
                    <div class="container">
                        <div class="intro-content text-center">
                            <h3 class="intro-subtitle text-primary cross-txt" style="color: #c96;">Women's Accessories</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white">Save up to</h1><!-- End .intro-title -->
                            <div class="intro-text text-white">30-50% off</div><!-- End .intro-text -->
                            <div class="intro-action cross-txt">
                                <a href="#" class="btn btn-outline-white">
                                    <span>Discover More</span>
                                </a>
                            </div>
                        </div>
                    </div><!-- End .intro-content -->
                </div><!-- End .intro-slide -->
                @endif
            </div><!-- End .intro-slider owl-carousel owl-simple -->

            <span class="slider-loader text-white"></span><!-- End .slider-loader -->
        </div><!-- End .intro-slider-container -->

    @if(!empty($featured_categories))
        <div class="container banners">
            <div class="row">
                @foreach($featured_categories as $featured_category)
                <div class="col-sm-6 col-lg-3 col-4">
                    <div class="banner banner-hover" id="categoryBanner">
                        <a href="#">
                            <img src="{{ asset($featured_category->image) }}" alt="Banner" style="border-radius: 10px;">
                        </a>

                        <div class="banner-content" id="bannerContent">
                            <h3 class="banner-title text-white"><a href="{{ $featured_category->generateCategoryRoute() }}">{{ $featured_category->name }}</a></h3><!-- End .banner-title -->
                            <a href="{{ $featured_category->generateCategoryRoute() }}" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-sm-6 -->
                    @endforeach
            </div><!-- End .row -->
        </div><!-- End .container -->
        @endif

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h2 class="title">Recent Arrivals</h2><!-- End .title -->
                    <div class="products-container mb-7">
                        <div class="row justify-content-center">
                            @if($arrivals->count() > 0)
                                @foreach($arrivals as $arrival)
                            <div class="col-6 col-md-4">
                                <div class="product product-4">
                                    <figure class="product-media">
                                        <a href="{{ route('website.shop.index') }}">
                                            @if(!empty($arrival->getPicture))
                                            <img src="{{ asset($arrival->getSingleImage()) }}" style="" alt="Product image" class="product-image">
                                            <img src="{{ asset($arrival->getLastImage()) }}" style="" alt="Product image" class="product-image-hover">
{{--                                                    @endforeach--}}
                                            @endif
                                        </a>

                                        <div class="product-action-vertical">
                                            @if(auth()->guard('web')->check())
                                            <a href="{{ route('customer.wishlist.store', $arrival->id) }}" class="btn-product-icon btn-wishlist btn-expandable addToWishlist"><span>add to wishlist</span></a>
                                            @endif
                                                {{--                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>--}}
                                        </div><!-- End .product-action -->

                                        <div class="product-action">
                                            <a href="{{ route('website.cart.add', $arrival->id) }}" class="btn-product btn-cart addToCartBtn"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="{{ $arrival->getCategory->generateCategoryRoute() }}">{{ $arrival->getCategory->name }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ $arrival->generateRoute() }}">{{ $arrival->name }}</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            {{ $arrival->convertCurrency() }}
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-md-4 -->
                                @endforeach
                            @endif
                        </div><!-- End .row -->

                        <div class="more-container text-center mt-0 mb-0">
                            <a href="{{ route('website.shop.index') }}" class="btn btn-outline-primary-2 btn-more">
                                <span>View more Products</span>
                            </a>
                        </div><!-- End .more-container -->
                    </div><!-- End .products -->
                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar sidebar-home">
                        <div class="row">
                            <div class="col-sm-6 col-lg-12">
                                <div class="widget widget-products">
                                    <h4 class="widget-title">Best Selling</h4>
                                    <!-- End .widget-title -->

                                    <div class="products">
                                        @foreach($best_selling as $item)
                                        <div class="product product-sm">
                                            <figure class="product-media">
                                                <a href="{{ route('website.shop.index') }}">
                                                    <img src="{{ asset($item->getSingleImage()) }}" alt="Product image" class="product-image">
                                                </a>
                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="{{ $item->getCategory->generateCategoryRoute() }}">{{ $item->getCategory->name }}</a>
                                                </div><!-- End .product-cat -->
                                                <h5 class="product-title"><a href="{{ $item->generateRoute() }}">{{ $item->name }}</a></h5><!-- End .product-title -->
                                                <div class="product-price">
                                                    <span class="new-price">Now {{ $item->convertCurrency() }}</span>
{{--                                                    <span class="old-price">Was $32.99</span>--}}
                                                </div><!-- End .product-price -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product product-sm -->
                                        @endforeach

                                    </div><!-- End .products -->
                                </div><!-- End .widget widget-products -->
                            </div><!-- End .col-sm-6 col-lg-12 -->


{{--                            <div class="col-sm-6 col-lg-12">--}}
{{--                                <div class="widget widget-banner">--}}
{{--                                    <div class="banner banner-overlay">--}}
{{--                                        <a href="#">--}}
{{--                                            <img src="website_assets/images/demos/demo-18/banners/banner-5.jpg" alt="Banner">--}}
{{--                                        </a>--}}

{{--                                        <div class="banner-content">--}}
{{--                                            <h4 class="banner-subtitle"><a href="#">Spring 2019</a></h4><!-- End .banner-title -->--}}
{{--                                            <h3 class="banner-title"><a href="#">SAVE UP TO <br>50% OFF</a></h3><!-- End .banner-title -->--}}
{{--                                            <a href="#" class="banner-link">Shop Now</a>--}}
{{--                                        </div><!-- End .banner-content -->--}}
{{--                                    </div><!-- End .banner -->--}}
{{--                                </div><!-- End .widget widget-banner -->--}}
{{--                            </div><!-- End .col-sm-6 col-lg-12 -->--}}
                            <div class="col-sm-6 col-lg-12">
                                <div class="widget widget-products">
                                    <h4 class="widget-title">Most Viewed</h4><!-- End .widget-title -->
                                    <div class="products">
                                        @foreach($most_viewed as $item)
                                            <div class="product product-sm">
                                                <figure class="product-media">
                                                    <a href="{{ route('website.shop.index') }}">
                                                        <img src="{{ asset($item->getSingleImage()) }}" alt="Product image" class="product-image">
                                                    </a>
                                                </figure>

                                                <div class="product-body">
                                                    <div class="product-cat">
                                                        <a href="{{ $item->getCategory->generateCategoryRoute() }}">{{ $item->getCategory->name }}</a>
                                                    </div><!-- End .product-cat -->
                                                    <h5 class="product-title"><a href="{{ $item->generateRoute() }}">{{ $item->name }}</a></h5><!-- End .product-title -->
                                                    <div class="product-price">
                                                        <span class="new-price">Now {{ $item->convertCurrency() }}</span>
                                                        {{--                                                    <span class="old-price">Was $32.99</span>--}}
                                                    </div><!-- End .product-price -->
                                                </div><!-- End .product-body -->
                                            </div><!-- End .product product-sm -->
                                        @endforeach

                                    </div><!-- End .products -->
                                </div><!-- End .widget widget-products -->
                            </div><!-- End .col-sm-6 col-lg-12 -->
                        </div><!-- End .row -->
                    </div><!-- End .sidebar sidebar-home -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->

            <hr class="mt-0 mb-4">
            <h2 class="title text-center brands">Shop by Brands</h2><!-- End .title -->

            <div class="owl-carousel mt-3 mb-4 owl-simple" data-toggle="owl"
                 data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 30,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "420": {
                                "items":3
                            },
                            "600": {
                                "items":4
                            },
                            "900": {
                                "items":4
                            },
                            "1024": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                @foreach($brands as $brand)
                <a href="{{ $brand->generateBrandRoute() }}" class="brand brand-slider">
                   <h4>{{ $brand->name }}</h4>
                </a>
                @endforeach

{{--                <a href="#" class="brand">--}}
{{--                    <img src="website_assets--}}
{{--/images/brands/2.png" alt="Brand Name">--}}
{{--                </a>--}}
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->

        <div class="bg-lighter pt-5 pb-5">
            <div class="container">
                <div class="heading text-center">
                    <h2 class="title instagram">Let Us Inspire You On Instagram</h2><!-- End .title -->
                    <p class="title-desc">Donec nec justo eget felis facilisis fermentum.</p><!-- End .title-desc -->
                </div><!-- End .heading -->

                <div class="owl-carousel owl-simple mb-3" data-toggle="owl"
                     data-owl-options='{
                            "nav": false,
                            "dots": false,
                            "items": 5,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "360": {
                                    "items":2
                                },
                                "600": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":5
                                }
                            }
                        }'>
                    <div class="instagram-feed">
                        <img src="website_assets
/images/demos/demo-18/instagram/1.jpg" alt="img">

                        <div class="instagram-feed-content">
                            <a href="#"><i class="icon-heart-o"></i>466</a>
                            <a href="#"><i class="icon-comments"></i>65</a>
                        </div><!-- End .instagram-feed-content -->
                    </div><!-- End .instagram-feed -->

                    <div class="instagram-feed">
                        <img src="website_assets
/images/demos/demo-18/instagram/2.jpg" alt="img">

                        <div class="instagram-feed-content">
                            <a href="#"><i class="icon-heart-o"></i>280</a>
                            <a href="#"><i class="icon-comments"></i>22</a>
                        </div><!-- End .instagram-feed-content -->
                    </div><!-- End .instagram-feed -->

                    <div class="instagram-feed">
                        <img src="website_assets
/images/demos/demo-18/instagram/3.jpg" alt="img">

                        <div class="instagram-feed-content">
                            <a href="#"><i class="icon-heart-o"></i>123</a>
                            <a href="#"><i class="icon-comments"></i>10</a>
                        </div><!-- End .instagram-feed-content -->
                    </div><!-- End .instagram-feed -->
                    <div class="instagram-feed">
                        <img src="website_assets
/images/demos/demo-18/instagram/4.jpg" alt="img">

                        <div class="instagram-feed-content">
                            <a href="#"><i class="icon-heart-o"></i>290</a>
                            <a href="#"><i class="icon-comments"></i>0</a>
                        </div><!-- End .instagram-feed-content -->
                    </div><!-- End .instagram-feed -->
                    <div class="instagram-feed">
                        <img src="website_assets
/images/demos/demo-18/instagram/5.jpg" alt="img">

                        <div class="instagram-feed-content">
                            <a href="#"><i class="icon-heart-o"></i>582</a>
                            <a href="#"><i class="icon-comments"></i>98</a>
                        </div><!-- End .instagram-feed-content -->
                    </div><!-- End .instagram-feed -->
                </div><!-- End .owl-carousel -->

                <div class="more-container text-center">
                    <a href="#" class="btn btn-outline-primary-2 btn-more">@CarersDazzle Instagram</a>
                </div><!-- End .more-container -->
            </div><!-- End .container -->
        </div><!-- End .bg-lighter pt-5 pb-5 -->

@endsection
