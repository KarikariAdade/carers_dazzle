@extends('layouts.admin')
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/css/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jsgrid-theme.css') }}">
    @endpush
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
                <div class="col-md-12 table-responsive p-3" id="jsGrid">
{{--                    {!! $dataTable->table(['class' => 'table table-hover table-striped']) !!}--}}
                </div>
                <div id="detailsDialog"></div>
                <form id="detailsForm"></form>
            </div>
        </div>
    </section>
@endsection
@push('custom-js')
    <script src="{{ asset('assets/js/jsgrid.min.js') }}"></script>
    <script>
        var clients = [
            { "Name": "Otto Clay", "Age": 25, "Country": 1, "Address": "Ap #897-1459 Quam Avenue", "Married": false },
            { "Name": "Connor Johnston", "Age": 45, "Country": 2, "Address": "Ap #370-4647 Dis Av.", "Married": true },
            { "Name": "Lacey Hess", "Age": 29, "Country": 3, "Address": "Ap #365-8835 Integer St.", "Married": false },
            { "Name": "Timothy Henson", "Age": 56, "Country": 1, "Address": "911-5143 Luctus Ave", "Married": true },
            { "Name": "Ramona Benton", "Age": 32, "Country": 3, "Address": "Ap #614-689 Vehicula Street", "Married": false }
        ];

        var countries = [
            { Name: "", Id: 0 },
            { Name: "United States", Id: 1 },
            { Name: "Canada", Id: 2 },
            { Name: "United Kingdom", Id: 3 }
        ];

        $("#jsGrid").jsGrid({
            width: "100%",
            height: "400px",

            inserting: true,
            editing: true,
            sorting: true,
            paging: true,

            data: clients,

            fields: [
                { name: "Name", type: "text", width: 150, validate: "required" },
                { name: "Age", type: "number", width: 50 },
                { name: "Address", type: "text", width: 200 },
                { name: "Country", type: "select", items: countries, valueField: "Id", textField: "Name" },
                { name: "Married", type: "checkbox", title: "Is Married", sorting: false },
                { type: "control" }
            ]
        });
    </script>
    {{--    {!! $dataTable->scripts() !!}--}}
@endpush
