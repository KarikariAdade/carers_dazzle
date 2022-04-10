@extends('layouts.pages')
@section('content')
    @inject('shopHelper', 'App\Helpers\ShopHelper')
    @push('custom-css')
        <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    @endpush
    <div class="page-header mt-5 text-center" style="background-image: url({{ asset('assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">Dashboard<span>Account</span></h1>
        </div>
    </div>

    <div class="page-content mt-5">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('layouts.customers')
                        <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-9">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad">
                                    <div class="myaccount-content">
                                        <div class="col-md-12 table-responsive p-3">
                                            <table class="table table-hover table-bordered text-center">
                                                <thead>
                                                <tr style="border: 1px solid #ccc;">
                                                    <th>Order ID</th>
                                                    <th>Order Status</th>
                                                    <th>Payment Type</th>
                                                    <th>Invoice</th>
                                                    <th>Items</th>
                                                    <th>Net Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $order)
                                                <tr>
                                                    <td>{{ ucfirst($order->order_id) }}</td>
                                                    <td>{{ ucfirst($order->order_status) }}</td>
                                                    <td>{{ ucwords(str_replace('_', ' ', $order->payment_type)) ?? "N/A" }}</td>
                                                    <td>{{ $order->getInvoice->invoice_number ?? "N/A" }}</td>
                                                    <td>
                                                        @php
                                                            $item_count = 0;
                                                            foreach (json_decode($order->meta, true) as $item => $row){
                                                                $item_count += $row['qty'];
                                                            }
                                                        @endphp
                                                        {{ $item_count }}
                                                    </td>
                                                    <td>{{ $shopHelper->calculateExchangeRate($order->net_total) }}</td>
                                                    <td>
                                                        <a class="btn btn-primary" href="{{ $order->generateRoute() }}" style="min-width: 10px;"><i class="fa fa-eye"></i></a>
                                                        @if(!empty($order->getInvoice))
                                                        <a class="btn btn-danger" href="{{ $order->getInvoice->generateRoute() }}" style="min-width: 10px;"><i class="fa fa-file-alt"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{ $orders->links('vendor.pagination.bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
@endsection
