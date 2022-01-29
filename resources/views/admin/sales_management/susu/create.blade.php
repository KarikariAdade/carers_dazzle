@extends('layouts.admin')
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/css/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jsgrid-theme.css') }}">
@endpush
@section('content')
    <section class="container card card-primary">
        <form method="POST" action="">
            @csrf
            @method('POST')
            <div class="card-header row">
                <div class="col-md-9"><h4>Susu Contribution</h4></div>
                <div class="col-md-3" style="float:right;">
                    <button class="btn btn-primary" type="submit"><span class="fa fa-plus-circle"></span> Add Contribution</button>
                </div>
            </div>
        <div class="card-body row">
            <div class="col-md-5 row form-group">
                <div class="col-md-11">
                    <label>Customer <em class="text-danger">*</em></label>
                    <select name="customer" class="form-control select2" id="customer">
                        <option></option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 mt-4"><button type="button" data-toggle="modal" data-target="#addCustomerModal" class="btn mt-1 btn-primary"><span class="fa fa-plus-circle"></span></button></div>

            </div>
            <hr class="mt0 mb15"/>
                <div class="col-md-12">

                    <div class="table-responsive">

                        <table id="mainTable" class="table table-bordered">
                            <thead class="text-center">
                            <tr>
                                <th>Product/Service </th>
                                <th>Description</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                        <a href="javascript:void(0);" class="btn btn-primary mt-3 mb-3" id="add_prod_btn"><span class="fa fa-plus-circle"></span> Add Line Item</a>
                </div>
            </div>
            {{--                <div style="overflow-x: auto;">--}}
            {{--                    <div id="grid"></div>--}}
            {{--                </div>--}}
            <hr class="mt10 mb15">
        </div>
        </form>
    </section>
    <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="addSusuCustomer" action="{{ route('sales.customer.store') }}" method="POST">
                    <div class="modal-body row">
                        @method('POST')
                        @csrf
                        <input type="text" name="source" value="susu">
                        <div class="form-group col-md-4">
                            <label>Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" class="form-control" id="editName">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-success">Add Customer</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
    @include('admin.sales_management.table_scripts')

@endpush
