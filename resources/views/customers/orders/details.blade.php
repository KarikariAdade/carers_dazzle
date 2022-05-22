@extends('layouts.pages')
@section('content')
    @inject('shopHelper', 'App\Helpers\ShopHelper')
    @push('custom-css')
        <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
        <style>
            .borderless {
                border:none;
            }
        </style>
    @endpush
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
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-9">
                                <h4 class="mb-10 f-bold">Order Details ({{ $order->order_id }})</h4>
                                <div class="row mt-5">
                                    <div class="col-md-6 mb-5">
                                        <h6 class="f-bold">SHIPPING DETAILS</h6><br>
                                        <p>
                                            {{ $order->name }}<br>
                                            {{ $order->getRegion->name ?? ' '.', '.$order->getTown->name ?? ' ' }}<br>
                                            @if(!empty($order->user_id))
                                            @if(!empty($order->getUser->phone))
                                                    {{ $order->getUser->phone }}<br>
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
                                            @if(!empty($order->getInvoice))
                                            <strong>Invoice Number:</strong> {{ $order->getInvoice->invoice_number }}<br>
                                            <strong>Invoice Date:</strong> {{ date('d-m-Y', strtotime($order->getInvoice->created_at)) }}<br>
                                            @endif
                                            <strong>Order Status:</strong> @if($order->order_status !== 'Paid') <span class="badge badge-danger">Unpaid</span> @else <span class="badge badge-success">Paid</span> @endif

                                        </p>
                                    </div>
                                </div><br>
                                <div class="cart-table table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                        <tr style="border: 1px solid #ccc;">
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
                                            <td class="pro-thumbnail p-3">
                                                <a href="#">
                                                    <img class="img-fluid" src="{{ asset($item['options']['product_image']) }}" alt="{{ $item['name'] }}" style="width:100%; height:100px; border-radius: 10px;">
                                                </a>
                                            </td>
                                            <td class="pro-title"><a href="#">{{ $item['name'] }}</a></td>
                                            <td class="pro-price"><span> {{ $shopHelper->calculateExchangeRate($item['price']) }}</span></td>
                                            <td class="pro-quantity">{{ $item['qty'] }}</td>
                                            <td class="pro-subtotal"><span> {{ $shopHelper->calculateExchangeRate($item['subtotal']) }}</span></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="1">Order Note</td>
                                            <td colspan="4">{{ $order->order_note ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="borderless" colspan="3"></td>
                                            <td>SUBTOTAL</td>
                                            <td>GHS {{ $shopHelper->calculateExchangeRate($order->sub_total) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="borderless" colspan="3"></td>
                                            <td>DISCOUNT</td>
                                            <td>GHS {{ $shopHelper->calculateExchangeRate($order->discount) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="borderless" colspan="3"></td>
                                            <td>SHIPPING</td>
                                            <td>GHS {{ $shopHelper->calculateExchangeRate($order->shipping) }}</td>
                                        </tr>

                                        <tr>
                                            <td class="borderless" colspan="3"></td>
                                            <td>NET TOTAL</td>
                                            <td>GHS {{ $shopHelper->calculateExchangeRate($order->net_total) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
@endsection

