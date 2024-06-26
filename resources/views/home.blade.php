@extends('layouts.website')
@section('content')
        <div class="intro-slider-container mb-3 mb-lg-5">
            <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{"dots": true, "nav": false}'>
                <div class="intro-slide" style="background-image: url('website_assets/images/demos/demo-18/slider/slide-1.jpg');">
                    <div class="container">
                        <div class="intro-content text-center">
                            <h3 class="intro-subtitle cross-txt" style="color: #c96;">SEASONAL PICKS</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white">Summer Sale</h1><!-- End .intro-title -->
                            <div class="intro-text text-white">up to 70% off</div><!-- End .intro-text -->
                            <div class="intro-action cross-txt">
                                <a href="category.html" class="btn btn-outline-white">
                                    <span>Discover More</span>
                                </a>
                            </div>
                        </div>
                    </div><!-- End .intro-content -->
                </div><!-- End .intro-slide -->

                <div class="intro-slide" style="background-image: url('website_assets/images/demos/demo-18/slider/slide-2.jpg');">
                    <div class="container">
                        <div class="intro-content text-center">
                            <h3 class="intro-subtitle text-primary cross-txt" style="color: #c96;">Women's Accessories</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white">Save up to</h1><!-- End .intro-title -->
                            <div class="intro-text text-white">30-50% off</div><!-- End .intro-text -->
                            <div class="intro-action cross-txt">
                                <a href="category.html" class="btn btn-outline-white">
                                    <span>Discover More</span>
                                </a>
                            </div>
                        </div>
                    </div><!-- End .intro-content -->
                </div><!-- End .intro-slide -->
            </div><!-- End .intro-slider owl-carousel owl-simple -->

            <span class="slider-loader text-white"></span><!-- End .slider-loader -->
        </div><!-- End .intro-slider-container -->

        <div class="container banners">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner banner-hover">
                        <a href="#">
                            <img src="website_assets/images/demos/demo-18/banners/banner-1.jpg" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h3 class="banner-title text-white"><a href="#">Sweatshirts & Hoodies</a></h3><!-- End .banner-title -->
                            <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-6 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="banner banner-hover">
                        <a href="#">
                            <img src="website_assets/images/demos/demo-18/banners/banner-2.jpg" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h3 class="banner-title text-white"><a href="#">Men’s Jacket</a></h3><!-- End .banner-title -->
                            <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="banner banner-hover">
                        <a href="#">
                            <img src="website_assets/images/demos/demo-18/banners/banner-3.jpg" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h3 class="banner-title text-white"><a href="#">Women’s jackets</a></h3><!-- End .banner-title -->
                            <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->

                    <div class="banner banner-hover">
                        <a href="#">
                            <img src="website_assets/images/demos/demo-18/banners/banner-4.jpg" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h3 class="banner-title text-white"><a href="#">Accessories</a></h3><!-- End .banner-title -->
                            <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-sm-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h2 class="title">Recent Arrivals</h2><!-- End .title -->
                    <div class="products-container mb-7">
                        <div class="row justify-content-center">
                            <div class="col-6 col-md-4">
                                <div class="product product-4">
                                    <figure class="product-media">
                                        <a href="{{ route('website.shop.index') }}">
                                            <img src="website_assets/images/demos/demo-18/products/product-1.jpg" alt="Product image" class="product-image">
                                            <img src="website_assets/images/demos/demo-18/products/product-1-2.jpg" alt="Product image" class="product-image-hover">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div><!-- End .product-action -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Clothing</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('website.shop.index') }}">Linen-blend dress</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            $60.00
                                        </div><!-- End .product-price -->
                                        <div class="product-nav product-nav-dots">
                                            <a href="#" class="active" style="background: #e5dcb1;"><span class="sr-only">Color name</span></a>
                                            <a href="#" style="background: #bacbd8;"><span class="sr-only">Color name</span></a>
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-md-4 -->

                            <div class="col-6 col-md-4">
                                <div class="product product-4">
                                    <figure class="product-media">
                                        <span class="product-label label-primary">Sale</span>
                                        <a href="{{ route('website.shop.index') }}">
                                            <img src="website_assets/images/demos/demo-18/products/product-2.jpg" alt="Product image" class="product-image">
                                            <img src="website_assets/images/demos/demo-18/products/product-2-2.jpg" alt="Product image" class="product-image-hover">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div><!-- End .product-action -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Shoes</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('website.shop.index') }}">Sandals with lacing</a></h3><!-- End .product-title -->

                                        <div class="product-price">
                                            <span class="new-price">Now $70.00</span>
                                            <span class="old-price">Was $84.00</span>
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-md-4 -->

                            <div class="col-6 col-md-4">
                                <div class="product product-4">
                                    <figure class="product-media">
                                        <a href="{{ route('website.shop.index') }}">
                                            <img src="website_assets/images/demos/demo-18/products/product-3.jpg" alt="Product image" class="product-image">
                                            <img src="website_assets/images/demos/demo-18/products/product-3-2.jpg" alt="Product image" class="product-image-hover">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div><!-- End .product-action -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Clothing</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('website.shop.index') }}">Paper bag trousers</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            $60.00
                                        </div><!-- End .product-price -->
                                        <div class="product-nav product-nav-dots">
                                            <a href="#" class="active" style="background: #9fac76;"><span class="sr-only">Color name</span></a>
                                            <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-md-4 -->

                            <div class="col-6 col-md-4">
                                <div class="product product-4">
                                    <figure class="product-media">
                                        <a href="{{ route('website.shop.index') }}">
                                            <img src="website_assets/images/demos/demo-18/products/product-4.jpg" alt="Product image" class="product-image">
                                            <img src="website_assets/images/demos/demo-18/products/product-4-2.jpg" alt="Product image" class="product-image-hover">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div><!-- End .product-action -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Handbags</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('website.shop.index') }}">Bucket bag</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            $350.00
                                        </div><!-- End .product-price -->
                                        <div class="product-nav product-nav-dots">
                                            <a href="#" class="active" style="background: #e3a84d;"><span class="sr-only">Color name</span></a>
                                            <a href="#" style="background: #f48a5b;"><span class="sr-only">Color name</span></a>
                                            <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-md-4 -->

                            <div class="col-6 col-md-4">
                                <div class="product product-4">
                                    <figure class="product-media">
                                        <a href="{{ route('website.shop.index') }}">
                                            <img src="website_assets/images/demos/demo-18/products/product-5.jpg" alt="Product image" class="product-image">
                                            <img src="website_assets/images/demos/demo-18/products/product-5-2.jpg" alt="Product image" class="product-image-hover">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div><!-- End .product-action -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Clothing</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('website.shop.index') }}">Silk-blend kaftan</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            $370.00
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-md-4 -->

                            <div class="col-6 col-md-4">
                                <div class="product product-4">
                                    <figure class="product-media">
                                        <a href="{{ route('website.shop.index') }}">
                                            <img src="website_assets
/images/demos/demo-18/products/product-6.jpg" alt="Product image" class="product-image">
                                            <img src="website_assets
/images/demos/demo-18/products/product-6-2.jpg" alt="Product image" class="product-image-hover">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div><!-- End .product-action -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Clothing</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('website.shop.index') }}">Linen-blend jumpsuit</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            $595.00
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-md-4 -->

                            <div class="col-6 col-md-4">
                                <div class="product product-4">
                                    <figure class="product-media">
                                        <a href="{{ route('website.shop.index') }}">
                                            <img src="website_assets
/images/demos/demo-18/products/product-7.jpg" alt="Product image" class="product-image">
                                            <img src="website_assets
/images/demos/demo-18/products/product-7-2.jpg" alt="Product image" class="product-image-hover">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div><!-- End .product-action -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Handbags</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('website.shop.index') }}">Paper straw shopper</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            $398.00
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-md-4 -->

                            <div class="col-6 col-md-4">
                                <div class="product product-4">
                                    <figure class="product-media">
                                        <span class="product-label label-sale">Sale</span>
                                        <a href="{{ route('website.shop.index') }}">
                                            <img src="website_assets
/images/demos/demo-18/products/product-8.jpg" alt="Product image" class="product-image">
                                            <img src="website_assets
/images/demos/demo-18/products/product-8-2.jpg" alt="Product image" class="product-image-hover">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div><!-- End .product-action -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Shoes</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('website.shop.index') }}">Sandals</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            <span class="new-price">Now $120.00</span>
                                            <span class="old-price">Was $140.00</span>
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-md-4 -->

                            <div class="col-6 col-md-4">
                                <div class="product product-4">
                                    <figure class="product-media">
                                        <a href="{{ route('website.shop.index') }}">
                                            <img src="website_assets
/images/demos/demo-18/products/product-9.jpg" alt="Product image" class="product-image">
                                            <img src="website_assets
/images/demos/demo-18/products/product-9-2.jpg" alt="Product image" class="product-image-hover">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div><!-- End .product-action -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Clothing</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('website.shop.index') }}">Vest dress</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            $9.99
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-md-4 -->
                        </div><!-- End .row -->

                        <div class="more-container text-center mt-0 mb-0">
                            <a href="category.html" class="btn btn-outline-primary-2 btn-more">
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
                                    <h4 class="widget-title">Best Selling</h4><!-- End .widget-title -->

                                    <div class="products">
                                        <div class="product product-sm">
                                            <figure class="product-media">
                                                <a href="{{ route('website.shop.index') }}">
                                                    <img src="website_assets
/images/demos/demo-18/products/small/product-1.jpg" alt="Product image" class="product-image">
                                                </a>
                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">Clothing</a>
                                                </div><!-- End .product-cat -->
                                                <h5 class="product-title"><a href="{{ route('website.shop.index') }}">V-neck buttoned blouse</a></h5><!-- End .product-title -->
                                                <div class="product-price">
                                                    <span class="new-price">Now $17.99</span>
                                                    <span class="old-price">Was $32.99</span>
                                                </div><!-- End .product-price -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product product-sm -->

                                        <div class="product product-sm">
                                            <figure class="product-media">
                                                <a href="{{ route('website.shop.index') }}">
                                                    <img src="website_assets
/images/demos/demo-18/products/small/product-2.jpg" alt="Product image" class="product-image">
                                                </a>
                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">Shoes</a>
                                                </div><!-- End .product-cat -->
                                                <h5 class="product-title"><a href="{{ route('website.shop.index') }}">Slides with a bow</a></h5><!-- End .product-title -->
                                                <div class="product-price">
                                                    $17.99
                                                </div><!-- End .product-price -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product product-sm -->

                                        <div class="product product-sm">
                                            <figure class="product-media">
                                                <a href="{{ route('website.shop.index') }}">
                                                    <img src="website_assets
/images/demos/demo-18/products/small/product-3.jpg" alt="Product image" class="product-image">
                                                </a>
                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">Clothing</a>
                                                </div><!-- End .product-cat -->
                                                <h5 class="product-title"><a href="{{ route('website.shop.index') }}">Paper bag skirt</a></h5><!-- End .product-title -->
                                                <div class="product-price">
                                                    $19.99
                                                </div><!-- End .product-price -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product product-sm -->

                                        <div class="product product-sm">
                                            <figure class="product-media">
                                                <a href="{{ route('website.shop.index') }}">
                                                    <img src="website_assets
/images/demos/demo-18/products/small/product-4.jpg" alt="Product image" class="product-image">
                                                </a>
                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">Handbags</a>
                                                </div><!-- End .product-cat -->
                                                <h5 class="product-title"><a href="{{ route('website.shop.index') }}">Foldaway waist bag</a></h5><!-- End .product-title -->
                                                <div class="product-price">
                                                    $9.99
                                                </div><!-- End .product-price -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product product-sm -->
                                    </div><!-- End .products -->
                                </div><!-- End .widget widget-products -->
                            </div><!-- End .col-sm-6 col-lg-12 -->

                            <div class="col-sm-6 col-lg-12">
                                <div class="widget widget-subscribe" style="background-image: url(website_assets
/images/demos/demo-18/bg-newsletter.jpg);">
                                    <h2 class="widget-title">Sign up for email <br>& get 25% off </h2><!-- End .widget-title -->
                                    <p>Subcribe to get information about products and coupons</p>

                                    <form action="#">
                                        <input type="email" class="form-control" placeholder="Enter your Email Address" required>

                                        <input type="submit" class="btn btn-outline-white" value="Subscribe">
                                    </form>

                                </div><!-- End .widget widget-banner -->
                            </div><!-- End .col-sm-6 col-lg-12 -->

                            <div class="col-sm-6 col-lg-12">
                                <div class="widget widget-banner">
                                    <div class="banner banner-overlay">
                                        <a href="#">
                                            <img src="website_assets
/images/demos/demo-18/banners/banner-5.jpg" alt="Banner">
                                        </a>

                                        <div class="banner-content">
                                            <h4 class="banner-subtitle"><a href="#">Spring 2019</a></h4><!-- End .banner-title -->
                                            <h3 class="banner-title"><a href="#">SAVE UP TO <br>50% OFF</a></h3><!-- End .banner-title -->
                                            <a href="#" class="banner-link">Shop Now</a>
                                        </div><!-- End .banner-content -->
                                    </div><!-- End .banner -->
                                </div><!-- End .widget widget-banner -->
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
                                "items":5
                            },
                            "1024": {
                                "items":6
                            },
                            "1200": {
                                "items":6,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                <a href="#" class="brand">
                    <img src="website_assets
/images/brands/1.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="website_assets
/images/brands/2.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="website_assets
/images/brands/3.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="website_assets
/images/brands/4.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="website_assets
/images/brands/5.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="website_assets
/images/brands/6.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="website_assets
/images/brands/7.png" alt="Brand Name">
                </a>
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
