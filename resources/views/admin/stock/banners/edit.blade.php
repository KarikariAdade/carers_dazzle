@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <form id="updateBannerForm" action="{{ route('product.banner.update', $banner->id) }}">
            @csrf
            @method('POST')
            <div class="card-header row">
                <div class="col-md-9"><h4>Update Promotional Banner: {{ $banner->name }}</h4></div>
                <div class="col-md-3" style="float:right;">
                    <button class="btn btn-success" type="submit"><span class="fa fa-plus-circle"></span> Update Promotional Banner</button>
                </div>
            </div>

            <div class="card-body row">
                <div class="form-group col-md-4">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $banner->name }}">
                </div>
                <div class="form-group col-md-4">
                    <label>Banner </label>
                    <input type="file" name="banner" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Feature as Slider</label>
                    <select name="slider_feature" class="form-control select2">
                        <option></option>
                        <option value="1">Yes, Feature</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Mark Active</label>
                    <select name="mark_active" class="form-control select2">
                        <option></option>
                        <option value="1">Yes, Mark Active</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Associated Product</label>
                    <select multiple="multiple" class="form-control select2" name="associated_product[]">
                        @foreach($products as $product)
                            <option value="{{ in_array($product->id, json_decode($banner->product_id)) ? 'selected' : null }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Description</label>
                    <textarea class="form-control" name="description">{{$banner->description}}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>Header Message</label>
                    <textarea class="form-control" name="header_message">{{$banner->header_message}}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>Footer Message</label>
                    <textarea class="form-control" name="footer_message">{{$banner->footer_message}}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>Content Message</label>
                    <textarea class="form-control" name="content_message">{{$banner->content_message}}</textarea>
                </div>
            </div>

        </form>
    </section>
@endsection
