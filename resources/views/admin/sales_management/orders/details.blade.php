@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-9"><h4>Order Details ({{ $order->order_id }})</h4></div>
            <div class="col-md-3" style="float:right;">

                {{--                <button class="btn btn-success" id="confirmPaymentBtn" data-toggle="modal" data-target="#confirmPaymentModal"><span class="fa fa-plus-circle"></span> Confirm Payment</button>--}}
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                    <div class="col-md-6 table-responsive p-3">
                        <table class=" table table-bordered table-striped">
                            <tr><td width="160"><h6><strong>CLIENT NAME</strong></h6></td><td style="font-size: 17px;">{{ $order->name }}</td></tr>
                            <tr><td width="160"><h6><strong>CLIENT EMAIL</strong></h6></td><td style="font-size: 17px;">{{ $order->email }}</td></tr>
                            <tr><td width="160"><h6><strong>CLIENT PHONE</strong></h6></td><td style="font-size: 17px;">{{ $order->getUser->phone ?? $order->phone ?? 'N/A'}}</td></tr>
                            <tr><td width="160"><h6><strong>PAYMENT TYPE</strong></h6></td><td style="font-size: 17px;">{{ ucfirst($order->payment_type) }}</td></tr>
                            <tr><td width="160"><h6><strong>ORDER NUMBER</strong></h6></td><td style="font-size: 17px;">{{ $order->order_id }}</td></tr>
                            <tr><td width="160"><h6><strong>INVOICE NUMBER</strong></h6></td><td style="font-size: 17px;">{{ $order->getInvoice->invoice_number ?? 'N/A' }}</td></tr>
                            <tr><td width="160"><h6><strong>ORDER STATUS</strong></h6></td>
                                @if($order->status === 'Paid')
                                    <td style="font-size: 17px;"><span class="badge badge-success">{{ $order->order_status }}</span></td>
                                @else
                                <td style="font-size: 17px;"><span class="badge badge-danger">{{ $order->order_status }}</span></td>
                                @endif
                            </tr>

                        </table>
                    </div>
                <div class="col-md-6 table-responsive p-3">
                    <table class=" table table-bordered table-striped">
                        <tr><td width="160"><h6><strong>STREET ADDRESS</strong></h6></td><td style="font-size: 17px;">{{ $order->street_address_1 ?? $order->street_address_2 ?? "N/A" }}</td></tr>
                        <tr><td width="160"><h6><strong>TOWN</strong></h6></td><td style="font-size: 17px;">{{ $order->getTown->name ?? 'N/A' }}</td></tr>
                        <tr><td width="160"><h6><strong>REGION</strong></h6></td><td style="font-size: 17px;">{{ $order->getRegion->phone ?? 'N/A'}}</td></tr>
                        <tr><td width="160"><h6><strong>ZIP CODE</strong></h6></td><td style="font-size: 17px;">{{ $order->zip_code ?? 'N/A' }}</td></tr>
                        <tr><td width="160"><h6><strong>ORDER NOTE</strong></h6></td><td style="font-size: 17px;">{{ $order->order_note }}</td></tr>

                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-10"><h4>Order Items</h4></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">

            </div>
            <table class="table table-bordered table-striped">
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
                        <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="{{ asset($item['options']['product_image']) }}" style="width:100px; height: 100px;" alt="{{ $item['name'] }}"></a></td>
                        <td class="pro-title"><a href="#">{{ $item['name'] }}</a></td>
                        <td class="pro-price"><span>GHS {{ number_format($item['price'], 2) }}</span></td>
                        <td class="pro-quantity">{{ $item['qty'] }}</td>
                        <td class="pro-subtotal"><span>GHS {{ $item['subtotal'] }}</span></td>
                    </tr>
                @endforeach
                <tr>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td>SUBTOTAL</td>
                    <td><b>GHS {{ number_format($order->sub_total, 2) }}</b></td>
                </tr>
                <tr>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td>DISCOUNT</td>
                    <td><b>GHS {{ number_format($order->discount, 2) }}</b></td>
                </tr>
                <tr>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td>SHIPPING</td>
                    <td><b>GHS {{ number_format($order->shipping, 2) }}</b></td>
                </tr>

                <tr>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td>NET TOTAL</td>
                    <td><b>GHS {{ number_format($order->net_total, 2) }}</b></td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

@endsection

