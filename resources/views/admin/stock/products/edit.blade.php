@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <form id="updateProductForm" action="{{ route('product.update', $product->id) }}">
            @csrf
            @method('PATCH')
            <div class="card-header row">
                <div class="col-md-10"><h4>Update Product: {{ $product->name }}</h4></div>
                <div class="col-md-2" style="float:right;">
                    <button class="btn btn-success" type="submit"><span class="fa fa-plus-circle"></span> Update Product</button>
                </div>
            </div>
            <div class="card-body row">
                <div class="form-group col-md-4">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="editName" value="{{ $product->name }}">
                </div>
                <div class="form-group col-md-4">
                    <label>Category <span class="text-danger">*</span></label>

                    <select name="category" class="form-control select2">
                        <option></option>
                        @foreach($items['categories'] as $category)
                            <option {{ $product->category_id == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Sub Category <span class="text-danger">*</span></label>
                    <select name="sub_category" class="form-control select2">
                        <option></option>
                        @foreach($items['sub_categories'] as $shelf)
                            <option {{ $product->shelf_id == $shelf->id ? 'selected' : ''}} value="{{ $shelf->id }}">{{ $shelf->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Brand <span class="text-danger">*</span></label>
                    <select name="brand" class="form-control select2">
                        <option></option>
                        @foreach($items['brands'] as $brand)
                            <option {{ $product->brand_id == $brand->id ? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}">
                </div>
                <div class="form-group col-md-4">
                    <label>Price <span class="text-danger">*</span></label>
                    <input type="number" name="price" step="0.1" class="form-control" value="{{ $product->price }}">
                </div>
                <div class="form-group col-md-4">
                    <label>Taxes </label>
                    <select class="form-control" multiple="multiple" name="taxes[]" >
                        @foreach($items['taxes'] as $tax)
                            <option {{ in_array($tax->id, json_decode($product->taxes)) ? 'selected': null}} value="{{ $tax->id }}">{{ $tax->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Status</label>
                    <select class="status select2" name="status">
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Description</label>
                    <textarea class="form-control" name="description">{{ $product->description }}</textarea>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Product Image </label>
                        <input type="file" name="image[]" multiple class="form-control">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row" id="productImgSection">
                        @foreach($product->getPicture as $image)
                            <div class="col-md-2">
                                <a class="btn btn-danger btn-sm imgDelBtn" href="{{ route('product.delete.picture', $image->id) }}"><i class="fa fa-trash"></i></a>
                                <img src="{{ asset($image->path) }}" class="img-fluid" style="width:100%; height: 100%; border-radius: 10px;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
@push('custom-js')
    <script>

    </script>
@endpush

