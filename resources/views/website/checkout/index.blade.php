@extends('layouts.pages')
@section('content')
    @inject('shopHelper', 'App\Helpers\ShopHelper')
    <div class="page-header text-center" style="background-image: url({{ asset('assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Checkout</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="checkout">
            <div class="container">
                @include('layouts.errors')
                <div class="col-md-12">

                    <div class="accordion accordion-icon" id="accordion-3">
                        @if(!auth()->guard('web')->check())
                        <div class="card">
                            <div class="card-header" id="heading3-1">
                                <h2 class="card-title">
                                    <a role="button" data-toggle="collapse" href="#collapse3-1" aria-expanded="true" aria-controls="collapse3-1">
                                        <i class="icon-user"></i>Returning Customer? Click here to log in
                                    </a>
                                </h2>
                            </div><!-- End .card-header -->
                            <div id="collapse3-1" class="collapse" aria-labelledby="heading3-1" data-parent="#accordion-3">
                                <div class="card-body">
                                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the checkout section.</p>
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <form  method="POST" action="{{ route('website.checkout.customer.login') }}" id="cartLogin">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="single-input-item form-group">
                                                                <input type="email" name="email" class="form-control" placeholder="Enter your Email" required="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="single-input-item form-group">
                                                                <input type="password" class="form-control" name="password" placeholder="Enter your Password" required="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-input-item">
                                                        <button class="btn btn-primary" type="submit">Login</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End .card-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .card -->
                        @endif

                            @if(empty(session()->get('checkout_data.coupon')))
                        <div class="card">
                            <div class="card-header" id="heading3-2">
                                <h2 class="card-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse3-2" aria-expanded="false" aria-controls="collapse3-2">
                                        <i class="icon-info-circle"></i>Have a Coupon? Click here to enter your code
                                    </a>
                                </h2>
                            </div><!-- End .card-header -->
                            <div id="collapse3-2" class="collapse" aria-labelledby="heading3-2" data-parent="#accordion-3">
                                <div class="card-body">
                                    <div class="cart-update-option">
                                        <div class="apply-coupon-wrapper row">
                                            <form action="{{ route('website.cart.coupon.add') }}" method="POST" id="couponForm" class="col-md-7">
                                                <div class="form-group">
                                                    <input type="text" name="coupon" class="form-control" placeholder="Enter Your Coupon Code" required="">
                                                </div>
                                                <button class="btn btn-outline-primary-2" type="submit">Apply Coupon</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End .collapse -->
                        </div><!-- End .card -->
                            @endif
                    </div><!-- End .accordion -->
                </div><!-- End .col-md-6 -->
                <form method="POST" action="{{ route('website.checkout.order') }}" id="orderForm">
                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="name" value="{{ auth()->guard('web')->user()->name ?? '' }}">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Email address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required value="{{ auth()->guard('web')->user()->email ?? ''}}">
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->



                            <label>Street address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="street_address" placeholder="Street Address 1" required value="{{ $user ? $user->street_address_1 : old('street_address')  }}">
                            <input type="text" class="form-control" name="street_address_secondary" placeholder="Street Address 2 (Optional)" value="{{ $user ? $user->street_address_2 : old('street_address')  }}">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Town / City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="town" readonly required value="{{ $town->name }}">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>State / County <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="region" readonly required value="{{ $region->name }}">
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Postcode / ZIP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="postcode" required value="{{ $user ? $user->zip_code : old('postcode')  }}">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" required name="phone" value="{{ $user ? $user->phone : old('phone')  }}">
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Payment Method <span class="text-danger">*</span></label>
                                    <select class="select-custom form-control" name="payment_method">
                                        <option></option>
                                        <option value="payment_on_delivery">Payment on Delivery</option>
                                        <option value="pay_online">Pay Online</option>
                                    </select>
                                </div>
                            </div>

                            @if(!auth()->guard('web')->check())
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="create_pwd" id="checkout-create-acc">
                                <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                            </div><!-- End .custom-checkbox -->

                            <div class="create_account" style="display:none;">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="account_password" placeholder="Password">
                            </div>
                            @endif

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="checkout_diff_address" id="checkout-diff-address">
                                <label class="custom-control-label" for="checkout-diff-address">Ship to a different address?</label>
                            </div><!-- End .custom-checkbox -->


                            <div class="ship_to_diff_address" style="display:none;">
                                <label>Street address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="diff_street_address" placeholder="Street Address 1">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Town / City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="diff_town">
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>State / County <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="diff_city">
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Postcode / ZIP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="diff_post_code">
                                    </div><!-- End .col-sm-6 -->
                                </div>
                            </div>

                            <label>Order notes (optional)</label>
                            <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery" name="order_note"></textarea>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach(Cart::content() as $cart)
                                    <tr>
                                        <td><a href="#">{{ $cart->name }} <strong> × {{ $cart->qty }}</strong> </a></td>
                                        <td> {{ $shopHelper->calculateExchangeRate($cart->subtotal) }}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td>Shipping:</td>
                                        <td>{{ session()->get('checkout_data.delivery') ? $shopHelper->calculateExchangeRate(session()->get('checkout_data.delivery')) : $shopHelper->calculateExchangeRate(0) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount:</td>
                                        <td>{{ session()->get('checkout_data.sub_total') ? $shopHelper->calculateExchangeRate(session()->get('checkout_data.sub_total')) : $shopHelper->calculateExchangeRate(0) }}</td>
                                    </tr>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>{{ $shopHelper->calculateExchangeRate(Cart::subtotal()) }}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>{{ session()->get('checkout_data') ? $shopHelper->calculateExchangeRate(session()->get('checkout_data.total')) : $shopHelper->calculateExchangeRate(Cart::subtotal()) }}</td>
                                    </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>

                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
@endsection
