@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-10"><h4>Invoice</h4></div>
            <div class="col-md-2" style="float:right;">
                <a class="btn btn-primary" href=""><span class="fa fa-plus-circle"></span> Create Invoice</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 form-group">
                    <label>Payment Status</label>
                    <select class="select2 form-control" id="status">
                        <option></option>
                        <option value="Pending Payment">Not Paid</option>
                        <option value="Paid">Paid</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label>From</label>
                    <input type="date" class="form-control" id="from">
                </div>
                <div class="col-md-3 form-group">
                    <label>To</label>
                    <input type="date" class="form-control" id="to">
                </div>
                <div class="col-md-3 mt-4">
                    <button class="btn mt-1 btn-success" id="generate">Generate Entries</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive p-3">
                    {!! $dataTable->table(['class' => 'table table-hover table-striped']) !!}
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="verifyPaymentModal" tabindex="-1" role="dialog" aria-labelledby="verifyPaymentModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="confirmPaymentForm" action="" method="POST">
                    <div class="modal-body">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label>Transaction ID</label>
                            <input type="text" name="transaction_id" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-success">Confirm Payment</button>
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
        $(document).ready(function () {
            const datatable = $('#dataTable');
            $('#generate').on('click', function () {
                datatable.on('preXhr.dt', function (e, settings, data) {
                    data.status = $('#status').val();
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                });
                datatable.DataTable().ajax.reload();
                return false;
            });
        });
    </script>
@endpush

