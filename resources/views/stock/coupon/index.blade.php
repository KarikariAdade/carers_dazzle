@extends('layouts.app')
@section('content')
    <section class="container card card-primary">
        <div class="card-header">
            <h4>Coupons</h4>
        </div>
        <div class="card-body">
            <div class="errorMsg">

            </div>
            <form method="POST" class="row coupon_form" action="{{ route('product.coupon.store') }}">
                @method('POST')
                @csrf
                <div class="form-group col-md-3">
                    <label>Coupon Name / Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group col-md-2">
                    <label>Amount Type <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="amount_type">
                        <option value="percentage">Percentage</option>
                        <option value="fixed">Fixed</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label>Amount <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="amount">
                </div>
                <div class="form-group col-md-3">
                    <label>Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="col-md-2 mt-4 pt-2">
                    <button type="submit" class="btn btn-success">Add Coupon</button>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12 table-responsive p-3">
                    {!! $dataTable->table(['class' => 'table table-hover table-striped']) !!}
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="editShelfModal" tabindex="-1" role="dialog" aria-labelledby="editShelfModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="updateCouponForm" action="" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="editName">
                        </div>
                       <div class="row">
                           <div class="form-group col-md-6">
                               <label>Amount Type <span class="text-danger">*</span></label>
                               <select class="form-control select2" name="amount_type" id="editAmountType">
                                   <option></option>
                                   <option value="percentage">Percentage</option>
                                   <option value="fixed">Fixed</option>
                               </select>
                           </div>
                           <div class="form-group col-md-6">
                               <label>Amount <span class="text-danger">*</span></label>
                               <input class="form-control" name="amount" id="editAmount">
                           </div>
                       </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="editDescription"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-success">Update Shelf</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
    {!! $dataTable->scripts() !!}
    <script>

    </script>
@endpush

