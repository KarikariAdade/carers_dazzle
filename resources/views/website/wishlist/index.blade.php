@extends('layouts.pages')
@section('content')
    @inject('shopHelper', 'App\Helpers\ShopHelper')
    <div class="page-header text-center" style="background-image: url({{ asset('assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">Wishlist<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="container">
            @include('layouts.errors')
            @if($wishlist->count() > 0)
            <table class="table table-wishlist table-mobile">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Stock Status</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($wishlist as $list)
                <tr>
                    <td class="product-col">
                        <div class="product">
                            <figure class="product-media">
                                <a href="#">
                                    <img src="{{ asset($list->getProduct->getSingleImage()) }}" alt="Product image">
                                </a>
                            </figure>

                            <h3 class="product-title">
                                <a href="{{ $list->getProduct->generateRoute() }}">{{ $list->getProduct->name }}</a>
                            </h3><!-- End .product-title -->
                        </div><!-- End .product -->
                    </td>
                    <td class="price-col">{{ $shopHelper->calculateExchangeRate($list->getProduct->price) }}</td>
                    @if($list->getProduct->quantity > 0)
                        <td class="stock-col"><span class="in-stock">In stock</span></td>
                    @else
                        <td class="stock-col"><span class="out-of-stock">Out of Stock</span></td>
                    @endif
                    <td class="action-col">
                        <a href="{{ route('website.cart.add', $list->getProduct->id) }}" class="btn btn-block btn-outline-primary-2 addToCartBtn"><i class="icon-cart-plus"></i>Add to Cart</a>
                    </td>
                    <td class="remove-col"><a href="{{ route('customer.wishlist.remove', $list->id) }}" class="btn-remove"><i class="icon-close"></i></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <h3 class="text-center">Wishlist Empty. Kindly visit the <a href="{{ route('website.shop.index') }}">shop</a> to add items.</h3>
            @endif
        </div>
    </div>
@endsection
