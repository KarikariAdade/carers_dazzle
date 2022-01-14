@extends('layouts.website')
@section('content')
    <style>
        .borderless{
            border-right-color: transparent !important;
        }
        .mt-5 {
            margin-top: 5%;
        }
        .mb-5{
            margin-bottom: 5%;
        }
        .f-bold{
            font-weight: bold;
        }
    </style>
    <div class="my-account-wrapper mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                        @include('layouts.customers')
                        <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <h4 class="mb-10 f-bold">Order Details ({{ $order->order_id }})</h4>
                                <div class="row mt-5">
                                    <div class="col-md-6 mb-5">
                                        <h6 class="f-bold">SHIPPING DETAILS</h6><br>
                                        <p>
                                            {{ $order->name }}<br>
                                            {{ $order->getRegion->name.', '.$order->getTown->name }}<br>
                                            @if(!empty($order->user_id))
                                            @if(!empty($order->getUser->phone))
                                                    {{ $order->getUser->phone.'<br>' }}
                                                @endif
                                            @endif
                                            {{ $order->email }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="f-bold">ORDER DETAILS</h6><br>
                                        <p>
                                            <strong>Order Number:</strong> {{ $order->order_id }}<br>
                                            <strong>Order Date:</strong> {{ date('d-m-Y', strtotime($order->created_at))  }}<br>
                                            <strong>Invoice Number:</strong> {{ $order->getInvoice->invoice_number }}<br>
                                            <strong>Invoice Date:</strong> {{ date('d-m-Y', strtotime($order->getInvoice->created_at)) }}<br>
                                            <strong>Order Status:</strong> @if($order->payment_staus !== 'Paid') <span class="badge badge-danger">Unpaid</span> @else <span class="badge badge-success">Paid</span> @endif

                                        </p>
                                    </div>
                                </div><br>
                                <div class="cart-table table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Thumbnail</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order_items as $item)
                                        <tr>
                                            <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="{{ asset($item['options']['product_image']) }}" alt="{{ $item['name'] }}"></a></td>
                                            <td class="pro-title"><a href="#">{{ $item['name'] }}</a></td>
                                            <td class="pro-price"><span>GHS {{ number_format($item['price'], 2) }}</span></td>
                                            <td class="pro-quantity">{{ $item['qty'] }}</td>
                                            <td class="pro-subtotal"><span>GHS {{ $item['subtotal'] }}</span></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="1">Order Note</td>
                                            <td colspan="4">{{ $order->order_note ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="borderless"></td>
                                            <td class="borderless"></td>
                                            <td class="borderless"></td>
                                            <td>SUBTOTAL</td>
                                            <td>GHS {{ number_format($order->sub_total, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="borderless"></td>
                                            <td class="borderless"></td>
                                            <td class="borderless"></td>
                                            <td>DISCOUNT</td>
                                            <td>GHS {{ number_format($order->discount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="borderless"></td>
                                            <td class="borderless"></td>
                                            <td class="borderless"></td>
                                            <td>SHIPPING</td>
                                            <td>GHS {{ number_format($order->shipping, 2) }}</td>
                                        </tr>

                                        <tr>
                                            <td class="borderless"></td>
                                            <td class="borderless"></td>
                                            <td class="borderless"></td>
                                            <td>NET TOTAL</td>
                                            <td>GHS {{ number_format($order->net_total, 2) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
@endsection

