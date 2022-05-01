@extends('layouts.pages')
@section('content')
    <div class="page-header text-center" style="background-image: url({{asset('website_assets/images/page-header-bg.jpg')}})">
        <div class="container">
            <h1 class="page-title"> {{ $filter }}</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item"><a href="#">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $filter }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
{{--                                Showing <span>{{ $products->count() }}  @if($filter !== 'Filter By Top Rated') of {{ $products->total() }} @endif</span> Products--}}
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sort by:</label>
                                <input type="hidden" id="filterUrl" value="{{ route('website.filter.index') }}">
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control">
                                        <option>Filter Items</option>
                                        <option value="popularity">Most Popular</option>
                                        <option value="rating">Most Rated</option>
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                            </div><!-- End .toolbox-sort -->
                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row justify-content-center">
                            @if($products->count() > 0)
                                @foreach($products as $product)
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                <span class="product-label label-new">New</span>
                                                <a href="{{ $product->generateRoute() }}">
                                                    <img src="{{ asset($product->getSingleImage()) }}" alt="Product img" class="product-img">
                                                </a>

                                                <div class="product-action-vertical">
                                                    @if(auth()->guard('web')->check())
                                                        <a href="{{ route('customer.wishlist.store', $product->id) }}" class="btn-product-icon btn-wishlist btn-expandable addToWishlist"><span>add to wishlist</span></a>
                                                    @endif
                                                    {{--                                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>--}}
                                                </div><!-- End .product-action-vertical -->

                                                <div class="product-action">
                                                    <a href="{{ route('website.cart.add', $product->id) }}" class="btn-product btn-cart addToCartBtn"><span>add to cart</span></a>
                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">{{ $product->getCategory->name }}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title"><a href="{{ $product->generateRoute() }}">{{ $product->name }}</a></h3><!-- End .product-title -->
                                                <div class="product-price">
                                                    {{ $product->convertCurrency() }}
                                                </div><!-- End .product-price -->
                                                <div class="ratings-container">
                                                    @for($i = 1; $i < number_format($product->averageRating, 1); $i++)
                                                        <i class="fa-solid fa-star starrr"></i>
                                                    @endfor
                                                    @if($product->getReviews->count() < 1)
                                                        <span class="ratings-text">( {{ $product->getReviews->count() }} Reviews)</span>
                                                    @elseif($product->getReviews->count() > 1)
                                                        <span class="ratings-text">( {{ $product->getReviews->count() }} Reviews)</span>
                                                    @else
                                                        <span class="ratings-text">( {{ $product->getReviews->count() }} Review)</span>
                                                    @endif

                                                </div><!-- End .rating-container -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12 mt-5"><h6>There are no products under the selected filter at the moment. Kindly visit this page later or <a href="{{ route('website.shop.index') }}">shop here.</a></h6></div>
                            @endif
                        </div><!-- End .row -->

                        {{ $filter !== 'Filter By Top Rated' ? $products->links('vendor.pagination.bootstrap-4') : '' }}

                    </div><!-- End .products -->
                </div><!-- End .col-lg-9 -->
                {{--                    @include('layouts.product_sidebar')--}}
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
@endsection
