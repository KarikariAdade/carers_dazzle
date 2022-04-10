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
                                            <th>Invoice ID</th>
                                            <th>Payment Status</th>
                                            <th>Payment Type</th>
                                            <th>Order ID</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->invoice_number }}</td>
                                                <td>{{ $invoice->payment_status }}</td>
                                                <td>{{ ucwords(str_replace('_', ' ', $invoice->payment_type)) }}</td>
                                                <td>{{ $invoice->getOrder->order_id ?? "N/A" }}</td>
                                                <td>
                                                    <a class="btn btn-primary" href="{{ $invoice->generateRoute() }}" style="min-width: 10px;"><i class="fa fa-eye"></i></a>
                                                    <a class="btn btn-success" href="{{ $invoice->generatePrintRoute() }}" style="min-width: 10px;"><i class="fa fa-file-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $invoices->links('vendor.pagination.bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
