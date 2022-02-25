@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <form action="{{ route('invoice.store') }}" id="invoice" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card-header row">
                <div class="col-md-10"><h4>Create Invoice</h4></div>
                <div class="col-md-2" style="float:right;">
                    <button class="btn btn-success" type="submit"><span class="fa fa-plus-circle"></span> Create Invoice</button>
                </div>
            </div>
            <div class="card-body row">
                <div class="col-md-12">
                    @include('layouts.errors')
                </div>
                <div class="col-md-5 row form-group">
                    <div class="col-md-9">
                        <label>Customer <em class="text-danger">*</em></label>
                        <select name="customer" class="form-control select2" id="customer">
                            <option></option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
{{--                    <div class="col-md-2 mt-4"><button type="button" data-toggle="modal" data-target="#addCustomerModal" class="btn mt-1 btn-primary"><span class="fa fa-plus-circle"></span></button></div>--}}
                </div>
                <div class="col-md-3">
                    <label>Shipping Fee <em class="text-danger">*</em></label>
                    <input type="number" class="form-control" id="shipping_fee" value="0">
                </div>
                <div class="col-md-3">
                    <label>Discount Type </label>
                    <select name="customer" class="form-control select2" id="discount_type">
                        <option></option>
                        <option value="percentage">Percentage</option>
                        <option value="fixed">Fixed Amount</option>
                    </select>
                </div>
                <div class="col-md-3 mb-5">
                    <label>Discount Amount </label>
                    <input type="number" class="form-control" id="discount_amount">
                </div>
                <div class="col-md-3">
                    <label>Payment Type <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="payment_type" id="payment_type">
                        <option value="momo">Mobile Money</option>
                        <option value="on_credit">Susu (Credit Payment)</option>
                        <option value="cash">Payment On Delivery</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Payment Status <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="payment_status" id="payment_status">
                        <option>Paid</option>
                        <option>Pending Payment</option>
                    </select>
                </div>
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

                <hr class="mt10 mb15">
                <div class="col-md-3">
                    <label>Sub Total</label>
                    <input type="text" readonly id="all_sub_total" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Net Total</label>
                    <input type="text" readonly id="all_net" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Shipping</label>
                    <input type="text" readonly id="shipping" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Discount Total</label>
                    <input type="text" readonly id="discount_total" class="form-control">
                </div>
            </div>
        </form>
    </section>
@endsection
@push('custom-js')
    @include('admin.sales_management.invoice.invoice_script')

@endpush
