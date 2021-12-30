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
                                <li class="breadcrumb-item active" aria-current="page">{{ $brands->name }}</li>
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
                @include('layouts.shop_sidebar')
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
                                            <p>Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} items</p>
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
                            @foreach($products as $product)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <!-- product single grid item start -->
                                <div class="product-item fix mb-30">
                                    <div class="product-thumb">
                                        <a href="{{ $product->generateRoute() }}">
                                            <img src="{{ asset($product->getSingleImage()) }}" class="img-pri" alt="">
                                        </a>
                                        <div class="product-action-link">
                                            <a href="{{ $product->generateRoute() }}"> <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick view"><i class="fa fa-eye"></i></span> </a>
                                            <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Wishlist"><i class="fa fa-heart-o"></i></a>
                                            <a href="{{ route('website.cart.add', $product->id) }}" class="addToCartBtn" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4><a href="{{ $product->generateRoute() }}">{{ $product->name }}</a></h4>
                                        <div class="pricebox">
                                            <span class="regular-price">GHS {{ number_format($product->price, 2) }}</span>
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
                            @endforeach
                        </div>
                        <!-- product item end -->
                    </div>
                    <!-- product view wrapper area end -->

                    <!-- start pagination area -->
                    <div class="paginatoin-area text-center pt-28">
                        <div class="row">
                            <div class="col-12">
                                {{ $products->links('vendor.pagination.bootstrap-4') }}
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
