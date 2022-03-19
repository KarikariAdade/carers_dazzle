@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-10"><h4>Today's Sales</h4></div>
            <div class="col-md-2" style="float:right;">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addProductModal"><span class="fa fa-file-invoice"></span> View Invoices</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-green">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Today's Orders ({{ $pageData['daily_orders'][0]->count }})</h4>
                                <span>GHS {{ number_format($pageData['daily_orders'][0]->net_total) ?? 0.00 }}</span>
{{--                                <p class="mb-0 text-sm">--}}
{{--                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>--}}
{{--                                    <span class="text-nowrap">Since last month</span>--}}
{{--                                </p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-red">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Unpaid Orders ({{ $pageData['unpaid_orders'][0]->count }})</h4>
                                <span>GHS {{ number_format($pageData['unpaid_orders'][0]->net_total) ?? 0.00 }}</span>
                                {{--                                <p class="mb-0 text-sm">--}}
                                {{--                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>--}}
                                {{--                                    <span class="text-nowrap">Since last month</span>--}}
                                {{--                                </p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-green">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Paid Orders ({{ $pageData['paid_orders'][0]->count }})</h4>
                                <span>GHS {{ number_format($pageData['paid_orders'][0]->net_total, 2) ?? 0.00 }}</span>
                                {{--                                <p class="mb-0 text-sm">--}}
                                {{--                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>--}}
                                {{--                                    <span class="text-nowrap">Since last month</span>--}}
                                {{--                                </p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 table-responsive p-3">
                    {!! $dataTable->table(['class' => 'text-center table table-hover table-striped']) !!}
                </div>
            </div>
        </div>
    </section>

@endsection
@push('custom-js')
    {!! $dataTable->scripts() !!}
@endpush

