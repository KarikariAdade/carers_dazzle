@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header">
            <h4>Shipping Charges</h4>
        </div>
        <div class="card-body">
            <div class="errorMsg">

            </div>
            <form method="POST" class="row shipping_form" action="{{ route('product.shipping.update', $shipping->id) }}">
                @method('POST')
                @csrf
                <div class="form-group col-md-3">
                    <label>Region <span class="text-danger">*</span></label>
                    <select class="select2 form-control" name="region" id="shippingRegion">
                        <option></option>
                        @foreach($regions as $region)
                            <option {{ $region->id == $shipping->region_id ? 'selected' : null }} value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Town <span class="text-danger">*</span></label>
                    <select class="form-control select2" id="shippingTown" name="town">
                        <option selected value="{{ $shipping->town_id }}">{{ $shipping->getTown->name }}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Shipping Amount <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="amount" value="{{ $shipping->amount }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Set Default</label>
                    <select class="form-control select2" name="set_default">
                        <option></option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-3 mt-4 pt-2">
                    <button type="submit" class="btn btn-success">Add Shipping</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('custom-js')
    <script>
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

