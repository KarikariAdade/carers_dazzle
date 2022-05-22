@extends('layouts.pages')
@section('content')
    @inject('shopHelper', 'App\Helpers\ShopHelper')
    <style>
        .payment
        {
            border:1px solid #f2f2f2;
            padding-bottom: 10px;
            border-radius:20px;
            background:#fff;
        }
        .payment_header
        {
            /*background:rgba(255,102,0,1);*/
            padding:20px;
            border-radius:20px 20px 0px 0px;

        }

        .check
        {
            margin: 0px auto;
            width: 50px;
            line-height: 60px;
            height: 50px;
            border-radius: 100%;
            background: #fff;
            text-align: center;
        }

        .check i
        {
            vertical-align:middle;
            line-height:50px;
            font-size:30px;
        }

        .content
        {
            text-align:center;
        }

        .content  h1
        {
            font-size:25px;
            padding-top:25px;
        }

        .content a.main-link
        {
            width:200px;
            /*height:35px;*/
            color:#fff;
            margin-top: 50px !important;
            border-radius:30px;
            padding:5px 10px;
            /*background:rgba(255,102,0,1);*/
            transition:all ease-in-out 0.3s;
        }

        .content a.main-link:hover
        {
            text-decoration:none;
            background:#000;
        }

    </style>
    @if($status === 'success')

        <div class="container mb-5 mt-5">
            <div class="row">
                <div class="col-md-6 mx-auto mt-5">
                    <div class="payment">
                        <div class="payment_header bg-success">
                            <div class="check"><i class="fa fa-check fa-2x text-success" aria-hidden="true"></i></div>
                        </div>
                        <div class="content p-3">
                            <h1>Payment Successful !</h1>
                            <p>Hello {{ $payment->getOrder ? $payment->getOrder->name : null }}, your payment of {{ $shopHelper->calculateExchangeRate($payment->getOrder->net_total) }} is successful. Kindly visit your portal or email for your payment receipt.</p><br>
                            <a class="bg-success main-link" href="{{ route('website.home') }}">Go to Home</a><br>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @else

        <div class="container mb-5 mt-5">
            <div class="row">
                <div class="col-md-6 mx-auto mt-5">
                    <div class="payment">
                        <div class="payment_header bg-danger">
                            <div class="check"><i class="fa fa-check fa-2x text-danger" aria-hidden="true"></i></div>
                        </div>
                        <div class="content p-3">
                            <h1>Payment Failed !</h1>
                            <p>Hello {{ $payment->getOrder ? $payment->getOrder->name : null }}, your payment of {{ $shopHelper->calculateExchangeRate($payment->getOrder->net_total) }} was not successful. Kindly try again or <a class="text-primary" href="{{ route('website.contact.index') }}">contact us.</a></p><br>
                            <a class="bg-danger main-link" href="{{ route('website.cart.index') }}">Go to Cart</a><br>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection
