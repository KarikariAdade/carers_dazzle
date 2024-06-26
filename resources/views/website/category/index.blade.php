@extends('layouts.pages')
@section('content')
        <div class="page-header text-center" style="background-img: url('website_assets
/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Categories<span>{{ $category->name }}</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item"><a href="#">Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    Showing <span>{{ $products->count() }} of {{ $products->total() }}</span> Products
                                </div><!-- End .toolbox-info -->
                            </div><!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control">
                                            <option value="popularity" selected="selected">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div><!-- End .toolbox-sort -->
                            </div><!-- End .toolbox-right -->
                        </div><!-- End .toolbox -->

                        <div class="products mb-3">
                            <div class="row justify-content-center">
                                @foreach($products as $product)
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            <span class="product-label label-new">New</span>
                                            <a href="{{ $product->generateRoute() }}">
                                                <img src="{{ asset($product->getSingleImage()) }}" alt="Product img" class="product-img">
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
{{--                                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>--}}
                                            </div><!-- End .product-action-vertical -->

                                            <div class="product-action">
                                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <div class="product-cat">
                                                <a href="#">{{ $category->name }}</a>
                                            </div><!-- End .product-cat -->
                                            <h3 class="product-title"><a href="{{ $product->generateRoute() }}">{{ $product->name }}</a></h3><!-- End .product-title -->
                                            <div class="product-price">
                                                {{ number_format($product->price, 2) }}
                                            </div><!-- End .product-price -->
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                                <span class="ratings-text">( 2 Reviews )</span>
                                            </div><!-- End .rating-container -->
                                        </div><!-- End .product-body -->
                                    </div><!-- End .product -->
                                </div>
                                @endforeach
                            </div><!-- End .row -->
                            {{ $products->links('vendor.pagination.bootstrap-4') }}
                        </div><!-- End .products -->
                    </div><!-- End .col-lg-9 -->
                    @include('layouts.product_sidebar')
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    @endsection
