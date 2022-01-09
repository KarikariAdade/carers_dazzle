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
                                <li class="breadcrumb-item active" aria-current="page">checkout</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="checkout-page-wrapper">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <!-- Checkout Login Coupon Accordion Start -->
                    @include('layouts.errors')
                    <div class="checkoutaccordion" id="checkOutAccordion">
                        @if(!auth()->guard('web')->check())
                        <div class="card">
                            <h3>Returning Customer? <span data-toggle="collapse" data-target="#logInaccordion" aria-expanded="false" class="collapsed">Click Here To Login</span></h3>

                            <div id="logInaccordion" class="collapse" data-parent="#checkOutAccordion" style="">
                                <div class="card-body">
                                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the checkout section.</p>
                                    <div class="login-reg-form-wrap mt-20">
                                        <div class="row">
                                            <div class="col-lg-7 m-auto">
                                                <form  method="POST" action="{{ route('website.checkout.customer.login') }}" id="cartLogin">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="single-input-item">
                                                                <input type="email" name="email" placeholder="Enter your Email" required="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="single-input-item">
                                                                <input type="password" name="password" placeholder="Enter your Password" required="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-input-item">
                                                        <button class="check-btn sqr-btn" type="submit">Login</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(empty(session()->get('checkout_data.coupon')))
                        <div class="card">
                            <h3>Have A Coupon? <span data-toggle="collapse" data-target="#couponaccordion" aria-expanded="false" class="collapsed">Click Here To Enter Your Code</span></h3>
                            <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion" style="">
                                <div class="card-body">
                                    <div class="cart-update-option">
                                        <div class="apply-coupon-wrapper">
                                            <form action="{{ route('website.cart.coupon.add') }}" method="POST" id="couponForm" class=" d-block d-md-flex">
                                                <input type="text" name="coupon" placeholder="Enter Your Coupon Code" required="">
                                                <button class="check-btn sqr-btn" type="submit">Apply Coupon</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endif
                    </div>
                    <!-- Checkout Login Coupon Accordion End -->
                </div>
            </div>

            <form class="row" action="{{ route('website.checkout.order') }}" id="orderForm">
                @csrf
                    @method('POST')
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h2>Billing Details</h2>
                        <div class="billing-form-wrap">
                                    <div class="single-input-item">
                                        <label for="email" class="required">Full Name</label>
                                        <input type="text" id="name" placeholder="Full Name" required="" name="name" value="{{ auth()->guard('web')->user()->name ?? '' }}">
                                    </div>

                                <div class="single-input-item">
                                    <label for="email" class="required">Email Address</label>
                                    <input type="email" name="email" placeholder="Email Address" required="" value="{{ auth()->guard('web')->user()->email ?? ''}}">
                                </div>

                                <div class="single-input-item">
                                    <label for="street-address" class="required pt-20">Street address</label>
                                    <input type="text" name="street_address" id="street-address" placeholder="Street address Line 1" value="{{ $user ? $user->street_address_1 : old('street_address')  }}" required="">
                                </div>

                                <div class="single-input-item">
                                    <input type="text" name="street_address_secondary" placeholder="Street address Line 2 (Optional)" value="{{ $user ? $user->street_address_2 : old('street_address')  }}">
                                </div>

                                <div class="single-input-item">
                                    <label for="town" class="required">Town</label>
                                    <input type="text" name="town" readonly value="{{ $town->name }}">
                                </div>

                                <div class="single-input-item">
                                    <label for="state">Region</label>
                                    <input type="text" name="region" readonly value="{{ $region->name }}">
                                </div>

                                <div class="single-input-item">
                                    <label for="postcode" class="required">Postcode / ZIP</label>
                                    <input type="text" name="postcode" placeholder="Postcode / ZIP" required="" value="{{ $user ? $user->zip_code : old('postcode')  }}">
                                </div>

                                <div class="single-input-item">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" placeholder="Phone" value="{{ $user ? $user->phone : old('phone')  }}">
                                </div>
                            @if(!auth()->guard('web')->check())
                                <div class="checkout-box-wrap">
                                    <div class="single-input-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="create_pwd" id="create_pwd">
                                            <label class="custom-control-label" for="create_pwd">Create an account?</label>
                                        </div>
                                    </div>
                                    <div class="account-create single-form-row" style="display: none;">
                                        <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                        <div class="single-input-item">
                                            <label for="pwd" class="required">Account Password</label>
                                            <input type="password" id="pwd" name="account_password" placeholder="Account Password">
                                        </div>
                                    </div>
                                </div>
                            @endif

                                <div class="single-input-item">
                                    <label for="ordernote">Order Note</label>
                                    <textarea name="order_note" id="ordernote" cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Details -->
                <div class="col-lg-6">
                    <div class="order-summary-details mt-md-26 mt-sm-26">
                        <h2>Your Order Summary</h2>
                        <div class="order-summary-content mb-sm-4">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::content() as $cart)
                                    <tr>
                                        <td><a href="single-product.html">{{ $cart->name }} <strong> × {{ $cart->qty }}</strong></a></td>
                                        <td>GHS {{ number_format($cart->subtotal, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td><strong>{{ 'GHS '.Cart::subtotal() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="d-flex justify-content-center">
                                            {{ session()->get('checkout_data.delivery') ? 'GHS '.number_format(session()->get('checkout_data.delivery'), 2) : 'GHS 0.00' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td class="d-flex justify-content-center">
                                            {{ session()->get('checkout_data.sub_total') ? 'GHS '.number_format(session()->get('checkout_data.sub_total'), 2) : 'GHS 0.00' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td><strong>{{ session()->get('checkout_data') ? 'GHS '.number_format(session()->get('checkout_data.total'), 2) : 'GHS '.Cart::subtotal() }}</strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- Order Payment Method -->
                            <div class="order-payment-method">
                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="cashon" name="payment_method" value="cash" class="custom-control-input" checked="">
                                            <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="momo" name="payment_method" value="momo" class="custom-control-input">
                                            <label class="custom-control-label" for="momo">Pay Through Momo</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="sqr-btn" id="placeOrderBtn" type="submit">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
