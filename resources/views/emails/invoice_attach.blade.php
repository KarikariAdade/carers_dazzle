@inject('shopHelper', 'App\Helpers\ShopHelper')
    <!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>

        .noborder td, .noborder th {
            border: none !important;
        }
        @media print {
            ::-webkit-scrollbar {
                width: 0px;
                background: transparent;
            }

            .terms{
                overflow-x: hidden !important;
                word-break: break-all !important;
            }

        }
    </style>
</head>
<body class="container">
<h4 style="text-align: center;">Carers Dazzle | Dansoman, Accra - Ghana | +233 24 532 2103</h4>
<h1 style="font-size:60px; text-align: center; width:90%; font-weight:bold">INVOICE</h1>
{{--<table style="margin-top: 10%;">--}}
{{--    <tr style="#background-color:red">--}}
{{--        <td><h1 style="font-size:60px; width:90%; font-weight:bold">INVOICE</h1></td>--}}
{{--        --}}
{{--    </tr>--}}
{{--</table>--}}


<table style="margin-top: 6%;">
    <tr style="#background-color:yellow">
        <td width="85%">
            <b>NAME</b>
            <br>
            <br>
            {{ $invoice->getOrder->name }}
        </td>

    </tr>
</table>
<hr>

<div class="col-md-12" style="padding-top:1%">
    <table class="table noborder" >
        <tr style="font-weight:bold; color: #FFA900; font-size: 18px;">
            <td>Invoice Date</td>
            <td>Invoice Number</td>
        </tr>

        <tr style="font-weight:bold">
            <td>{{ date('l M d, Y', strtotime($invoice->created_at)) }}</td>
            <td>{{ $invoice->invoice_number }}</td>
        </tr>
    </table>
</div>

<hr>
<div class="col-md-12" align=""  style="padding-top:1%; #background-color:green">
    <table class="">
        <tr>
            <td style="#font-weight:bold">
                <b>Billed To</b> :<br>

                <b>{{ $invoice->getOrder->name }}</b><br>
                {{ $invoice->getOrder->email  }}<br>
                {{ $invoice->getOrder->street_address_1 }}<br>
                {{ $invoice->getOrder->getTown->name ?? ' '.', '.$invoice->getOrder->getRegion->name ?? '' }}<br>
            </td>
            <td width="100"></td>
            <td width="100"></td>
            <td width="100"></td>
            <td width="100"></td>
            {{--                    <td style="#font-weight:bold">--}}
            {{--                        <b>Shipped To</b> :<br>--}}
            {{--                        @if($data->has_shipping_details == true)--}}
            {{--                            {!!   str_replace(',', '<br>', $data->shipping_details) !!}--}}
            {{--                        @else--}}
            {{--                            {{ $data->customer->company_name }},<br>--}}
            {{--                            {{ $data->customer->address }},<br>--}}
            {{--                            {{ $data->customer->city }}, {{ $data->customer->region->name }} - {{ $data->customer->country->name }}<br>--}}
            {{--                            {{ $data->customer->official_phone }},<br>--}}
            {{--                            {{ $data->customer->full_name() }}--}}
            {{--                            @endif--}}


            {{--                    </td>--}}
        </tr>
    </table>
</div>
<hr>
<div class="col-md-12 container" style="width: 100% !important;">
    <div class="" style="width: 100% !important;">
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Unit Price </th>
                <th>Quantity</th>
                <th>Amount </th>
            </tr>
            </thead>
            <tbody>
            @php $item_counter = 1; @endphp
            @foreach($invoice_items as $item)
                <tr>
                    <td>{{$item_counter++}}</td>
                    <td>
                        {{ $item['name'] }}
                    </td>
                    <td>{{ $shopHelper->calculateExchangeRate($item['price']) }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>
                        {{ $shopHelper->calculateExchangeRate($item['subtotal']) }}
                    </td>
                </tr>
            @endforeach


            {{--            @php $vat_total =  number_format ($data->vat_total, 2) @endphp--}}

            <tr class="noborder" style="background-color: white">
                <td></td>
                <td></td>
                <td></td>
                <td align="left" style="font-size:13px; font-weight:bold">SUB TOTAL</td>
                <td>{{ $shopHelper->calculateExchangeRate($invoice->getOrder->sub_total) }}</td>
            </tr>
            <tr class="noborder" style="background-color: white">
                <td></td>
                <td></td>
                <td></td>
                <td align="left" style="font-size:13px; font-weight:bold">DISCOUNT </td>
                <td>{{ $shopHelper->calculateExchangeRate($invoice->getOrder->discount) }}</td>

            </tr>
            <tr class="noborder" style="background-color: white">
                <td></td>
                <td></td>
                <td></td>
                <td align="left" style="font-size:13px; font-weight:bold">SHIPPING</td>
                <td>{{ $shopHelper->calculateExchangeRate($invoice->getOrder->shipping) }}</td>
            </tr>

            <tr class="noborder">
                <td></td>
                <td></td>
                <td></td>
                <td style="background-color: black;color:white; font-weight:bold"  align="left" style="font-size:20px">NET TOTAL</td>
                <td style="background-color: black;color:white; font-weight:bold">
                    {{ $shopHelper->calculateExchangeRate($invoice->getOrder->net_total) }}
                </td>
            </tr>
            </tbody>

        </table>

        <hr>


        @if(!empty($invoice->getOrder->order_notes))
            <div class="table-responsive">
                <div class="noborder" style="font-size: 13px;padding: 10px;">
                    <p style="font-weight: bold;">Remarks</p>
                    <p>{{ $invoice->getOrder->order_notes ?? 'N/A' }}</p>
                </div>
            </div>
        @endif
    </div>
</div>


</body>
</html>




