@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header">
            <h4>Shipping Charges</h4>
        </div>
        <div class="card-body">
            <div class="errorMsg">

            </div>
            <form method="POST" class="row shipping_form" action="{{ route('product.shipping.store') }}">
                @method('POST')
                @csrf
                <div class="form-group col-md-3">
                    <label>Countries <span class="text-danger">*</span></label>
{{--                    <select class="select2 form-control" name="region" id="shippingRegion">--}}
                        <select class="select2 form-control" name="country" id="shippingRegion">

                        <option></option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Region <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="region" id="shippingTown">

                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label>Shipping Amount <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="amount">
                </div>
                <div class="form-group col-md-2">
                    <label>Set Default</label>
                    <select class="form-control select2" name="set_default">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-2 mt-4 pt-2">
                    <button type="submit" class="btn btn-success">Add Shipping</button>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12 table-responsive p-3">
                    {!! $dataTable->table(['class' => 'table table-hover table-striped']) !!}
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="editShippingModal" tabindex="-1" role="dialog" aria-labelledby="editShippingModal"
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
                        <div class="row">
                            <div class="form-group col-md-3">
                            <label>Country <span class="text-danger">*</span></label>
                            <select class="select2 form-control" name="region" id="shippingRegion">
                                <option></option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Region <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="town" id="shippingTown">

                            </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label>Shipping Amount <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="amount">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Set Default</label>
                                <select class="form-control select2" name="set_default">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-success">Update Shipping</button>
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
        $('.select2').select2();
        $('#shippingRegion').change(function () {
            if ($(this).val() !== ''){
                let url = `{{ route('product.shipping.get.town') }}`,
                    output = ``;

                $.post(url, {'item': $(this).val()}, function (response){
                    console.log(response)
                    if(!jQuery.isEmptyObject(response)){
                        $.each(response, function(i, town) {
                            output += `<option value="${town.id}">${town.name}</option>`;

                            $('#shippingTown').html(output)
                        });
                    }
                })
            }else{
                $('#shippingTown').html('')
            }


        })
    </script>
@endpush

