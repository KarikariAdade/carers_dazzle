@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-10"><h4>Customers</h4></div>
            <div class="col-md-2" style="float:right;">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addProductModal"><span class="fa fa-plus-circle"></span> Add Customer</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
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

