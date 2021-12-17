@extends('layouts.app')
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

                    <select name="category" class="form-control">
                        <option></option>
                        @foreach($items['categories'] as $category)
                            <option {{ $product->category_id == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Shelf <span class="text-danger">*</span></label>
                    <select name="shelf" class="form-control">
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
                <div class="col-md-4">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Product Image </label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Old Product Image</label>
                            <img class="img-fluid" src="{{ asset($product->product_image) }}">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Description</label>
                    <textarea class="form-control" name="description">{{ $product->description }}</textarea>
                </div>
            </div>
        </form>
    </section>
@endsection

