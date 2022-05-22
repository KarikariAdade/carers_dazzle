@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-10"><h4>Payment Report</h4></div>
{{--            <div class="col-md-2" style="float:right;">--}}
{{--                <button class="btn btn-primary" data-toggle="modal" data-target="#addProductModal"><span class="fa fa-file-invoice"></span> View Invoices</button>--}}
{{--            </div>--}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-green">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                            <div class="card-content">
                                <h5 class="card-title">All Payment ({{ $daily_orders[0]->count }})</h5>
                                <span>GHS {{ number_format($daily_orders[0]->net_total) ?? 0.00 }}</span>
{{--                                <p class="mb-0 text-sm">--}}
{{--                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>--}}
{{--                                    <span class="text-nowrap">Since last month</span>--}}
{{--                                </p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-red">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                            <div class="card-content">
                                <h5 class="card-title">Failed Payment ({{ $unpaid_orders[0]->count }})</h5>
                                <span>GHS {{ number_format($unpaid_orders[0]->net_total) ?? 0.00 }}</span>
                                {{--                                <p class="mb-0 text-sm">--}}
                                {{--                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>--}}
                                {{--                                    <span class="text-nowrap">Since last month</span>--}}
                                {{--                                </p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-green">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                            <div class="card-content">
                                <h5 class="card-title">Successful Payment ({{ $paid_orders[0]->count }})</h5>
                                <span>GHS {{ number_format($paid_orders[0]->net_total, 2) ?? 0.00 }}</span>
                                {{--                                <p class="mb-0 text-sm">--}}
                                {{--                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>--}}
                                {{--                                    <span class="text-nowrap">Since last month</span>--}}
                                {{--                                </p>--}}
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="col-md-12 table-responsive p-3">--}}
{{--                    {!! $dataTable->table(['class' => 'text-center table table-hover table-striped']) !!}--}}
{{--                </div>--}}

                <div class="card-body">
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                            {{--                                        <div class="row" style="padding-left: 15px">--}}
                            <form class="row"  action="" method="GET">

                                <div class="col-md-4" style="padding-right: 10px">
                                    <label>Start Date</label>
                                    <input class="form-control" type="date" name="start_month" id="start_month" value="{{request()->start_month}}">
                                </div>
                                <div class="col-md-4" style="padding-right: 10px">
                                    <label>End Date</label>
                                    <input class="form-control" type="date" name="end_month" id="end_month" value="{{request()->end_month}}">
                                </div>
                                <div class="col-md-4" style="margin-top: 35px">
                                    <button type="submit" class="btn btn-primary">Generate</button>
                                </div>


                            </form>

                            {{--                                        </div>--}}
                            <br>
                            <div class="table-responsive">
                                {!! $dataTable->table(['class' => 'table','id'=>'dataTable']) !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@push('custom-js')
    {!! $dataTable->scripts() !!}
@endpush

