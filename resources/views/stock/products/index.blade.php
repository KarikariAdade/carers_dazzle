@extends('layouts.app')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
          <div class="col-md-10"><h4>Products</h4></div>
            <div class="col-md-2" style="float:right;">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addProductModal"><span class="fa fa-plus-circle"></span> Add Product</button>
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
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="productAddForm" action="{{ route('product.store') }}" method="POST">
                    <div class="modal-body row">
                        @method('POST')
                        @csrf
                        <div class="form-group col-md-4">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="editName">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-control">
                                <option></option>
                                @foreach($item['categories'] as $category)
                                    <option {{ old('category') == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Shelf <span class="text-danger">*</span></label>
                            <select name="shelf" class="form-control">
                                <option></option>
                                @foreach($items['shelves'] as $shelf)
                                    <option {{ old('category') == $shelf->id ? 'selected' : ''}} value="{{ $shelf->id }}">{{ $shelf->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Brand <span class="text-danger">*</span></label>
                            <select name="brand" class="form-control">
                                <option></option>
                                @foreach($items['brands'] as $brand)
                                    <option {{ old('brand') == $brand->id ? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" step="0.1" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Product Image </label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <label>Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-success">Update Category</button>
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

