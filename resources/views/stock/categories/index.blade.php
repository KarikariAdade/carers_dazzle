@extends('layouts.app')
@section('content')
    <section class="container card card-primary">
        <div class="card-header">
            <h4>Product Categories</h4>
        </div>
        <div class="card-body">
            <div class="errorMsg">

            </div>
            <form class="row product_category_form" action="{{ route('product.category.store') }}">
                @method('POST')
                @csrf
                <div class="form-group col-md-5">
                    <label>Category Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group col-md-5">
                    <label>Category Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="col-md-2 mt-4 pt-2">
                    <button type="submit" class="btn btn-success">Add Category</button>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12 table-responsive p-3">
                    {!! $dataTable->table(['class' => 'table table-hover table-striped']) !!}
                </div>
            </div>
        </div>
    </section>

{{--    <div class="form-loader">--}}
{{--        <div class="div-loader">--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
@push('custom-js')
    {!! $dataTable->scripts() !!}
    <script>

    </script>
@endpush

