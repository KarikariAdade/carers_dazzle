@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-9"><h4>Promotional Banners</h4></div>
            <div class="col-md-3" style="float:right;">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addPromotionalBanner"><span class="fa fa-plus-circle"></span> Add Promotional Banner</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive p-3">
                    {!! $dataTable->table(['class' => 'table table-hover table-striped']) !!}
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="addPromotionalBanner" tabindex="-1" role="dialog" aria-labelledby="addPromotionalBanner"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="addBannerForm" action="{{ route('product.banner.store') }}" method="POST">
                    <div class="modal-body row">
                        @method('POST')
                        @csrf
                        <div class="form-group col-md-6">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Banner <span class="text-danger">*</span></label>
                            <input type="file" name="banner" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Feature as Slider</label>
                            <select name="slider_feature" class="form-control select2">
                                <option></option>
                                <option value="1">Yes, Feature</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mark Active</label>
                            <select name="mark_active" class="form-control select2">
                                <option></option>
                                <option value="1">Yes, Mark Active</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Associated Product</label>
                            <select multiple="multiple" class="form-control select2" name="associated_product[]">
{{--                                <option></option>--}}
                                @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-success">Add Banner</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
    {!! $dataTable->scripts() !!}

@endpush

