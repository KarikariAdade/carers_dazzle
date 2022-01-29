@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-9"><h4>Order Details ({{ $invoice->invoice_number }})</h4></div>
            <div class="col-md-3" style="float:right;">

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 table-responsive p-3">
                    <table class=" table table-bordered table-striped">
                        <tr><td width="160"><h6><strong>CLIENT NAME</strong></h6></td><td style="font-size: 17px;">{{ $invoice->getOrder->name }}</td></tr>
                        <tr><td width="160"><h6><strong>CLIENT EMAIL</strong></h6></td><td style="font-size: 17px;">{{ $invoice->getOrder->email }}</td></tr>
                        <tr><td width="160"><h6><strong>CLIENT PHONE</strong></h6></td><td style="font-size: 17px;">{{ $invoice->getOrder->getUser->phone ?? $order->phone ?? 'N/A'}}</td></tr>
                        <tr><td width="160"><h6><strong>PAYMENT TYPE</strong></h6></td><td style="font-size: 17px;">{{ ucfirst($invoice->payment_type) }}</td></tr>
                        <tr><td width="160"><h6><strong>INVOICE NUMBER</strong></h6></td><td style="font-size: 17px;">{{ $invoice->getOrder->order_id }}</td></tr>
                        <tr><td width="160"><h6><strong>INVOICE NUMBER</strong></h6></td><td style="font-size: 17px;">{{ $invoice->invoice_number ?? 'N/A' }}</td></tr>
                        <tr><td width="160"><h6><strong>INVOICE STATUS</strong></h6></td>
                            @if($invoice->payment_status === 'Paid')
                                <td style="font-size: 17px;"><span class="badge badge-success shadow shadow-success">{{ $invoice->payment_status }}</span></td>
                            @else
                                <td style="font-size: 17px;"><span class="badge badge-danger shadow shadow-danger">{{ $invoice->payment_status }}</span></td>
                            @endif
                        </tr>

                    </table>
                </div>
                <div class="col-md-6 table-responsive p-3">
                    <table class=" table table-bordered table-striped">
                        <tr><td width="160"><h6><strong>STREET ADDRESS</strong></h6></td><td style="font-size: 17px;">{{ $invoice->getOrder->street_address_1 ?? $order->street_address_2 ?? "N/A" }}</td></tr>
                        <tr><td width="160"><h6><strong>TOWN</strong></h6></td><td style="font-size: 17px;">{{ $invoice->getOrder->getTown->name ?? 'N/A' }}</td></tr>
                        <tr><td width="160"><h6><strong>REGION</strong></h6></td><td style="font-size: 17px;">{{ $invoice->getOrder->getRegion->phone ?? 'N/A'}}</td></tr>
                        <tr><td width="160"><h6><strong>ZIP CODE</strong></h6></td><td style="font-size: 17px;">{{ $invoice->getOrder->zip_code ?? 'N/A' }}</td></tr>
                        <tr><td width="160"><h6><strong>ORDER NOTE</strong></h6></td><td style="font-size: 17px;">{{ $invoice->getOrder->order_note }}</td></tr>

                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-10"><h4>Invoice Items</h4></div>
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
                @foreach($invoice_items as $item)
                    <tr>
                        <td class="pro-thumbnail"><a href="{{ route('product.details', $item['id']) }}"><img class="img-fluid" src="{{ asset($item['options']['product_image']) }}" style="width:100px; height: 100px;" alt="{{ $item['name'] }}"></a></td>
                        <td class="pro-title"><a href="{{ route('product.details', $item['id']) }}">{{ $item['name'] }}</a></td>
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
                    <td><b>GHS {{ number_format($invoice->getOrder->sub_total, 2) }}</b></td>
                </tr>
                <tr>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td>DISCOUNT</td>
                    <td><b>GHS {{ number_format($invoice->getOrder->discount, 2) }}</b></td>
                </tr>
                <tr>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td>SHIPPING</td>
                    <td><b>GHS {{ number_format($invoice->getOrder->shipping, 2) }}</b></td>
                </tr>

                <tr>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td class="borderless"></td>
                    <td>NET TOTAL</td>
                    <td><b>GHS {{ number_format($invoice->getOrder->net_total, 2) }}</b></td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

@endsection

