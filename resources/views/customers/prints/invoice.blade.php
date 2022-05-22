<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            padding: 0 5%;
        }
        .mb-5{
            margin-bottom: 4%;
        }
        .text-right{
            float: right;
        }
        .table-responsive{
            width: 800px;
            display: block;
        }
        table{
            margin-top: 5%;
            width:700px;
        }

        table tr{
            text-align: center;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th{
            border-right: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
        }
        table tr td, table tr th{
            padding: 10px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,0.02);
        }
        .c-brown{
            color: sandybrown;
        }
        .invoice_type{
            font-size: 55px;
        }
        .invoice_sub_details h1{
            font-weight: bold;
        }
        .invoice_sub_details p{
            margin-top: -15px;
        }
        *{
            font-family: Sans-Serif, serif;
        }
        .row{
            display:flex !important;
            width: 100%;
        }
        .row .col-md-4{
            width: 100%;
        }
        .col-lg-12{
            width: 100%;
        }
        .invoice_sub_details.mt-5 h4{
            font-size: 20px;
        }
        .invoice_sub_details .col-md-4 h4{
            font-size: 20px;
        }
        .invoice-total{
            font-size: 17px;
            text-align: justify;
        }

        .invoice-total span{
            float: right;
            margin-left: 10px;
            font-weight: normal;
        }
        img{
            width: 200px !important;
            height: 200px !important;
            margin-top: -10% !important;
        }
        #invoice-section{
            position: absolute !important;
            right: 5% !important;
            top:20% !important;
        }
        .column-3 {
            float: left;
            width: 33.333%;
            font-size: 20px;
        }

        .column-2{
            float: left;
            width: 50%;
            font-size: 17px;
        }

        .row h4{
            font-weight: bold;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>

<div class="section-body p-3">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h1 class="invoice_type">Invoice</h1>
                        <div id="invoice-section" style="float: right; margin-top: -25%;">
                            <h4>Carers Dazzle <br>Dansoman, Accra - Ghana<br>+233 24 532 2103</h4>
{{--                            <img class="img-flid" width="400"  style="" alt="AVATAR" src="{{asset("logo.png")}}">--}}
                            <div class="col-md-4" style="font-size: 18px;"><br><br>
                                <address>
                                    <b>{{ $invoice->getOrder->name }}</b><br>
                                    {{ $invoice->getOrder->email }}<br>
                                    {{ $invoice->getOrder->street_address_1 }},<br>
                                    {{ $invoice->getOrder->getTown->name ?? ' '.', '.$invoice->getOrder->getRegion->name ?? ' '}}<br>
                                </address>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex;">
                        <div style="font-size: 18px; margin-top: 5% !important;">
                            <b>Name</b>
                            <p>{{ $invoice->getOrder->name }}</p>
                        </div>
                        {{--                        <div class="" style="margin-top: -10.5%; font-size: 20px; padding-left: 65%">--}}
                        {{--                            <h4>Quotation Date</h4>--}}
                        {{--                            <p>{{ \Carbon\Carbon::now()->format('D, d F Y') }}</p>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="row mb-4 mt-4" style="width: 90%;">
                        <div class="column-3">
                            <h4 class="c-brown">Invoice Date</h4>
                            <p>{{ date('l M d, Y', strtotime($invoice->created_at)) }}</p>
                        </div>
                        <div class="column-3">
                            <h4 class="c-brown">Invoice Number</h4>
                            <p>{{ $invoice->invoice_number }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Unit Price (GHS)</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoice_items as $item)
                                <tr class="table-bordered">
                                    <td>
                                        {{ $item['name'] }}
                                    </td>
                                    <td>
                                       {{ $item['price'] }}
                                    </td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>
                                        {{ $item['subtotal'] }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="" style="margin-left: 50%;">
                        <div class="invoice-total">
                            <h4>Subtotal: <span>GHS {{ number_format($invoice->getOrder->sub_total, 2) }}</span></h4>
                        </div>
                            <div class="invoice-total">
                                <h4>Discount: <span>GHS {{ number_format($invoice->getOrder->discount, 2) }}</span></h4>
                            </div>
                        <div class="invoice-total">
                            <h4>Shipping: <span>GHS {{ number_format($invoice->getOrder->shipping, 2) }}</span></h4>
                        </div>
                        <div class="invoice-total" style="background: black;color: #fff; padding: 3px;">
                            <h4>Net Total: <span style="font-weight: bold;">GHS {{ number_format($invoice->getOrder->net_total, 2) }}</span></h4>
                        </div>
                    </div>
                    <div style="width:100%; display: inline-block;">
                       @if(!empty($invoice->getOrder->order_notes))
                            <div class="mb-5">
                                <h4>Remarks</h4>
                                <p>{{ $invoice->getOrder->order_notes }}</p>
                            </div>
                        @endif
                        <div class="mb-5">
                                <h4>Payment Options</h4>
                                <p>{{ ucwords(str_replace('_', ' ', $invoice->getOrder->payment_type)) }}</p>
                        </div>

{{--                            <div class="mb-5">--}}
{{--                                <h4>Terms & Conditions</h4>--}}
{{--                                <p style="width: 80%;">Terms and condition</p>--}}
{{--                            </div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


