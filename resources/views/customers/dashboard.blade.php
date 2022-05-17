@extends('layouts.pages')
@section('content')
    <div class="page-header mt-5 text-center" style="background-image: url({{ asset('assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">Dashboard<span>Account</span></h1>
        </div><!-- End .container -->
    </div>

    <div class="page-content mt-5">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('layouts.customers')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <div class="tab-pane fade active show" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <p>Hello <span class="font-weight-normal text-dark">{{ auth()->guard('web')->user()->name }}</span> (not <span class="font-weight-normal text-dark">{{ auth()->guard('web')->user()->name }}</span>? <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>)
                                    <br>
                                    From your account dashboard you can view your <a href="{{ route('customer.orders') }}" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="{{ route('customer.account.index') }}" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="{{ route('customer.account.index') }}" class="tab-trigger-link">edit your password and account details</a>.</p>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div>
@endsection
