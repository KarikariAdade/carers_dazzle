@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-9"><h4>Customer Details </h4></div>
            <div class="col-md-3" style="float:right;">

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 table-responsive p-3">
                    <table class=" table table-bordered table-striped">
                        <tr><td width="160"><h6><strong> NAME</strong></h6></td><td style="font-size: 17px;">{{ $customer->name }}</td></tr>
                        <tr><td width="160"><h6><strong> EMAIL</strong></h6></td><td style="font-size: 17px;">{{ $customer->email }}</td></tr>
                        <tr><td width="160"><h6><strong> PHONE</strong></h6></td><td style="font-size: 17px;">{{ $customer->phone }}</td></tr>
                        <tr><td width="160"><h6><strong>ADDRESS 1 </strong></h6></td><td style="font-size: 17px;">{{ $customer->street_address_1 ?? 'N/A' }}</td></tr>
                        <tr><td width="160"><h6><strong>ADDRESS 2</strong></h6></td><td style="font-size: 17px;">{{ $customer->street_address_1 ?? 'N/A' }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6 table-responsive p-3">
                    <table class=" table table-bordered table-striped">
                        <tr><td width="160"><h6><strong> REGION</strong></h6></td><td style="font-size: 17px;">{{ $customer->getRegion->name ?? "N/A" }}</td></tr>
                        <tr><td width="160"><h6><strong> TOWN</strong></h6></td><td style="font-size: 17px;">{{ $customer->getTown->name ?? "N/A" }}</td></tr>
                        <tr><td width="160"><h6><strong> ZIP CODE </strong></h6></td><td style="font-size: 17px;">{{ $customer->zip_code ?? "N/A" }}</td></tr>
                        <tr><td width="160"><h6><strong>PROFILE PICTURE </strong></h6></td><td style="font-size: 17px;">
                                @if(!empty($customer->profile_picture))
                                    <img src="{{ asset($customer->profile_picture) }}">
                                @else
                                N/A
                                @endif
                            </td></tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-9"><h4>Invoices</h4></div>
            <div class="col-md-3" style="float:right;">

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive p-3">
                    {!! $dataTable->table(['class' => 'table table-hover table-striped']) !!}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('custom-js')
    {!! $dataTable->scripts() !!}
@endpush
