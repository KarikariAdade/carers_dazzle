@extends('layouts.website')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('website.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $categories->name }}</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-main-wrapper">
        <div class="container">
            <div class="row">
                <!-- sidebar start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <div class="shop-sidebar-wrap mt-md-28 mt-sm-28">
                        <!-- manufacturer start -->
                        <div class="sidebar-widget mb-30">
                            <div class="sidebar-title mb-10">
                                <h3>Brands</h3>
                            </div>
                            <div class="sidebar-widget-body">
                                <ul>
                                    <li><i class="fa fa-angle-right"></i><a href="#">calvin klein</a><span>(10)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">diesel</a><span>(12)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">polo</a><span>(20)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">Tommy Hilfiger</a><span>(12)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">Versace</a><span>(16)</span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- manufacturer end -->

                        <!-- pricing filter start -->
                        <div class="sidebar-widget mb-30">
                            <div class="sidebar-title mb-10">
                                <h3>filter by price</h3>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="price-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="50" data-max="400"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
                                    <div class="range-slider">
                                        <form action="#" class="d-flex justify-content-between">
                                            <button class="filter-btn">filter</button>
                                            <div class="price-input d-flex align-items-center">
                                                <label for="amount">Price: </label>
                                                <input type="text" id="amount">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- pricing filter end -->

                        <!-- product size start -->
                        <div class="sidebar-widget mb-30">
                            <div class="sidebar-title mb-10">
                                <h3>size</h3>
                            </div>
                            <div class="sidebar-widget-body">
                                <ul>
                                    <li><i class="fa fa-angle-right"></i><a href="#">s</a><span>(10)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">m</a><span>(12)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">l</a><span>(20)</span></li>
                                    <li><i class="fa fa-angle-right"></i><a href="#">XL</a><span>(12)</span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- product size end -->

                        <!-- product tag start -->
                        <div class="sidebar-widget mb-30">
                            <div class="sidebar-title mb-10">
                                <h3>tags</h3>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="product-tag">
                                    <a href="#">camera</a>
                                    <a href="#">computer</a>
                                    <a href="#">tablet</a>
                                    <a href="#">watch</a>
                                    <a href="#">smart phones</a>
                                    <a href="#">handbag</a>
                                    <a href="#">shoe</a>
                                    <a href="#">men</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sidebar end -->

                <!-- product main wrap start -->
                <div class="col-lg-9 order-1 order-lg-2 mt-0">
                    <!-- product view wrapper area start -->
                    <div class="shop-product-wrapper pt-34">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row">
                                <div class="col-lg-7 col-md-6">
                                    <div class="top-bar-left">

                                        <div class="product-amount">
                                            <p>Showing 1–16 of 21 results</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                    <div class="top-bar-right">
                                        <div class="product-short">
                                            <p>Sort By : </p>
                                            <select class="nice-select" name="sortby" style="display: none;">
                                                <option value="trending">Relevance</option>
                                                <option value="sales">Name (A - Z)</option>
                                                <option value="sales">Name (Z - A)</option>
                                                <option value="rating">Price (Low &gt; High)</option>
                                                <option value="date">Rating (Lowest)</option>
                                                <option value="price-asc">Model (A - Z)</option>
                                                <option value="price-asc">Model (Z - A)</option>
                                            </select><div class="nice-select" tabindex="0"><span class="current">Relevance</span><ul class="list"><li data-value="trending" class="option selected">Relevance</li><li data-value="sales" class="option">Name (A - Z)</li><li data-value="sales" class="option">Name (Z - A)</li><li data-value="rating" class="option">Price (Low &gt; High)</li><li data-value="date" class="option">Rating (Lowest)</li><li data-value="price-asc" class="option">Model (A - Z)</li><li data-value="price-asc" class="option">Model (Z - A)</li></ul></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->

                        <!-- product item start -->
                        <div class="shop-product-wrap grid row">


                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <!-- product single grid item start -->
                                <div class="product-item fix mb-30">
                                    <div class="product-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-img4.jpg" class="img-pri" alt="">
                                            <img src="assets/img/product/product-img6.jpg" class="img-sec" alt="">
                                        </a>
                                        <div class="product-label">
                                            <span>hot</span>
                                        </div>
                                        <div class="product-action-link">
                                            <a href="#" data-toggle="modal" data-target="#quick_view"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-search"></i></span> </a>
                                            <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4><a href="product-details.html">vertual product 01</a></h4>
                                        <div class="pricebox">
                                            <span class="regular-price">$70.00</span>
                                            <div class="ratings">
                                                <span class="good"><i class="fa fa-star"></i></span>
                                                <span class="good"><i class="fa fa-star"></i></span>
                                                <span class="good"><i class="fa fa-star"></i></span>
                                                <span class="good"><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <div class="pro-review">
                                                    <span>1 review(s)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- product single column end -->
                        </div>
                        <!-- product item end -->
                    </div>
                    <!-- product view wrapper area end -->

                    <!-- start pagination area -->
                    <div class="paginatoin-area text-center pt-28">
                        <div class="row">
                            <div class="col-12">
                                <ul class="pagination-box">
                                    <li><a class="Previous" href="#">Previous</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a class="Next" href="#"> Next </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end pagination area -->

                </div>
                <!-- product main wrap end -->
            </div>
        </div>
    </div>
@endsection
