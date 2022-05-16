<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Carers Dazzle - Artistic and Inspired Handmade Hat, Hair Pieces and More.</title>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WZ8V4W7');</script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SETFED29J4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-SETFED29J4');
    </script>
    <meta name="google-site-verification" content="cxi1ovnjLe1jm5okexjrBncQ0LVulWQ5Shldw1tjAk8" />
    <meta name="keywords" content="Carers Dazzle, Artistic, Inspired, Inspired Handmade Hat, Handmade Hat, Fascinator, Bridal Pieces, Hair Pieces, Professional Makeup, Artistry, All Events, Hair Beauty, Bridal Beauty, Beauty Products, Assistance, Wedding, Beauty, Bridal, Wedding Planning, Wedding Gowns, Accessories">
    <meta name="description" content="We focus in providing Professional Makeup Artistry for all Events, Hair and Bridal Beauty Services, beauty products, assistance in wedding planning, sell WEDDING GOWNS and accessories.">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo.png') }}">
    <link rel="icon" type="img/png" sizes="32x32" href="{{ asset('logo.png') }}">
    <link rel="icon" type="img/png" sizes="16x16" href="{{ asset('logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">
    <meta name="apple-mobile-web-app-title" content="Carers Dazzle">
    <meta name="application-name" content="Carers Dazzle">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/bootstrap.min.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/plugins/nouislider/nouislider.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/starrr.css') }}">
    @stack('custom-css')
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ8V4W7"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@inject('shopHelper', 'App\Helpers\ShopHelper');
<div class="page-wrapper">
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <div class="header-dropdown">
                        <a href="#">Usd</a>
                        <div class="header-menu">
                            <ul>
                                <li><a href="{{ route('website.currency.convert', 'GHS') }}">GHS</a></li>
                                <li><a href="{{ route('website.currency.convert', 'USD') }}">USD</a></li>
                            </ul>
                        </div><!-- End .header-menu -->
                    </div><!-- End .header-dropdown -->
                </div><!-- End .header-left -->

                <div class="header-right">
                    <ul class="top-menu">
                        <li>
                            <a href="#">Links</a>
                            <ul>
                                <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                                @if(auth()->guard('web')->check())
                                <li><a href="{{ route('customer.wishlist.index') }}"><i class="icon-heart-o"></i>Wishlist <span class="wishlist_count">({{ $wishlist }})</span></a></li>
                                @endif
                                <li><a href="{{ route('website.contact.index') }}">Contact Us</a></li>
                                @if(auth()->guard('web')->check())
                                    <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    </li>
                                @else
                                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul><!-- End .top-menu -->
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-top -->

        <div class="header-middle sticky-header">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>

                    <a href="{{ route('website.home') }}" class="logo">
                        <img src="{{ asset('logo.png') }}" alt="Carers Dazzle" width="105" height="25">
                    </a>

                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li><a href="{{ route('website.home') }}">Home</a></li>
                            <li>
                                <a href="#" class="sf-with-ul">Categories</a>

                                <ul>
                                    @foreach($categories as $category)
                                    <li><a href="{{ $category->generateCategoryRoute() }}">{{ strtoupper($category->name) }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="sf-with-ul">Brands</a>
                                <ul>
                                    @foreach($brands as $brand)
                                    <li><a href="{{ $brand->generateBrandRoute() }}">{{ strtoupper($brand->name) }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{ route('website.shop.index') }}">Shop</a></li>
                        </ul><!-- End .menu -->
                    </nav><!-- End .main-nav -->
                </div><!-- End .header-left -->

                <div class="header-right">
                    <div class="header-search">
                        <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                        <form action="{{ route('website.filter.index') }}" method="get">
                            <div class="header-search-wrapper">
                                <label for="q" class="sr-only">Search</label>
                                <input type="search" class="form-control" name="keyword" id="keyword" placeholder="Search here..." required>
                            </div><!-- End .header-search-wrapper -->
                        </form>
                    </div><!-- End .header-search -->

                    <div class="dropdown cart-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">{{ Cart::count()  }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" id="cart-list">
                            <div class="dropdown-cart-products">
                                @if(!empty($carts))
                                @foreach($carts as $cart)
                                <div class="product">
                                    <div class="product-cart-details" style="width: 100%;">
                                        <h4 class="product-title">
                                            <a href="#">{{ $cart->name }}</a>
                                        </h4>
                                        <span class="cart-product-info">
                                                <span class="cart-product-qty">{{ $cart->qty }}</span>
                                                x {{ $shopHelper->calculateExchangeRate($cart->price) }}
                                            </span>
                                    </div><!-- End .product-cart-details -->
                                    <figure class="product-img-container" style="width:100%;">
                                        <a href="#" class="product-img">
                                            <img src="{{ asset($cart->options['product_image']) }}" alt="product" style="height: 100px; width: 100%;">
                                        </a>
                                    </figure>
                                    <a href="{{ route('website.cart.remove', $cart->rowId) }}" class="btn-remove removeCart" title="Remove Product"><i class="icon-close"></i></a>
                                </div><!-- End .product -->
                                    @endforeach
                                @endif
                            </div><!-- End .cart-product -->


                            <div class="dropdown-cart-total">
                                <span>Total</span>

                                <span class="cart-total-price">GHS {{ $shopHelper->calculateExchangeRate(Cart::subtotal()) }}</span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="{{ route('website.cart.index') }}" class="btn btn-primary">View Cart</a>
                                <a href="{{ route('website.checkout.index') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .dropdown-cart-total -->

                        </div>

                    </div><!-- End .cart-dropdown -->
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-middle -->
    </header><!-- End .header -->

    <main class="main">
        @yield('content')
    </main><!-- End .main -->

    <footer class="footer">
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="widget widget-about">
                            <img src="{{ asset('logo.png') }}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                            <p>Carers Dazzle - Artistic and Inspired Handmade Hat, Fascinator, Bridal and Hair Pieces and More </p>

                            <div class="social-icons">
                                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
                                <a href="#" class="social-icon" target="_blank" title="Pinterest"><i class="icon-pinterest"></i></a>
                            </div><!-- End .soial-icons -->
                        </div><!-- End .widget about-widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">Categories</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                @foreach($footer_categories as $category)
                                <li><a href="{{ $category->generateCategoryRoute() }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">Brands</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                @foreach($footer_brands as $brand)
                                <li><a href="{{ $brand->generateBrandRoute() }}">{{ $brand->name }}</a></li>
                                @endforeach
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                <li><a href="{{ route('login') }}">Sign In</a></li>
                                <li><a href="{{ route('website.cart.index') }}">View Cart</a></li>
                                <li><a href="{{ route('customer.wishlist.index') }}">My Wishlist</a></li>
                                <li><a href="{{ route('website.contact.index') }}">Help</a></li>
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .footer-middle -->

        <div class="footer-bottom">
            <div class="container">
                <p class="footer-copyright">Copyright © {{ date('Y') }} Carers Dazzle. All Rights Reserved.</p><!-- End .footer-copyright -->
                <figure class="footer-payments">
                    <img src="{{ asset('website_assets/images/payments.png') }}" alt="Payment methods" width="272" height="20">
                </figure><!-- End .footer-payments -->
            </div><!-- End .container -->
        </div><!-- End .footer-bottom -->
    </footer><!-- End .footer -->
</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li><a href="{{ route('website.home') }}">Home</a></li>
                <li>
                    <a href="#" class="sf-with-ul">Categories</a>

                    <ul>
                        @foreach($categories as $category)
                        <li><a href="{{ $category->generateCategoryRoute() }}">{{ strtoupper($category->name) }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#" class="sf-with-ul">Brands</a>
                    <ul>
                        @foreach($brands as $brand)
                        <li><a href="{{ $brand->generateBrandRoute() }}">{{ strtoupper($brand->name) }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{ route('website.shop.index') }}">Shop</a></li>
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="https://www.facebook.com/CarersDazzle/" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="https://www.instagram.com/carersdazzle/" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
{{--            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>--}}
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->

<!-- Sign in / Register Modal -->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-5">
                            <div class="tab-pane fade show active clientLogin" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                <form action="{{ route('website.client.login.post') }}" method="POST" class="clientLogin">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label>Email Address *</label>
                                        <input type="text" class="form-control" name="email" required autocomplete>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label >Password *</label>
                                        <input type="password" class="form-control" name="password" required autocomplete>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>LOG IN</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <a href="#" class="forgot-link">Forgot Your Password?</a>
                                    </div><!-- End .form-footer -->
                                </form>
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form class="clientRegister" action="{{ route('website.client.register') }}" method="POST">
{{--                                    @csrf--}}
                                    @method('POST')
                                    <div class="form-group">
                                        <label>Your Full Name *</label>
                                        <input type="text" class="form-control" name="name" required autocomplete>
                                    </div>
                                    <div class="form-group">
                                        <label>Your email address *</label>
                                        <input type="email" class="form-control" name="email" required autocomplete>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label>Password *</label>
                                        <input type="password" class="form-control" name="password" required autocomplete>
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label>Confirm Password *</label>
                                        <input type="password" class="form-control" name="password_confirmation" required autocomplete>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SIGN UP</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </div><!-- End .form-footer -->
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .modal-body -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div><!-- End .modal -->

<!-- Plugins JS File -->
<script src="{{ asset('website_assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('website_assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.hoverIntent.min.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('website_assets/js/superfish.min.js') }}"></script>
<script src="{{ asset('website_assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('website_assets/js/wNumb.js') }}"></script>
<script src="{{ asset('website_assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('website_assets/js/nouislider.min.js') }}"></script>
<!-- Main JS File -->
<script src="{{ asset('website_assets/js/main.js') }}"></script>
<script src="{{ asset('website_assets/js/swiper.min.js') }}"></script>
<script src="{{ asset('assets/js/sweet_alert.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('website_assets/js/starrr.js') }}"></script>
<script src="{{ asset('website_assets/js/all.min.js') }}"></script>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=62816b276dfd2e00199b1945&product=sop' async='async'></script>
@stack('custom-js')
</body>


</html>

