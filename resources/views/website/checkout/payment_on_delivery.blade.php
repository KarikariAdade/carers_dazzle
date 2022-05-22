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


        <div class="container mb-5 mt-5">
            <div class="row">
                <div class="col-md-6 mx-auto mt-5">
                    <div class="payment">
                        <div class="payment_header bg-success">
                            <div class="check"><i class="fa fa-check fa-2x text-success" aria-hidden="true"></i></div>
                        </div>
                        <div class="content p-3">
                            <h1>Order Successful !</h1>
                            <p>Hello {{ $order->name}}, your order is successful. Kindly visit your portal or email to view your order details.</p><br>
                            @if(!auth()->guard('web')->check())
                                <a class="bg-success main-link" href="{{ route('website.home') }}">Go Home</a><br>
                            @else
                                <a class="bg-success main-link" href="{{ route('customer.dashboard') }}">Go to my Dashboard</a><br>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection
