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
                                <li class="breadcrumb-item"><a href="{{ route('website.shop') }}">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-main-wrapper">
        <div class="container">
            @include('layouts.errors')
            <div class="row">
                <div class="col-lg-12">
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="pro-thumbnail">Thumbnail</th>
                                <th class="pro-title">Product</th>
                                <th class="pro-price">Price (GHS)</th>
                                <th class="pro-quantity">Quantity</th>
                                <th class="pro-subtotal">Total</th>
                                <th class="pro-remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Cart::content() as $cart)
                            <tr>
                                <td class="pro-thumbnail">
                                    <a href="#">
                                        <img class="img-fluid" src="{{ asset($cart->options['product_image']) }}" alt="Product"/>
                                    </a>
                                </td>
                                <td class="pro-title"><a href="#">{{ $cart->name }}</a></td>
                                <td class="pro-price"><span>{{ $cart->price }}</span></td>
                                <td class="pro-quantity">
                                    <div class="pro-qty"><input type="number" min="1" max="" name="item_quantity" value="{{ $cart->qty }}"  title="{{ $cart->rowId }}"></div>
                                </td>
                                <td class="pro-subtotal"><span>{{ $cart->subtotal }}</span></td>
                                <td class="pro-remove"><a href="{{ route('website.cart.remove', $cart->rowId) }}" class="removeCart"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Cart Update Option -->
                    <div class="cart-update-option d-block d-md-flex justify-content-between">
                        <div class="apply-coupon-wrapper">
                            <form action="{{ route('website.cart.coupon.add') }}" method="POST" id="couponForm" class="d-block d-md-flex">
                                @csrf
                                @method('POST')
                                <input type="text" name="coupon" placeholder="Enter Your Coupon Code" required />
                                <button class="sqr-btn" type="submit">Apply Coupon</button>
                            </form>
                        </div>
                        <div class="cart-update mt-sm-16">
                            <a href="{{ route('website.cart.update') }}" id="updateCartBtn" class="sqr-btn">Update Cart</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h3>Shipping</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" class="row shippingCart" action="{{ route('website.cart.shipping.calculate') }}">
                                @csrf
                                <div class="col-md-6">
                                    <label>Region</label><br>
                                    <select class="select2" name="region" id="shippingRegion" style="width: 100%;">
                                        <option></option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-md-6">
                                    <label>Town</label><br>
                                    <select name="town" class="select2" style="width: 100%;" id="shippingTown">
                                    </select>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <button class="sqr-btn" type="submit">Calculate Shipping</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ml-auto">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h3>Cart Totals</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>{{ 'GHS '.Cart::subtotal() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td id="discountTotal">{{ session()->get('checkout_data.sub_total') ? 'GHS '.number_format(session()->get('checkout_data.sub_total'), 2) : 'GHS 0.00' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td id="shipping Total">{{ session()->get('checkout_data.delivery') ? 'GHS '.number_format(session()->get('checkout_data.delivery'), 2) : 'GHS 0.00' }}</td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="total-amount">{{ session()->get('checkout_data') ? 'GHS '.number_format(session()->get('checkout_data.total'), 2) : 'GHS '.Cart::subtotal() }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @if(Cart::count() > 0)
                        <a href="{{ route('website.checkout.index') }}" class="sqr-btn d-block">Proceed To Checkout</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
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
