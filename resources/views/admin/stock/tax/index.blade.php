@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header">
            <h4>Product</h4>
        </div>
        <div class="card-body">
            <div class="errorMsg">

            </div>
            <form method="POST" class="row taxForm" action="{{ route('product.tax.store') }}">
                @method('POST')
                @csrf
                <div class="form-group col-md-3">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group col-md-3">
                    <label>Tax Amount <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" name="amount">
                </div>
                <div class="form-group col-md-4">
                    <label>Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="col-md-2 mt-4 pt-2">
                    <button type="submit" class="btn btn-success">Add Tax</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Update Tax</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="updateTaxForm" action="" method="POST">
                    <div class="modal-body">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="editName">
                        </div>
                        <div class="form-group">
                            <label>Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="amount" class="form-control" id="editAmount">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="editDescription"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-success">Update Tax</button>
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

