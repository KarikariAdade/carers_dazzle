@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-10"><h4>Orders</h4></div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 form-group">
                    <label>Order Status</label>
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
