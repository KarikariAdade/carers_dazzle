@extends('layouts.pages')
@section('content')
    @inject('shopHelper', 'App\Helpers\ShopHelper')
    <div class="page-header text-center" style="background-image: url({{ asset('assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        @if(Cart::count() > 0)
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        @include('layouts.errors')
                        <table class="table table-cart table-mobile">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach(Cart::content() as $cart)
                            <tr>
                                <td class="product-col">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="#">
                                                <img src="{{ asset($cart->options['product_image']) }}" alt="Product image">
                                            </a>
                                        </figure>

                                        <h3 class="product-title">
                                            <a href="#">{{ $cart->name }}</a>
                                        </h3>
                                    </div>
                                </td>
                                <td class="price-col"> {{ $shopHelper->calculateExchangeRate($cart->price) }}</td>
                                <td class="quantity-col">
                                    <div class="cart-product-quantity">
                                        <input type="number" class="form-control" title="{{ $cart->rowId }}" value="{{ $cart->qty }}" min="1" max="{{ $cart->options['product_quantity'] }}" step="1" name="item_quantity" required>
                                    </div><!-- End .cart-product-quantity -->
                                </td>
                                <td class="total-col"> {{ $shopHelper->calculateExchangeRate($cart->subtotal) }}</td>
                                <td class="remove-col"><a href="{{ route('website.cart.remove', $cart->rowId) }}" class="btn-remove removeCart"><i class="icon-close"></i></a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="cart-bottom">
                            <div class="cart-discount">
                                <form action="{{ route('website.cart.coupon.add') }}" method="POST" id="couponForm">
                                    @csrf
                                    @method('POST')
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="coupon" required placeholder="coupon code">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                        </div><!-- .End .input-group-append -->
                                    </div><!-- End .input-group -->
                                </form>
                            </div><!-- End .cart-discount -->

                            <a href="{{ route('website.cart.clear') }}" id="clearCartBtn"  class="btn btn-outline-danger"><span>CLEAR CART</span><i class="icon-shopping-bag"></i></a>
                            <a href="{{ route('website.cart.update') }}" id="updateCartBtn" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a>
                        </div><!-- End .cart-bottom -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h3>Shipping</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" class="row shippingCart" action="{{ route('website.cart.shipping.calculate') }}">
                                    @csrf
                                    <div class="col-md-6 form-group">
                                        <label>Region</label><br>
                                        <select class="select2 form-control" name="region" id="shippingRegion" style="width: 100%;">
                                            <option></option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class=" col-md-6 form-group">
                                        <label>Town</label><br>
                                        <select name="town" class="select2 form-control" style="width: 100%;" id="shippingTown">
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        <button class="btn btn-primary" type="submit">Calculate Shipping</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                <tr class="summary-subtotal">
                                    <td>Subtotal:</td>
                                    <td> {{  $shopHelper->calculateExchangeRate(Cart::subtotal()) }}</td>
                                </tr><!-- End .summary-subtotal -->
                                <tr class="summary-shipping">
                                    <td>Shipping:</td>
                                    <td id="shipping Total">{{ session()->get('checkout_data.delivery') ? $shopHelper->calculateExchangeRate(session()->get('checkout_data.delivery')) : $shopHelper->calculateExchangeRate(0) }}</td>
                                </tr>
                                <tr class="summary-shipping">
                                    <td>Discount:</td>
                                    <td id="discountTotal">{{ session()->get('checkout_data.sub_total') ? $shopHelper->calculateExchangeReate(session()->get('checkout_data.sub_total')) : $shopHelper->calculateExchangeRate(0) }}</td>
                                </tr>


                                <tr class="summary-total">
                                    <td>Total:</td>
                                    <td class="total-amount">{{ session()->get('checkout_data') ? $shopHelper->calculateExchangeRate(session()->get('checkout_data.total')): $shopHelper->calculateExchangeRate(Cart::subtotal()) }}</td>
                                </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->
                            @if(Cart::count() > 0)
                            <a href="{{ route('website.checkout.index') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                            @endif
                        </div><!-- End .summary -->

                        <a href="{{ route('website.shop.index') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
        @else
        <h3 class="text-center">Cart Empty. Kindly visit the <a href="{{ route('website.shop.index') }}">shop</a> to add items.</h3>
        @endif
    </div><!-- End .page-content -->
@endsection
@push('custom-js')
        <script>
            $('#shippingRegion').change(function () {
                if ($(this).val() !== ''){
                    let url = `{{ route('product.shipping.get.town') }}`,
                        output = ``;
                    $.post(url, {'item': $(this).val()}, function (response){
                        console.log(response)
                        if(!jQuery.isEmptyObject(response)){
                            $.each(response, function(i, town) {
                                output += `<option value="${town.id}">${town.name}</option>`;
                            });
                            $('#shippingTown').html(output)
                        }
                    })
                }else{
                    $('#shippingTown').html('')
                }
            })
        </script>
    @endpush
