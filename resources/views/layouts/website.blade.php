<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Site title -->
    <title>E-Square Electronics</title>
    <link href="{{ asset('customer_asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font-Awesome CSS -->
    <link href="{{ asset('customer_asset/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- helper class css -->
    <link href="{{ asset('customer_asset/css/helper.min.css') }}" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="{{ asset('customer_asset/css/plugins.css') }}" rel="stylesheet">

    <link href="{{ asset('customer_asset/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('customer_asset/css/skin-default.css') }}" rel="stylesheet" id="galio-skin">

    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">

</head>

<body>


<div class="wrapper">

    <!-- header area start -->
    <header>

        <!-- header top start -->
        <div class="header-top-area bg-gray text-center text-md-left">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-5">
                        <div class="header-call-action">
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                                info@website.com
                            </a>
                            <a href="#">
                                <i class="fa fa-phone"></i>
                                0123456789
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7">
                        <div class="header-top-right float-md-right float-none">
                            <nav>
                                <ul>
                                    <li>
                                        <div class="dropdown header-top-dropdown">
                                            <a class="dropdown-toggle" id="myaccount" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                My Account
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="myaccount">
                                                @if(auth()->guard('web')->check())
                                                <a class="dropdown-item" href="{{ route('customer.dashboard') }}">My Account</a>
                                                    <a class="dropdown-item" href="" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}</a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                @else
                                                <a class="dropdown-item" href="{{ route('login') }}"> Login</a>
                                                <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                                @endif

                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">my wishlist</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('website.cart.index') }}">my cart</a>
                                    </li>
                                    @if(Cart::count() > 0)
                                        <li>
                                            <a href="{{ route('website.checkout.index') }}">checkout</a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header top end -->

        <!-- header middle start -->
        <div class="header-middle-area pt-20 pb-20">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="brand-logo">
                            <a href="index.html">
                                <img src="assets/img/logo/logo.png" alt="brand logo">
                            </a>
                        </div>
                    </div> <!-- end logo area -->
                    <div class="col-lg-9">
                        <div class="header-middle-right">
                            <div class="header-middle-shipping mb-20">
                                <div class="single-block-shipping">
                                    <div class="shipping-icon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <div class="shipping-content">
                                        <h5>Working time</h5>
                                        <span>Mon- Sun: 8.00 - 18.00</span>
                                    </div>
                                </div> <!-- end single shipping -->
                                <div class="single-block-shipping">
                                    <div class="shipping-icon">
                                        <i class="fa fa-truck"></i>
                                    </div>
                                    <div class="shipping-content">
                                        <h5>free shipping</h5>
                                        <span>On order over $199</span>
                                    </div>
                                </div> <!-- end single shipping -->
{{--                                <div class="single-block-shipping">--}}
{{--                                    <div class="shipping-icon">--}}
{{--                                        <i class="fa fa-money"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="shipping-content">--}}
{{--                                        <h5>money back 100%</h5>--}}
{{--                                        <span>Within 30 Days after delivery</span>--}}
{{--                                    </div>--}}
{{--                                </div> <!-- end single shipping -->--}}
                            </div>
                            <div class="header-middle-block">
                                <div class="header-middle-searchbox">
                                    <input type="text" placeholder="Search...">
                                    <button class="search-btn"><i class="fa fa-search"></i></button>
                                </div>
                                <div class="header-mini-cart">
                                    <div class="mini-cart-btn">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="cart-notification">{{ Cart::count() }}</span>
                                    </div>
                                    <div class="cart-total-price">
                                        <span>total</span>
                                        {{ 'GHS ' . Cart::subtotal() }}
                                    </div>
                                    <ul class="cart-list" id="cart-list">
                                        @foreach(Cart::content() as $cart)
                                        <li title="{{ $cart->id }}">

                                            <div class="cart-img">
                                                <a href="#"><img src="{{ asset($cart->options['product_image']) }}" alt=""></a>
                                            </div>
                                            <div class="cart-info">
                                                <h4><a href="">{{ $cart->name }} ({{ $cart->qty }})</a></h4>
                                                <span>GHS {{ number_format($cart->subtotal, 2) }}</span>
                                            </div>
                                            <div class="del-icon">
                                                <a href="{{ route('website.cart.remove', $cart->rowId) }}" class="text-danger" id="del-icon"><i class="fa fa-times"></i></a>
                                            </div>
                                        </li>
                                        @endforeach
                                        <li class="mini-cart-price">
                                            <span class="subtotal">subtotal : </span>
                                            <span class="subtotal-price">{{ 'GHS ' . Cart::subtotal() }}</span>
                                        </li>
                                        <li class="checkout-btn">
                                            @if(Cart::count() > 0)
                                            <a href="{{ route('website.checkout.index') }}">checkout</a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header middle end -->

        <!-- main menu area start -->
        <div class="main-header-wrapper bdr-bottom1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-header-inner">
                            <div class="category-toggle-wrap">
                                <div class="category-toggle">
                                    categories & brands
                                    <div class="cat-icon">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <nav class="category-menu hm-1" @if( str_contains(url()->current(), 'shop'))  style="display: none;" @endif>
                                    <ul>
                                        @foreach($pageItems['categories'] as $category)
                                        <li class="menu-item-has-children">
                                            <a href="{{ route('website.category', strtolower(str_replace(' ', '_', $category->name))) }}"> {{ $category->name }}</a>
                                            <!-- Mega Category Menu Start -->
                                            @if($category->getSubCategories->count() > 0)
                                            <ul class="category-mega-menu">
                                                <li class="menu-item-has-children">
                                                    <ul>
                                                        @foreach($category->getSubCategories as $sub_category)
                                                        <li><a href="{{ route('website.category', ['category' => strtolower(str_replace(' ', '_', $sub_category->name)), 'sub' => 'sub']) }}">{{ $sub_category->name }}</a></li>
                                                        @endforeach

                                                    </ul>
                                                </li>
                                            </ul><!-- Mega Category Menu End -->
                                            @endif
                                        </li>
                                        @endforeach
                                        @foreach($pageItems['brands'] as $brand)
                                        <li class="menu-item">
                                            <a href="{{ route('website.brand', strtolower(str_replace(' ', '_', $brand->name))) }}">{{ $brand->name }}</a>
                                        </li>
                                            @endforeach
                                </nav>
                            </div>
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li class="active"><a href="{{ route('website.index') }}"><i class="fa fa-home"></i>Home <i class="fa fa-angle-down"></i></a>
                                        </li>
                                        <li><a href="{{ route('website.shop') }}">shop </a></li>
                                        <li><a href="#">Blog </a></li>
                                        <li><a href="contact-us.html">Contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-block d-lg-none">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->
    @yield('content')
    <footer class="mt-5">
        <!-- footer top start -->
        <div class="footer-top bg-black pt-14 pb-14">
            <div class="container">
                <div class="footer-top-wrapper">
                    <div class="newsletter__wrap">
                        <div class="newsletter__title">
                            <div class="newsletter__icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="newsletter__content">
                                <h3>sign up for newsletter</h3>
                                <p>Duis autem vel eum iriureDuis autem vel eum</p>
                            </div>
                        </div>
                        <div class="newsletter__box">
                            <form id="mc-form">
                                <input type="email" id="mc-email" autocomplete="off" placeholder="Email">
                                <button id="mc-submit">subscribe!</button>
                            </form>
                        </div>
                        <!-- mailchimp-alerts Start -->
                        <div class="mailchimp-alerts">
                            <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                            <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                            <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                        </div>
                        <!-- mailchimp-alerts end -->
                    </div>
                    <div class="social-icons">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer top end -->

        <!-- footer main start -->
        <div class="footer-widget-area pt-40 pb-38 pb-sm-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget mb-sm-30">
                            <div class="widget-title mb-10 mb-sm-6">
                                <h4>contact us</h4>
                            </div>
                            <div class="widget-body">
                                <ul class="location">
                                    <li><i class="fa fa-envelope"></i>support@galio.com</li>
                                    <li><i class="fa fa-phone"></i>(800) 0123 456 789</li>
                                    <li><i class="fa fa-map-marker"></i>Address: 1234 - Bandit Tringi Aliquam
                                        Vitae. New York</li>
                                </ul>
                                <a class="map-btn" href="contact-us.html">open in google map</a>
                            </div>
                        </div> <!-- single widget end -->
                    </div> <!-- single widget column end -->
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget mb-sm-30">
                            <div class="widget-title mb-10 mb-sm-6">
                                <h4>my account</h4>
                            </div>
                            <div class="widget-body">
                                <ul>
                                    <li><a href="#">my account</a></li>
                                    <li><a href="#">my cart</a></li>
                                    <li><a href="#">checkout</a></li>
                                    <li><a href="#">my wishlist</a></li>
                                    <li><a href="#">login</a></li>
                                </ul>
                            </div>
                        </div> <!-- single widget end -->
                    </div> <!-- single widget column end -->
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget mb-sm-30">
                            <div class="widget-title mb-10 mb-sm-6">
                                <h4>short code</h4>
                            </div>
                            <div class="widget-body">
                                <ul>
                                    <li><a href="#">gallery</a></li>
                                    <li><a href="#">accordion</a></li>
                                    <li><a href="#">carousel</a></li>
                                    <li><a href="#">map</a></li>
                                    <li><a href="#">tab</a></li>
                                </ul>
                            </div>
                        </div> <!-- single widget end -->
                    </div> <!-- single widget column end -->
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget mb-sm-30">
                            <div class="widget-title mb-10 mb-sm-6">
                                <h4>product tags</h4>
                            </div>
                            <div class="widget-body">
                                <ul>
                                    <li><a href="#">computer</a></li>
                                    <li><a href="#">camera</a></li>
                                    <li><a href="#">smart phone</a></li>
                                    <li><a href="#">watch</a></li>
                                    <li><a href="#">tablet</a></li>
                                </ul>
                            </div>
                        </div> <!-- single widget end -->
                    </div> <!-- single widget column end -->
                </div>
            </div>
        </div>
        <!-- footer main end -->

        <!-- footer bootom start -->
        <div class="footer-bottom-area bg-gray pt-20 pb-20">
            <div class="container">
                <div class="footer-bottom-wrap">
                    <div class="copyright-text">
                        <p><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></p>
                    </div>
                    <div class="payment-method-img">
                        <img src="assets/img/payment.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- footer bootom end -->

    </footer>
    <!-- footer area end -->
    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->
</div>

<script src="{{ asset('customer_asset/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('customer_asset/js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('customer_asset/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('customer_asset/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('customer_asset/js/plugins.js') }}"></script>
<script src="{{ asset('customer_asset/js/main.js') }}"></script>
<script src="{{ asset('assets/js/sweet_alert.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
    $('.select2').select2();
</script>
@stack('custom-js')
</body>




</html>

