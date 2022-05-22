<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Carers Dazzle - Artistic and Inspired Handmade Hat, Hair Pieces and More.</title>
    <!-- Google Tag Manager -->
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
    <!-- End Google Tag Manager -->
    <meta name="google-site-verification" content="cxi1ovnjLe1jm5okexjrBncQ0LVulWQ5Shldw1tjAk8" />
    <meta name="keywords" content="Carers Dazzle, Artistic, Inspired, Inspired Handmade Hat, Handmade Hat, Fascinator, Bridal Pieces, Hair Pieces, More, Professional Makeup, Artistry, All Events, Hair Beauty, Bridal Beauty, Beauty Products, Assistance, Wedding, Beauty, Bridal, Wedding Planning, Wedding Gowns, Accessories">
    <meta name="description" content="Carers Dazzle - Artistic and Inspired Handmade Hat, Fascinator, Bridal and Hair Pieces and More">
    <meta name="author" content="Carers Dazzle">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo.png') }}">
    <link rel="icon" type="img/png" sizes="32x32" href="{{ asset('logo.png') }}">
    <link rel="icon" type="img/png" sizes="16x16" href="{{ asset('logo.png') }}">
    <meta name="apple-mobile-web-app-title" content="Carers Dazzle">
    <meta name="application-name" content="Carers Dazzle">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/demos/demo-18.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/css/custom.css') }}">
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ8V4W7"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@inject('shopHelper', 'App\Helpers\ShopHelper')
<div class="page-wrapper">
    <header class="header header-11">
        <div class="header-middle sticky-header">
            <div class="container">
                <div class="header-left">
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
                            <li><a href="{{ route('website.contact.index') }}">Contact</a></li>

                        </ul><!-- End .menu -->
                    </nav><!-- End .main-nav -->

                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>
                </div><!-- End .header-left -->

                <div class="header-center">
                    <a href="{{ route('website.home') }}" class="logo">
{{--                        <img src="{{ asset('logo.png') }}" alt="Carers Dazzle" width="82" height="25">--}}
                        <img src="{{ asset('logo.png') }}" alt="Carers Dazzle" width="100" height="100">
                    </a>
                </div><!-- End .header-center -->

                <div class="header-right">
                    <div class="header-search header-search-extended header-search-visible">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                        <form action="{{ route('website.filter.index') }}" method="get">
{{--                            @csrf--}}
                            <div class="header-search-wrapper">
                                <label for="q" class="sr-only">Search</label>
                                <input type="search" class="form-control" name="keyword" id="keyword" placeholder="Search product ..." required>
                                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                            </div><!-- End .header-search-wrapper -->
                        </form>
                    </div><!-- End .header-search -->

                    @if(auth()->guard('web')->check())
                    <a href="{{ route('customer.wishlist.index') }}" class="wishlist-link">
                        <i class="icon-heart-o"></i>
                        <span class="wishlist-count">{{ $wishlist }}</span>
                    </a>
                    @endif

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

                                <span class="cart-total-price"> {{ $shopHelper->calculateExchangeRate(Cart::subtotal()) }}</span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="{{ route('website.cart.index') }}" class="btn btn-primary">View Cart</a>
                                <a href="{{ route('website.checkout.index') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .dropdown-cart-total -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .cart-dropdown -->
                    <div class="dropdown cart-dropdown">
                        <a href="{{ route('login') }}" class="dropdown-toggle">
                            <i class="icon-user"></i>
{{--                            <span class="cart-count">{{ Cart::count()  }}</span>--}}
                        </a>
                    </div>
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
                                <a href="https://www.facebook.com/CarersDazzle/" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
{{--                                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>--}}
                                <a href="https://www.instagram.com/carersdazzle/" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
{{--                                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>--}}
{{--                                <a href="#" class="social-icon" target="_blank" title="Pinterest"><i class="icon-pinterest"></i></a>--}}
                            </div><!-- End .soial-icons -->
                        </div><!-- End .widget about-widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                @foreach($footer_categories as $category)
                                    <li><a href="{{ $category->generateCategoryRoute() }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

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
                    <span>Developed by SamiTeck</span>
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
                <li><a href="{{ route('website.contact.index') }}">Contact</a></li>
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="https://www.facebook.com/CarersDazzle/" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
{{--            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>--}}
            <a href="https://www.instagram.com/carersdazzle/" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
{{--            <a href="" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>--}}
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
                            <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="singin-email">Username or email address *</label>
                                        <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="singin-password">Password *</label>
                                        <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>LOG IN</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="signin-remember">
                                            <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                        </div><!-- End .custom-checkbox -->

                                        <a href="#" class="forgot-link">Forgot Your Password?</a>
                                    </div><!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div><!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="register-email">Your email address *</label>
                                        <input type="email" class="form-control" id="register-email" name="register-email" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="register-password">Password *</label>
                                        <input type="password" class="form-control" id="register-password" name="register-password" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SIGN UP</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                            <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div><!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login  btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .modal-body -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div><!-- End .modal -->


<script src="{{ asset('website_assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('website_assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.hoverIntent.min.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('website_assets/js/superfish.min.js') }}"></script>
<script src="{{ asset('website_assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('website_assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Main JS File -->
<script src="{{ asset('website_assets/js/main.js') }}"></script>
<script src="{{ asset('website_assets/js/demos/demo-18.js') }}"></script>
<script src="{{ asset('assets/js/sweet_alert.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=62816b276dfd2e00199b1945&product=sop' async='async'></script>
</body>

</html>
