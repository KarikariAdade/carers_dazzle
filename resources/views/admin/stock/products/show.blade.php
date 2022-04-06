@extends('layouts.admin')
@section('content')
    <section class="container card card-primary">
        <div class="card-header row">
            <div class="col-md-10"><h4>Product Details: {{ $product->name }}</h4></div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 table-responsive p-3">
                    <table class=" table table-bordered table-striped">
                        <tr><td width="160"><h6><strong>Product Name</strong></h6></td><td style="font-size: 17px;">
                            {{ $product->name }}</td></tr>
{{--                        <tr><td width="160"><h6><strong>Product Category</strong></h6></td><td style="font-size: 17px;">{{ $product->getCategory->name }}</td></tr>--}}
                        <tr><td width="160"><h6><strong>Product Sub-category</strong></h6></td><td style="font-size: 17px;">
                            {{ $product->getSubCategory->name ?? 'N/A' }}</td></tr>
                        <tr><td width="160"><h6><strong>Brand </strong></h6></td><td style="font-size: 17px;">
                            {{ $product->getBrand->name }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6 table-responsive p-3">
                    <table class="table table-bordered table-striped">
                        <tr><td width="160"><h6><strong>Price</strong></h6></td><td style="font-size: 17px;">{{ 'GHS '.number_format($product->price, 2) }}</td></tr>
                        <tr><td width="160"><h6><strong>Quantity/Stock </strong></h6></td><td style="font-size: 17px;">{{ $product->quantity }}</td></tr>
                        <tr><td width="160"><h6><strong>Taxes</strong></h6></td><td style="font-size: 17px;">
                                @if($product->taxes)
                                    @foreach($taxes as $tax)
                                        {{ $taxes->count() > 1 ? $tax->name. ', ' : $tax->name }}
                                    @endforeach
                                @endif
                            </td></tr>
                        <tr><td width="160"><h6><strong>Status</strong></h6></td><td>
                                {!! $product->is_active == true ? '<span class=" shadow badge badge-success"> Active</span>' : '<span class="badge shadow badge-danger"> Inactive </span>' !!}
                            </td></tr>
                    </table>
                </div>
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr><td width="170"><h6>Description</h6></td><td>{{ $product->description }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @if(!empty($product->getPicture))
        <section class="container card card-primary">
            <div class="card-header row">
                <div class="col-md-10"><h4>Product Images</h4></div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($product->getPicture as $picture)
                        <div class="col-md-3">
                            <img class="img-fluid" src="{{ asset($picture->path) }}" style="width: 100%; border-radius: 10px; height: 100%;">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
